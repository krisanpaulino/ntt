<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKoordinatKelurahan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kelurahan', [
            'kelurahan_long' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'kelurahan_lat' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
