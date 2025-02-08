<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelurahantoPosyandu extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posyandu', [
            'kelurahan_id' => [
                'type' => 'INT',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
