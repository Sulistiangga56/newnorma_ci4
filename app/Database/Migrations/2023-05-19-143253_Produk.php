<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'harga_produk' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'gambar_produk' => [
                'type' => 'TEXT',
            ],
            'deskripsi_produk' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->forge->addKey('kode_produk', true);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
