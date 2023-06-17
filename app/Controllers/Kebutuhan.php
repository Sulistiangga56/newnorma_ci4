<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KebutuhanProdukModel;

class Kebutuhan extends BaseController
{
    public function index($kode_produk)
    {
        $db = \Config\Database::connect();

        // join table kebutuhan_produk with produk with inventory
        $result = $db->table('kebutuhan_produk')
            ->join('produk', 'produk.kode_produk = kebutuhan_produk.kode_produk')
            ->join('inventory', 'inventory.kode_bk = kebutuhan_produk.kode_material')
            ->where('kebutuhan_produk.kode_produk', $kode_produk)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Kebutuhan Produk',
            'result' => $result,
        ];
        return view('admin/kebutuhanproduk', $data);
    }
}
