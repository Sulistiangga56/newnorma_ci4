<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inventory extends Migration
{
    public function up()
    {
        // CREATE TABLE `inventory` (
        //     `kode_bk` varchar(100) NOT NULL,
        //     `nama` varchar(200) NOT NULL,
        //     `qty` varchar(200) NOT NULL,
        //     `satuan` varchar(200) NOT NULL,
        //     `harga` int(11) NOT NULL,
        //     `tanggal` date NOT NULL
        //   ) 
        $this->forge->addField([
            'kode_bk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'qty' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('kode_bk', true);
        $this->forge->createTable('inventory');
    }

    public function down()
    {
        $this->forge->dropTable('inventory');
    }
}
