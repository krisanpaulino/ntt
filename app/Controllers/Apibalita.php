<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class Apibalita extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new BalitaModel();
    }
    public function index($kelurahan_id)
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->findBalita();
        return $this->respond($data, 200);
    }
    public function balitaKelurahan($kelurahan_id)
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->findBalita(null, $kelurahan_id);
        return $this->respond($data, 200);
    }
    public function balitaPosyandu($posyandu_id)
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->byPosyandu($posyandu_id);
        return $this->respond($data, 200);
    }
    function show($id = null)
    {
        $data = $this->model->findBalita($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    function create()
    {
        $data = $this->request->getVar();
        //Hitung umur
        $tgllahir = new DateTime($data['balita_tgllahir']);
        $now = new DateTime(date('Y-m-d'));
        $diff = $now->diff($tgllahir);
        $data['balita_umur'] = ($diff->y * 12) + $diff->m;
        if ($data['balita_umur'] > 59)
            return $this->fail('Umur bayi maksimal 59 bulan!');
        $model = new BalitaModel();
        $data['balita_tgllahir'] = date('Y-m-d', strtotime($data['balita_tgllahir']));
        if (session('user')->user_type == 'petugas')
            $data['posyandu_id'] = session('petugas')->posyandu_id;
        if ($id = $model->insert($data, true)) {
            $username = $id . date('d') . date('m') . date('y');
            $model = new UserModel();
            $user = [
                'user_email' => $username,
                'user_type' => 'orangtua',
                'user_password' => '12345',
                'password_confirmation' => '12345'
            ];
            $uid = $model->insert($user, true);
            $model = new BalitaModel();
            $model->where('balita_id', $id);
            $model->update($id, ['user_id' => $uid]);
        }
        // array
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil ditambahkan'
            ],
            'data' => (array)$data
        ];
        return $this->respond($response);
    }
    function update($id)
    {
        $data = $this->request->getRawInput();
        $data['balita_id'] = $id;
        $exist = $this->model->find($id);
        if (!$exist)
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
        if (!$this->model->update($id, $data))
            return $this->fail($this->model->errors());

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Data berhasil diupdate'
            ],
            'data' => $data
        ];

        return $this->respond($response);
    }
    function delete($id)
    {
        $data = $this->model->find($id);
        if ($data) {
            $this->model->where('balita_id', $id)->delete();
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Data $id berhasil dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        }
        return $this->failNotFound();
    }
}
