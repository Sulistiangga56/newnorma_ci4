<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produksi extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'kode_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'kode_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'provinsi' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'kota' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'kode_pos' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'terima' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'tolak' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cek' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('id_order', true);
        $this->forge->createTable('produksi');
    }

    public function down()
    {
        $this->forge->dropTable('produksi');
    }
}
