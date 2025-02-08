<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HargaModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterModel;

class Master extends BaseController
{
    function kabupaten()
    {
        $model = new MasterModel();
        $data = [
            'title' => 'Master kabupaten',
            'kabupaten' => $model->getkabupaten()
        ];
        return view('master-kabupaten', $data);
    }
    function savekabupaten()
    {
        // $kategori_id = $this->request->getPost('id');
        $data = [
            'kabupaten_nama' => $this->request->getPost('kabupaten_nama')
        ];
        $id = $this->request->getPost('id');
        $model = new MasterModel();
        if (!$model->saveData('kabupaten', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deleteKabupaten()
    {
        $id = $this->request->getPost('id');
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
        return view('master-subkategori', $data);
    }
    function savekecamatan()
    {
        $data = [
            'kabupaten_id' => $this->request->getPost('kabupaten_id'),
            'kecamatan_nama' => $this->request->getPost('kecamatan_nama'),
        ];
        $id = $this->request->getPost('id');
        $model = new MasterModel();
        if (!$model->saveData('kecamatan', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletekecamatan()
    {
        $id = $this->request->getPost('id');
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

        $data = [
            'title' => 'kelurahan',
            'kelurahan' => $model->getKelurahan($kecamatan_id),
            'kecamatan' => $kecamatan
        ];
        return view('master-subkategori', $data);
    }
    function savekelurahan()
    {
        $data = [
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
            'kelurahan_nama' => $this->request->getPost('kelurahan_nama'),
            'kelurahan_jenis' => 'desa'
        ];
        $id = $this->request->getPost('id');
        $model = new MasterModel();
        if (!$model->saveData('kelurahan', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletekelurahan()
    {
        $id = $this->request->getPost('id');
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

        $data = [
            'title' => 'dusun',
            'dusun' => $model->getDusun($kelurahan_id),
            'kelurahan' => $kelurahan
        ];
        return view('master-subkategori', $data);
    }
    function savedusun()
    {
        $data = [
            'kelurahan_id' => $this->request->getPost('kelurahan_id'),
            'dusun_nama' => $this->request->getPost('dusun_nama'),
        ];
        $id = $this->request->getPost('id');
        $model = new MasterModel();
        if (!$model->saveData('dusun', $id, $data))
            return redirect()->back()->with('danger', 'Data tidak dapat disimpan! Terjadi kesalahan')->with('errors', $model->errors());
        return redirect()->back()->with('success', 'Data berhasil disimpan')->with('errors', $model->errors());
    }
    function deletedusun()
    {
        $id = $this->request->getPost('id');
        $model = new MasterModel();
        if (!$model->deleteData('dusun', $id)) {
            return redirect()->back()->with('danger', 'Data tidak dapat dihapus')->with('errors', $model->errors());
        }
        return redirect()->back()->with('success', 'Data berhasil dihapus')->with('errors', $model->errors());
    }
    //end dusun
}
