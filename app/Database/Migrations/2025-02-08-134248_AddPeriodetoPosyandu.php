<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPeriodetoPosyandu extends Migration
{
    public function up()
    {
        $this->forge->addColumn('periode', [
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
