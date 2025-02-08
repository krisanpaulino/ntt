<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GaleriModel;
use App\Models\MasterModel;
use CodeIgniter\HTTP\ResponseInterface;

class Galeri extends BaseController
{
    public function rt($rt_id)
    {
        $model = new GaleriModel();
        $master = new MasterModel();
        $rt = $master->rt($rt_id);
        $galeri = $model->getRT($rt_id);
        $data = [
            'title' => 'Galeri RT ' . $rt->rt_nama,
            'galeri' => $galeri
        ];
        return view('galeri', $data);
    }
}
