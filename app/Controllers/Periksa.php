<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use App\Models\HasilukurModel;
use App\Models\MedianbbModel;
use App\Models\MedianbbperpbModel;
use App\Models\MedianbbpertbModel;
use App\Models\MedianimtModel;
use App\Models\MedianpbModel;
use App\Models\MediantbModel;
use App\Models\PeriodeModel;

class Periksa extends BaseController
{
    public function index()
    {
        $model = new PeriodeModel();
        $periode = $model->findBuka(petugas()->kelurahan_id);
        // dd($periode);
        if ($periode != null) {
            $model = new BalitaModel();
            $posyandu_id = petugas()->posyandu_id;

            $belum_periksa = $model->belumPeriksa($periode->periode_id, $posyandu_id);
            $sudah_periksa = $model->sudahPeriksa($periode->periode_id, $posyandu_id);
            $data = [
                'title' => 'Pemeriksaan Periode ' . konversiBulan($periode->periode_bulan) . ' ' . $periode->periode_tahun,
                'belum_periksa' => $belum_periksa,
                'sudah_periksa' => $sudah_periksa,
                'periode' => $periode
            ];
            return view('periksa_index', $data);
        }
        $data = [
            'title' => '',
        ];
        return view('no-periode', $data);
    }

    public function periksa($balita_id)
    {
        $model = new BalitaModel();
        $balita = $model->find($balita_id);

        $model = new PeriodeModel();
        $periode = $model->findBuka(petugas()->kelurahan_id);

        $data = [
            'title' => 'Periksa Balita',
            'balita' => $balita,
            'periode' => $periode
        ];

        return view('periksa_form', $data);
    }

    public function store()
    {
        $model = new PeriodeModel();
        $periode = $model->findBuka(petugas()->kelurahan_id);

        $model = new BalitaModel();
        $balita = $model->find($this->request->getPost('balita_id'));
        //Dapatkan Hasil Ukur dari Form
        $data = $this->request->getPost();
        $data['periode_id'] = $periode->periode_id;
        $data['hasilukur_umur'] = $balita->balita_umur;
        $model = new HasilukurModel();
        if ($hasilukur_id = $model->insert($data, true)) {
            return redirect()->to(session('user')->user_type . '/periksa/detail/' . $data['balita_id'])
                ->with('success', 'Data berhasil direkam!');
        }
        return redirect()->to(previous_url())
            ->with('danger', 'Data gagal direkam. Periksa kembali!')
            ->withInput()
            ->with('errors', $model->errors());
    }

    public function detail($balita_id, $periode_id = null)
    {
        $model = new PeriodeModel();
        if ($periode_id == null)
            $periode = $model->findBuka(petugas()->kelurahan_id);
        else
            $periode = $model->find($periode_id);
        // dd($periode);
        $model = new HasilukurModel();
        $detail = $model->findDetail($balita_id, $periode->periode_id);

        $model = new BalitaModel();
        $balita = $model->findBalita($balita_id);

        $data = [
            'title' => 'Detail Ukur Balita Periode ' . konversiBulan($periode->periode_bulan) . ' ' . $periode->periode_tahun,
            'periode' => $periode,
            'balita' => $balita,
            'detail' => $detail
        ];
        // dd($detail);

        return view('periksa_hasilukur', $data);
    }
}
