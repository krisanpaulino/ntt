<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HargaModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterModel;
use App\Models\PosyanduModel;

class Master extends BaseController
{
    function kabupaten()
    {
        $model = new MasterModel();
        $data = [
            'title' => 'Master kabupaten',
            'kabupaten' => $model->getkabupaten()
        ];
        return view('master_kabupaten', $data);
    }
    function savekabupaten()
    {
        // $kategori_id = $this->request->getPost('id');
        $data = [
            'kabupaten_nama' => $this->request->getPost('kabupaten_nama')
        ];
        $id = $this->request->getPost('kabupaten_id');
        $model = new MasterModel();
        if (!$model->saveData('kabupaten', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deleteKabupaten()
    {
        $id = $this->request->getPost('kabupaten_id');
        $model = new MasterModel();
        if (!$model->deleteData('kabupaten', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }

    function kecamatan($kabupaten_id)
    {
        $model = new MasterModel();
        $kabupaten = $model->getKabupaten($kabupaten_id);

        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $model->getKecamatan($kabupaten_id),
            'kabupaten' => $kabupaten
        ];
        return view('master_kecamatan', $data);
    }
    function savekecamatan()
    {
        $data = [
            // 'kabupaten_id' => $this->request->getPost('kabupaten_id'),
            'kecamatan_nama' => $this->request->getPost('kecamatan_nama'),
        ];
        $id = $this->request->getPost('kecamatan_id');
        if ($id == null)
            $data['kabupaten_id'] = $this->request->getPost('kabupaten_id');
        $model = new MasterModel();
        if (!$model->saveData('kecamatan', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletekecamatan()
    {
        $id = $this->request->getPost('kecamatan_id');
        $model = new MasterModel();
        if (!$model->deleteData('kecamatan', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }

    //Kelurahan
    function kelurahan($kecamatan_id)
    {
        $model = new MasterModel();
        $kecamatan = $model->detail($kecamatan_id, 'kecamatan');
        $kabupaten = $model->detail($kecamatan->kabupaten_id, 'kabupaten');
        $data = [
            'title' => 'Data Desa / Kelurahan',
            'kelurahan' => $model->getKelurahan($kecamatan_id),
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten
        ];
        return view('master_kelurahan', $data);
    }
    function savekelurahan()
    {
        $data = [
            'kelurahan_nama' => $this->request->getPost('kelurahan_nama'),
            'kelurahan_jenis' => 'desa'
        ];
        $id = $this->request->getPost('kelurahan_id');
        if ($id == null)
            $data['kecamatan_id'] = $this->request->getPost('kecamatan_id');
        $model = new MasterModel();
        if (!$model->saveData('kelurahan', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletekelurahan()
    {
        $id = $this->request->getPost('kelurahan_id');
        $model = new MasterModel();
        if (!$model->deleteData('kelurahan', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }
    //end kelurahan

    //Dususn
    function dusun($kelurahan_id)
    {
        $model = new MasterModel();
        $kelurahan = $model->detail($kelurahan_id, 'kelurahan');
        $kecamatan = $model->detail($kelurahan->kecamatan_id, 'kecamatan');
        $kabupaten = $model->detail($kecamatan->kabupaten_id, 'kabupaten');
        $pModel = new PosyanduModel();
        $posyandu = $pModel->byKelurahan($kelurahan_id);

        $data = [
            'title' => 'Data Dusun',
            'dusun' => $model->getDusun($kelurahan_id),
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'posyandu' => $posyandu
        ];
        return view('master_dusun', $data);
    }
    function savedusun()
    {
        $data = [
            'dusun_nama' => $this->request->getPost('dusun_nama'),
            'posyandu_id' => $this->request->getPost('posyandu_id'),
        ];
        $id = $this->request->getPost('dusun_id');
        if ($id == null)
            $data['kelurahan_id'] = $this->request->getPost('kelurahan_id');
        $model = new MasterModel();
        if (!$model->saveData('dusun', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletedusun()
    {
        $id = $this->request->getPost('dusun_id');
        $model = new MasterModel();
        if (!$model->deleteData('dusun', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }
    //end dusun

    //Posyandu
    function posyandu($kelurahan_id)
    {
        $model = new MasterModel();
        $kelurahan = $model->detail($kelurahan_id, 'kelurahan');
        $kecamatan = $model->detail($kelurahan->kecamatan_id, 'kecamatan');
        $kabupaten = $model->detail($kecamatan->kabupaten_id, 'kabupaten');
        $pModel = new PosyanduModel();
        $posyandu = $pModel->byKelurahan($kelurahan_id);

        $data = [
            'title' => 'Data Posyandu',
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'posyandu' => $posyandu
        ];
        return view('master_posyandu', $data);
    }
    function saveposyandu()
    {
        $data = [
            'posyandu_nama' => $this->request->getPost('posyandu_nama'),
            // 'kelurahan' => $this->request->getPost('posyandu_id'),
        ];
        $id = $this->request->getPost('posyandu_id');
        if ($id == null)
            $data['kelurahan_id'] = $this->request->getPost('kelurahan_id');
        $model = new MasterModel();
        if (!$model->saveData('posyandu', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deleteposyandu()
    {
        $id = $this->request->getPost('posyandu_id');
        $model = new MasterModel();
        if (!$model->deleteData('posyandu', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }
    //end posyandu
}
