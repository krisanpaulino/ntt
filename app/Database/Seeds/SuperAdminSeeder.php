<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $data = [
            'user_email' => 'superadmin@mail.com',
            'user_password' => '12345',
            'password_confirmation' => '12345',
            'user_type' => 'superadmin'
        ];
        $model->insert($data);
    }
}
