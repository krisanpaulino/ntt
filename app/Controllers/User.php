<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MasterModel;
use App\Models\PetugasdesaModel;
use App\Models\PetugasModel;
use App\Models\PosyanduModel;
use App\Models\UserModel;
use DateTime;

class User extends BaseController
{
    // public function admin()
    // {
    //     $model = new UserModel();
    //     $data['title'] = 'Data Admin';
    //     $data['users'] = $model->findAdmins();

    //     return view('pengguna/admin', $data);
    // }

    // public function storeAdmin()
    // {
    //     $data = $this->request->getPost();
    //     $data['user_type'] = 'admin';
    //     $model = new UserModel();
    //     if ($model->insert($data)) {
    //         return redirect()->back();
    //     } else {
    //         // dd($model->errors()['password_confirmation']);
    //         return redirect()->back()
    //             ->with('errors', $model->errors())
    //             ->withInput();
    //     }
    // }

    // public function deleteAdmin()
    // {
    //     $model = new UserModel();
    //     $user_id = $this->request->getPost('user_id');
    //     $model->delete($user_id);
    //     return redirect()->to('admin/admin');
    // }

    public function petugas()
    {
        $model = new PetugasModel();
        $pmodel = new PosyanduModel();
        if (user()->user_type == 'admin')
            $posyandu = $pmodel->byKelurahan(admin()->kelurahan_id);
        else
            $posyandu = $pmodel->findAll();
        $data = [
            'title' => 'Data Petugas Posyandu',
            'petugas' => $model->findPetugas(),
            'posyandu' => $posyandu
        ];
        return view('user_petugas', $data);
    }

    public function storePetugas()
    {
        $user =  [
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation'),
            'user_type' => 'petugas'
        ];
        // dd($user);
        $umodel = new UserModel();

        //simpan dulu data user
        if ($user_id = $umodel->insert($user, true)) {
            // dd($user_id);
            $tgllahir = (string)$this->request->getPost('petugas_tgllahir');
            $date = new DateTime($tgllahir);

            $data = [
                'petugas_nama' => $this->request->getPost('petugas_nama'),
                'petugas_jk' => $this->request->getPost('petugas_jk'),
                'petugas_tempatlahir' => $this->request->getPost('petugas_tempatlahir'),
                'petugas_tgllahir' => date('Y-m-d', strtotime($date->format('Y-m-d'))),
                'petugas_alamat' => $this->request->getPost('petugas_alamat'),
                'petugas_hp' => $this->request->getPost('petugas_hp'),
                'posyandu_id' => $this->request->getPost('posyandu_id'),
                'user_id' => $user_id
            ];

            $pmodel = new PetugasModel();
            $data['petugas_foto'] = 'default.jpg';


            if ($pmodel->insert($data)) {
                return redirect()->to(previous_url())->with('success', 'Data Petugas Ditambahkan !');
            }
            return redirect()->to(previous_url())->with('danger', 'Data Petugas Gagal Ditambahkan !')
                ->with('errors', $pmodel->errors())
                ->withInput();
        } else {
            dd($umodel->errors());
        }
    }

    public function detailPetugas($petugas_id)
    {
        $model = new PetugasModel();
        $petugas = $model->findPetugas($petugas_id);
        $model = new PosyanduModel();
        if (user()->user_type == 'admin')
            $posyandu = $model->byKelurahan(admin()->kelurahan_id);
        else
            $posyandu = $model->findAll();
        $data = [
            'title' => 'Detail Petugas',
            'petugas' => $petugas,
            'posyandu' => $posyandu
        ];

        return view('petugas-detail', $data);
    }
    public function updatePetugas()
    {
        $petugas_id = $this->request->getPost('petugas_id');
        $data = $this->request->getPost();
        $tgllahir = $this->request->getPost('petugas_tgllahir');
        // dd($tgllahir);
        // $date = new DateTime($tgllahir);
        // dd(date('Y-m-d', strtotime($tgllahir)));
        $data['petugas_tgllahir'] = date('Y-m-d', strtotime($tgllahir));
        // dd($data);
        $model = new PetugasModel();

        // dd($data);
        $model->where('petugas_id', $petugas_id);
        $model->update($petugas_id, $data);
        return redirect()->to(previous_url())->with('success', 'Data berhasil diubah');
    }
    public function deletePetugas()
    {
        $model = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $model->delete($user_id);
        return redirect()->to('admin/petugas');
    }
    public function petugasdesa($kelurahan_id = null)
    {
        $model = new PetugasdesaModel();
        $pmodel = new MasterModel();
        if (user()->user_type == 'admin')
            $petugasdesa = $model->findByDesa(admin()->kelurahan_id);
        else
            $petugasdesa = $model->findPetugas();
        $data = [
            'title' => 'Data Petugas Desa',
            'petugasdesa' => $petugasdesa,
            'kelurahan' => $pmodel->getKelurahan()
        ];
        return view('user_petugasdesa', $data);
    }

