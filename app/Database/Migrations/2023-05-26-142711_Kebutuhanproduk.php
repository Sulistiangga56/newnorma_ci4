<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kebutuhanproduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kebutuhan' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'kode_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'kode_material' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_kebutuhan', true);
        $this->forge->createTable('kebutuhan_produk');
    }

    public function down()
    {
        $this->forge->dropTable('kebutuhan_produk');
    }
}
