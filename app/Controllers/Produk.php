<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KebutuhanProdukModel;

class Produk extends BaseController
{
    protected $helpers = ['form', 'url'];
    public function index()
    {
        $produk = new ProdukModel();
        $result = $produk->findAll();
        $data = [
            'title' => 'Produk',
            'result' => $result,
        ];
        return view('admin/produk', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk',
        ];
        return view('admin/tambahproduk', $data);
    }

    public function simpan()
    {
        $rules = [
            'kode_produk' => [
                'label' => 'Kode Produk',
                'rules' => 'required|is_unique[produk.kode_produk]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar',
                ]
            ],
            'gambar_produk' => [
                'label' => 'Gambar Produk',
                'rules' => 'uploaded[gambar_produk]|max_size[gambar_produk,10240]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} tidak boleh kosong',
                    'max_size' => '{field} maksimal 10MB',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in' => '{field} harus berupa gambar',
                ]
            ],
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'harga_produk' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ],
            'deskripsi_produk' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'material.*' => [
                'label' => 'Kode Material',
                'rules' => 'required|',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'kebutuhan-material.*' => [
                'label' => 'Kebutuhan Material',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ],
        ];
        $valid = $this->validate($rules);
        
        if (!$valid) {
            return redirect()->to(base_url('admin/produk/tambah'))->withInput();
        }
        $fileGambar = $this->request->getFile('gambar_produk');
        $newName = $fileGambar->getRandomName();
        $fileGambar->move('image/produk', $newName);
        
        $data = [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'gambar_produk' => $fileGambar->getName(),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_produk' => $this->request->getPost('harga_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
        ];
        
        $produk = new ProdukModel();
        $produk->insert($data);

        $material = $this->request->getPost('material');
        $kebutuhanMaterial = $this->request->getPost('kebutuhan-material');
        $kebutuhanProduk = new KebutuhanProdukModel();
        for ($i=0; $i < count($material); $i++) { 
            $data = [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'kode_material' => $material[$i],
                'jumlah' => $kebutuhanMaterial[$i],
            ];
            $kebutuhanProduk->insert($data);
        }

        return redirect()->to(base_url('admin/produk'))->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($kode_produk)
    {
        $produk = new ProdukModel();
        $result = $produk->where('kode_produk', $kode_produk)->first();
        $data = [
            'title' => 'Edit Produk',
            'data' => $result,
        ];
        return view('admin/editproduk', $data);
    }

    public function doEdit($kode_produk)
    {
        $valid = $this->validate([
            'kode_produk' => [
                'label' => 'Kode Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'harga_produk' => [
                'label' => 'Harga',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                ]
            ],
            'deskripsi_produk' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ]);
        if (!$valid) {
            return redirect()->back()->withInput();
        }
        // if user want to change image
        
        if ($this->request->getFile('gambar_produk')) {
            $fileGambar = $this->request->getFile('gambar_produk');
            $newName = $fileGambar->getRandomName();
            $fileGambar->move('image/produk', $newName);
            // delete old file
            $produk = new ProdukModel();
            $file = $produk->where('kode_produk', $kode_produk)->first();
            unlink('image/produk/' . $file['gambar_produk']);
            $data = [
                'gambar_produk' => $fileGambar->getName(),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
            ];
        } else {
            $data = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
            ];
        }
        
        
        
        $produk = new ProdukModel();
        $produk->update($kode_produk, $data);
        return redirect()->to(base_url('admin/produk'))->with('success', 'Produk berhasil diedit');
    }

    public function hapus($kode_produk)
    {
        $produk = new ProdukModel();
        // delete file
        $file = $produk->where('kode_produk', $kode_produk)->first();
        unlink('image/produk/' . $file['gambar_produk']);
        $produk->delete($kode_produk);
        return redirect()->to(base_url('admin/produk'))->with('success', 'Produk berhasil dihapus');
    }
}