    public function storePetugasdesa()
    {
        $user =  [
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation'),
            'user_type' => 'petugasdesa'
        ];
        // dd($user);
        $umodel = new UserModel();

        //simpan dulu data user
        if ($user_id = $umodel->insert($user, true)) {
            // dd($user_id);
            $tgllahir = (string)$this->request->getPost('petugas_tgllahir');
            $date = new DateTime($tgllahir);

            $data = [
                'petugasdesa_nama' => $this->request->getPost('petugasdesa_nama'),
                'petugasdesa_jk' => $this->request->getPost('petugasdesa_jk'),
                'petugasdesa_tempatlahir' => $this->request->getPost('petugasdesa_tempatlahir'),
                'petugasdesa_tgllahir' => date('Y-m-d', strtotime($date->format('Y-m-d'))),
                'petugasdesa_alamat' => $this->request->getPost('petugasdesa_alamat'),
                'petugasdesa_hp' => $this->request->getPost('petugasdesa_hp'),
                'kelurahan_id' => $this->request->getPost('kelurahan_id'),
                'user_id' => $user_id
            ];
            if (user()->user_type == 'admin')
                $data['kelurahan_id'] = admin()->kelurahan_id;

            $pmodel = new PetugasdesaModel();
            $data['petugas_foto'] = 'default.jpg';


            if ($pmodel->insert($data)) {
                return redirect()->to(previous_url())->with('success', 'Data Petugas Ditambahkan !');
            }
            $umodel->where('user_id', $user_id)->delete();
            dd($pmodel->errors());
            return redirect()->to(previous_url())->with('danger', 'Data Petugas Gagal Ditambahkan !')
                ->with('errors', $pmodel->errors())
                ->withInput();
        } else {
            dd($umodel->errors());
        }
    }

    public function detailPetugasdesa($petugas_id)
    {
        $model = new PetugasdesaModel();
        $petugas = $model->findPetugas($petugas_id);
        $model = new PosyanduModel();
        $data = [
            'title' => 'Detail Petugas',
            'petugasdesa' => $petugas,
            'posyandu' => $model->findAll()
        ];

        return view('petugasdesa-detail', $data);
    }
    public function updatePetugasdesa()
    {
        $petugas_id = $this->request->getPost('petugas_id');
        $data = $this->request->getPost();
        $tgllahir = $this->request->getPost('petugas_tgllahir');
        // dd($tgllahir);
        // $date = new DateTime($tgllahir);
        // dd(date('Y-m-d', strtotime($tgllahir)));
        $data['petugas_tgllahir'] = date('Y-m-d', strtotime($tgllahir));
        // dd($data);
        $model = new PetugasModel();

        // dd($data);
        $model->where('petugas_id', $petugas_id);
        $model->update($petugas_id, $data);
        return redirect()->to(previous_url())->with('success', 'Data berhasil diubah');
    }
    public function deletePetugasdesa()
    {
        $model = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $model->delete($user_id);
        return redirect()->to('admin/petugasdesa');
    }

    public function admin()
    {
        $model = new AdminModel();
        $pmodel = new MasterModel();
        $data = [
            'title' => 'Data Admin',
            'admin' => $model->findAdmin(),
            'kelurahan' => $pmodel->getKelurahan()
        ];
        return view('user_admin', $data);
    }

    public function storeAdmin()
    {
        $user =  [
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation'),
            'user_type' => 'admin'
        ];
        // dd($user);
        $umodel = new UserModel();

        //simpan dulu data user
        if ($user_id = $umodel->insert($user, true)) {
            // dd($user_id);
            $tgllahir = (string)$this->request->getPost('admin_tgllahir');
            $date = new DateTime($tgllahir);

            $data = [
                'admin_nama' => $this->request->getPost('admin_nama'),
                'admin_jk' => $this->request->getPost('admin_jk'),
                'admin_tempatlahir' => $this->request->getPost('admin_tempatlahir'),
                'admin_tgllahir' => date('Y-m-d', strtotime($date->format('Y-m-d'))),
                'admin_alamat' => $this->request->getPost('admin_alamat'),
                'admin_hp' => $this->request->getPost('admin_hp'),
                'kelurahan_id' => $this->request->getPost('kelurahan_id'),
                'user_id' => $user_id
            ];

            $pmodel = new AdminModel();
            $data['admin_foto'] = 'default.jpg';


            if ($pmodel->insert($data)) {
                return redirect()->to(previous_url())->with('success', 'Data Admin Ditambahkan !');
            }
            $umodel->where('user_id', $user_id)->delete();
            dd($pmodel->errors());
            return redirect()->to(previous_url())->with('danger', 'Data Admin Gagal Ditambahkan !')
                ->with('errors', $pmodel->errors())
                ->withInput();
        } else {
            dd($umodel->errors());
        }
    }
    public function detailAdmin($admin_id)
    {
        $model = new AdminModel();
        $admin = $model->findPetugas($admin_id);
        $model = new PosyanduModel();
        $data = [
            'title' => 'Detail Petugas',
            'admin' => $admin,
            // 'kel' => $model->findAll()
        ];

        return view('pengguna/petugas-detail', $data);
    }
    public function updateAdmin()
    {
        $admin_id = $this->request->getPost('admin_id');
        $data = $this->request->getPost();
        $tgllahir = $this->request->getPost('admin_tgllahir');
        // dd($tgllahir);
        // $date = new DateTime($tgllahir);
        // dd(date('Y-m-d', strtotime($tgllahir)));
        $data['admin_tgllahir'] = date('Y-m-d', strtotime($tgllahir));
        // dd($data);
        $model = new AdminModel();

        // dd($data);
        $model->where('admin_id', $admin_id);
        $model->update($admin_id, $data);
        return redirect()->to(previous_url())->with('success', 'Data berhasil diubah');
    }
    public function deleteAdmin()
    {
        $model = new UserModel();
        $user_id = $this->request->getPost('user_id');
        $model->delete($user_id);
        return redirect()->to('admin/admin');
    }
}
