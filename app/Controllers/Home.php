<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $produk = new ProdukModel();
        $data['produk'] = $produk->findAll();
        return view('index', $data);
    }

    public function detail($kode_produk)
    {
        $produk = new ProdukModel();
        $data['produk'] = $produk->where('kode_produk', $kode_produk)->first();
        return view('detail_produk', $data);
    }

    public function panduan()
    {
        return view('manual');
    }

    public function produk()
    {
        $produk = new ProdukModel();
        $data['produk'] = $produk->findAll();
        return view('produk', $data);
    }
}
