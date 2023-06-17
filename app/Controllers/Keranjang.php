<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;
use App\Models\ProdukModel;
use App\Models\ProduksiModel;

class Keranjang extends BaseController
{
    public function index()
    {
    // gett all data in keranjang table and join with produk table
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('*');
        $builder->join('produk', 'produk.kode_produk = keranjang.kode_produk');
        $data['keranjang'] = $builder->get()->getResultArray();
        
        return view('keranjang', $data);
    }

    public function tambahProduk($id){
        $keranjang = new KeranjangModel();
        $produk = new ProdukModel();
        $produk = $produk->where('kode_produk',$id)->first();
        $data = [
            'kode_customer' => session()->get('kode_customer'),
            'kode_produk' => $id,
            'qty' => 1,
            'total_harga' => 1 * $produk['harga_produk'],
        ];
        $keranjang->insert($data);
        return redirect()->to(base_url('keranjang'));
    }

    public function tambahKeKeranjang(){
        $keranjang = new KeranjangModel();
        $produk = new ProdukModel();
        $produk = $produk->where('kode_produk', $this->request->getPost('kode_produk'))->first();
        $data = [
            'kode_customer' => $this->request->getPost('kode_customer'),
            'kode_produk' => $this->request->getPost('kode_produk'),
            'qty' => $this->request->getPost('jml'),
            'total_harga' => (int) ($this->request->getPost('jml')) * (int) $produk['harga_produk'],
        ];
        $keranjang->insert($data);
        return redirect()->to(base_url('keranjang'));
    }

    public function hapusKeranjang($id)
    {
        $keranjang = new KeranjangModel();
        $keranjang->delete($id);
        return redirect()->to(base_url('keranjang'));
    }

    public function edit($id)
    {

        $keranjang = new KeranjangModel();
        $kode_produk_in_keranjang = $keranjang->where('id_keranjang', $id)->first()['kode_produk'];
        $produk = new ProdukModel();
        $produk = $produk->where('kode_produk', $kode_produk_in_keranjang)->first();
        $data = [
            'qty' => $this->request->getPost('qty'),
            'total_harga' => (int) ($this->request->getPost('qty')) * (int) $produk['harga_produk'],
        ];
        $keranjang->update($id, $data);

        return redirect()->to(base_url('keranjang'));
    }

    public function checkout(){
        $kode_customer = session()->get('kode_customer');
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang');
        $builder->select('*');
        $builder->join('produk', 'produk.kode_produk = keranjang.kode_produk');
        $builder->where('kode_customer', $kode_customer);
        $data['keranjang'] = $builder->get()->getResultArray();

        return view('checkout', $data);
    }

    public function doCheckout()
    {
        $keranjang = new KeranjangModel();
        $produksi = new ProduksiModel();
        $lastProduksi = $produksi->orderBy('invoice', 'DESC')->first();
        if($lastProduksi == null){
            $lastProduksi['invoice'] = "INV0000";
        }
        $num = substr($lastProduksi['invoice'], 3, 4);
        $add = (int) $num + 1;
        if(strlen($add) == 1){
            $format = "INV000".$add;
        }else if(strlen($add) == 2){
            $format = "INV00".$add;
        }
        else if(strlen($add) == 3){
            $format = "INV0".$add;
        }else{
            $format = "INV".$add;
        }
        $db = \Config\Database::connect();
        // get all data keranjang join with produk
        $builder = $db->table('keranjang');
        $builder->select('*');
        $builder->join('produk', 'produk.kode_produk = keranjang.kode_produk');
        $builder->where('kode_customer', session()->get('kode_customer'));
        $datakeranjang = $builder->get()->getResultArray();
        // dd($datakeranjang);
        // loop through keranjang 
        $semua_data = [];
        foreach($datakeranjang as $k){
            $data = [
                'invoice' => $format,
                'kode_customer' => session()->get('kode_customer'),
                'kode_produk' => $k['kode_produk'],
                'nama_produk' => $k['nama_produk'],
                'qty' => $k['qty'],
                'harga' => $k['total_harga'],
                'status' => 'Pesanan Baru',
                'tanggal' => date('Y-m-d'),
                'provinsi' => $this->request->getPost('prov'),
                'kota' => $this->request->getPost('kota'),
                'alamat' => $this->request->getPost('alamat'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'terima' => 0,
                'tolak' => 0,
                'cek' => 0
            ];
            array_push($semua_data, $data);
        }
        // insert all data to produksi table
        $produksi->insertBatch($semua_data);

        // delete all data in keranjang where kode_customer = session()->get('kode_customer')
        $keranjang->where('kode_customer', session()->get('kode_customer'))->delete();
        return redirect()->to(base_url('keranjang'));
       
    }
}
