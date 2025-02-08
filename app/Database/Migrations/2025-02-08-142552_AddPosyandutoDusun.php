<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPosyandutoDusun extends Migration
{
    public function up()
    {
        $this->forge->addColumn('dusun', [
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
