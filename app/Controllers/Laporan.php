<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function peta()
    {
        $model = new BalitaModel();
        if (session('user')->user_type == 'petugasdesa')
            $balita = $model->byDusun(petugasdesa()->kelurahan_id);
        if (session('user')->user_type == 'admin')
            $balita = $model->byDusun(admin()->kelurahan_id);

        $data = [
            'title' => 'Peta sebaran balita',
            'balita' => $balita
        ];
        return view('peta_index', $data);
    }
}
