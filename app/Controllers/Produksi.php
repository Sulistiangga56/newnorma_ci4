<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduksiModel;
use App\Models\InventoryModel;

class Produksi extends BaseController
{
    public function index()
    {
        // $result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty,terima,tolak, cek FROM produksi");
        $produksi = new ProduksiModel();
        $result = $produksi->distinct()->findAll();
        $inventory = new InventoryModel();
        // find inventory where the qty is less than 10
        $inventory = $inventory->where('qty <', 10)->findAll();
        $data = [
            'title' => 'Produksi',
            'result' => $result,
            'inventory' => $inventory,
        ];
        return view('admin/produksi', $data);
    }

    public function detail($invoice)
    {
        // $result = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoice'");
        $db = \Config\Database::connect();
        // get all produksi table join with customer table
        $result = $db->table('produksi')
            ->join('customer', 'customer.kode_customer = produksi.kode_customer')
            ->where('invoice', $invoice)
            ->get()
            ->getResultArray();
        
        
        
        $data = [
            'title' => 'Detail Produksi',
            'result' => $result,
        ];
        return view('admin/detailorder', $data);
    }

    public function tolak($invoice){
        // "UPDATE produksi set tolak = '1', terima='2' WHERE invoice = '$inv'"
        $db = \Config\Database::connect();
        $db->table('produksi')
            ->set('status', 'Pesanan Ditolak')
            ->set('tolak', '1')
            ->set('terima', '2')
            ->where('invoice', $invoice)
            ->update();
        return redirect()->to(base_url('admin/produksi'))->with('success', 'pesanan ditolak');
    }

    public function terima($invoice){
        $db = \Config\Database::connect();
        $result = $db->table('produksi')
            ->join('produk', 'produk.kode_produk = produksi.kode_produk')
            ->join('kebutuhan_produk', 'kebutuhan_produk.kode_produk = produksi.kode_produk')
            ->where('invoice', $invoice)
            ->get()
            ->getResultArray();
        // dd($result);
        // update inventory table so it will reduce the stock
        foreach ($result as $row) {
            $kode_bk = $row['kode_material'];
            $qty = $row['jumlah'];
            d($kode_bk, $qty);
            $db->table('inventory')
                ->set('qty', 'qty - ' . $qty, FALSE)
                ->where('kode_bk', $kode_bk)
                ->update();
        }
        $db->table('produksi')
            ->set('status', 'Pesanan Diterima (Siap Kirim)')
            ->set('terima', '1')
            ->where('invoice', $invoice)
            ->update();
        // then update the inventory
        
        return redirect()->to(base_url('admin/produksi'))->with('success', 'pesanan diterima, bahan baku telah dikurangi');
    }
}
