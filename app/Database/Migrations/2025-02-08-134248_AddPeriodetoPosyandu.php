<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPeriodetoPosyandu extends Migration
{
    public function up()
    {
        $this->forge->addColumn('periode', [
            'posyandu_id' => [
                'type' => 'INT',
                'unsigned' => true
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
