<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use App\Models\PeriodeModel;

class Periode extends BaseController
{
    public function index()
    {
        $model = new PeriodeModel();
        if (user()->user_type != 'superadmin')
            $periode = $model->findUrutan(admin()->kelurahan_id);
        else
            $periode = $model->findUrutan();
        $bulan = bulan();
        $data = [
            'title' => 'Periode',
            'periode' => $periode,
            'bulan' => $bulan
        ];
        return view('periode_index', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $model = new PeriodeModel();
        $data['periode_status'] = 'tutup';
        if (user()->user_type == 'admin')
            $data['kelurahan_id'] = admin()->kelurahan_id;
        // dd($data);
        if ($model->insert($data)) {
            return redirect()->to(previous_url())->with('success', 'Periode berhasil ditambahkan');
        }
        dd($model->errors());
        return redirect()->to(previous_url())->with('danger', 'Periode gagal ditambahkan')
            ->with('errors', $model->errors())
            ->withInput();
    }
    public function delete()
    {
        $periode_id = $this->request->getPost('periode_id');
        $model = new PeriodeModel();
        $model->where('periode_id', $periode_id);
        $model->delete();
        return redirect()->to(previous_url())->with('success', 'Periode berhasil dihapus');
    }

    public function buka()
    {
        $periode_id = $this->request->getPost('periode_id');
        $model = new PeriodeModel();
        $model->where('periode_id', $periode_id);
        $model->update($periode_id, ['periode_status' => 'buka']);

        $model = new BalitaModel();
        $model->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $model->where('balita.balita_umur <=', 60, true);
        $model->where('dusun.posyandu_id', petugas()->posyandu_id);
        $model->set('balita.balita_umur', '`balita`.`balita_umur` + 1', FALSE);
        $model->update();
        return redirect()->to(previous_url())->with('success', 'Periode berhasil dibuka!');
    }
    public function selesai()
    {
        $periode_id = $this->request->getPost('periode_id');
        $model = new PeriodeModel();
        $model->where('periode_id', $periode_id);
        $model->update($periode_id, ['periode_status' => 'selesai']);

        return redirect()->to(previous_url())->with('success', 'Periode berhasil ditutup!');
    }
}
