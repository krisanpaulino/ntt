<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasdesaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class Otentikasi extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan username',
                    // 'valid_email' => 'Email Tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan masukkan password'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $model = new UserModel();
        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->getLoginData($email);
        // return $this->respond($data);
        if ($data->user_type == 'petugasdesa') {
            $pmodel = new PetugasdesaModel();
            $data->petugasdesa = $pmodel->findUserPetugas($data->user_id);
        }
        if (!password_verify($password, $data->user_password)) {
            return $this->fail('Password tidak sesuai');
        }
        helper('jwt');
        $response = [
            'message' => 'JWT Created',
            'data' => $data,
            'access_token' => createJWT($email)
        ];

        return $this->respond($response);
    }
}
