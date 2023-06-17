<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_produk' => 'PRD001',
                'nama_produk' => 'Laptop',
                'harga_produk' => 7000000,
                'gambar_produk' => '5f1d9154715a4.jpg',
                'deskripsi_produk' => 'Laptop Asus ROG'
            ],
            [
                'kode_produk' => 'PRD002',
                'nama_produk' => 'Mouse',
                'harga_produk' => 120000,
                'gambar_produk' => '64672a704dfdd.jpg',
                'deskripsi_produk' => 'Mouse Logitech'
            ],
            [
                'kode_produk' => 'PRD003',
                'nama_produk' => 'Keyboard',
                'harga_produk' => 200000,
                'gambar_produk' => '1684626068_68b0984ee5acf477720f.jpeg',
                'deskripsi_produk' => 'Keyboard Logitech'
            ],
            
        ];

        // Using Query Builder
        $this->db->table('produk')->insertBatch($data);
    }
}
