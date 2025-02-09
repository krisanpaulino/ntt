<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use App\Models\PetugasdesaModel;
use App\Models\PetugasModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginPage()
    {
        if (session()->has('user') && session('user')->user_type != 'orangtua') {
            return redirect()->to(session()->get('user')->user_type);
        }
        return view('login2');
    }

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->getLoginData($email);
        // dd($user->user_password);
        if ($user == null) {
            return redirect()->to(previous_url())
                ->with('danger', 'Username tidak ditemukan!')
                ->withInput();
        }

        if (!password_verify($password, $user->user_password)) {
            return redirect()->to(previous_url())
                ->with('danger', 'Password Salah!');
        }


        switch ($user->user_type) {
            case 'petugas':
                $model = new PetugasModel();

                $data = [
                    'user' => $user,
                    'petugas' => $model->where('user_id', $user->user_id)->first(),
                    'petugas_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('petugas');
                break;
            case 'orangtua':
                $model = new BalitaModel();

                $data = [
                    'user' => $user,
                    'balita' => $model->where('user_id', $user->user_id)->first(),
                    'orangtua_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('/');
                break;
            case 'petugasdesa':
                $model = new PetugasdesaModel();

                $data = [
                    'user' => $user,
                    'petugas' => $model->where('user_id', $user->user_id)->first(),
                    'petugasdesa_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('/');
                break;
            case 'admin':
                $data = [
                    'user' => $user,
                    'admin_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('admin');
                break;
            case 'superadmin':
                $data = [
                    'user' => $user,
                    'superadmin_logged_in' => 1,
                ];
                session()->set($data);
                return redirect()->to('admin');
                break;
            default:
                return redirect()->to('/');
                break;
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth');
    }
    public function logoutPelanggan()
    {
        session()->destroy();
        return redirect()->to('login-pelanggan');
    }
    // public function signupPelanggan()
    // {
    //     $model = new KelurahanModel();
    //     $data['data_kelurahan'] = $model->findAll();
    //     return view('signup_pelanggan', $data);
    // }
}
