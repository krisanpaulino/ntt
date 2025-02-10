<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BalitaModel;
use App\Models\HasilukurModel;
use App\Models\MasterModel;
use App\Models\PeriodeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class ApiTimbang extends BaseController
{
    use ResponseTrait;

    public function periode($kelurahan_id)
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $model = new PeriodeModel();
        $data = $model->findBuka($kelurahan_id);
        if ($data != null) {
            return $this->respond($data, 200);
        }
        return $this->failNotFound('Tidak ada periode');
    }

    public function riwayat($balita_id)
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $model = new HasilukurModel();
        $data = $model->byBalita($balita_id);
        if ($data != null) {
            return $this->respond($data, 200);
        }
        return $this->failNotFound('Tidak ada periode');
    }
    public function detailtimbang($hasilukur_id)
    {
        $model = new HasilukurModel();
        $data = $model->byId($hasilukur_id);
        if ($data != null) {
            return $this->respond($data, 200);
        }
        return $this->failNotFound('Tidak ada data');
    }

    function createPeriode()
    {
        $data = $this->request->getVar();
        $model = new PeriodeModel();
        $data['periode_status'] = 'tutup';
        if ($model->insert($data)) {
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
        return $this->fail($model->errors());
    }
    function timbang()
    {
        $data = $this->request->getVar();

        $model = new BalitaModel();
        $balita = $model->find($data['balita_id']);
        //Dapatkan Hasil Ukur dari Form
        // $data = $this->request->getPost();
        // $data['periode_id'] = $periode->periode_id;
        $data['hasilukur_umur'] = $balita->balita_umur;
        $model = new HasilukurModel();
        if ($hasilukur_id = $model->insert($data, true)) {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data penimbangan ditambahkan'
                ],
                'data' => (array)$data
            ];
            return $this->respond($response);
        } else
            return $this->fail($model->errors());
    }
    function edittimbang($hasilukur_id)
    {
        $data = (array)$this->request->getRawInput();
        if ($data == null) {
            $data = (array)$this->request->getVar();
        }

        // $model = new BalitaModel();
        // $balita = $model->find($balita_id);
        //Dapatkan Hasil Ukur dari Form
        // $data = $this->request->getPost();
        // $data['periode_id'] = $periode->periode_id;
        // // $data['hasilukur_umur'] = $balita->balita_umur;
        $model = new HasilukurModel();
        if ($model->update($hasilukur_id, $data)) {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data penimbangan diubah'
                ],
                'data' => (array)$data
            ];
            return $this->respond($response);
        } else
            return $this->fail($model->errors());
    }
    public function kategoriSampah()
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->getKategori();
        return $this->respond($data, 200);
    }
    function kategoriSampahShow($id)
    {
        $data = $this->model->getKategori($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    public function subkategoriSampah()
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->getSubkategori();
        return $this->respond($data, 200);
    }
    function subkategoriSampahShow($id)
    {
        $data = $this->model->getSubkategori($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    function detailSub($id)
    {
        $data = $this->model->subDetail($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    function detailHarga($id)
    {
        $data = $this->model->hargaDetail($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    public function hargaSampah()
    {
        // if (session('user')->role_id == 3)
        //     $this->model->where('rt_id', session('user')->rt_id);
        $data = $this->model->getHarga();
        return $this->respond($data, 200);
    }
    function hargaSampahShow($id) //id_subkategori
    {
        $data = $this->model->getHarga($id);
        if ($data)
            return $this->respond($data, 200);
        else
            return $this->failNotFound('Data tidak ditemukan untuk id $id');
    }
    function rt()
    {
        $data = $this->model->getRT();
        return $this->respond($data, 200);
    }
    function kondisi()
    {
        $data = $this->model->getKondisi();
        return $this->respond($data, 200);
    }
    function pendidikan()
    {
        $data = $this->model->getMaster('pendidikan', false);
        return $this->respond($data, 200);
    }
    function pekerjaan()
    {
        $data = $this->model->getMaster('pekerjaan', false);
        return $this->respond($data, 200);
    }
    function penghasilan()
    {
        $data = $this->model->getMaster('penghasilan', false);
        return $this->respond($data, 200);
    }

    function savekategori()
    {
        $data['kategori_nama'] = $this->request->getVar('kategori_nama');
        $id = $this->request->getVar('kategori_id');
        if (!$this->model->saveData($data, $id, $data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil disimpan'
            ]
        ];
        return $this->respond($response);
    }
    function savesubkategori()
    {
        $data['subkategori_nama'] = $this->request->getVar('subkategori_nama');
        $id = $this->request->getVar('subkategori_id');
        if ($id == null)
            $data['kategori_id'] = $this->request->getVar('kategori_id');
        if (!$this->model->saveData('subkategori', $id, $data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => $id,
            'messages' => [
                'success' => 'Data berhasil disimpan'
            ]
        ];
        return $this->respond($response);
    }
    function deletesubkategori($id)
    {
        if (!$this->model->deleteData('subkategori', $id)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil dihapus'
            ]
        ];
        return $this->respond($response);
    }
    function saveharga()
    {
        $harga_id = $this->request->getVar('harga_id');
        $subkategori_id = $this->request->getVar('subkategori_id');
        $kondisi_id = $this->request->getVar('kondisi_id');
        $harga_nilai = $this->request->getVar('harga_nilai');
        $model = new HargaModel();
        // dd($this->request->getPost());
        if ($harga_id == null) {
            $data = [
                'subkategori_id' => $subkategori_id,
                'kondisi_id' => $kondisi_id,
                'harga_nilai' => $harga_nilai,
                'deleted' => '0'
            ];
            if (!$model->cekKosong($subkategori_id, $kondisi_id))
                return $this->fail('Sudah ada data untuk subkategori dan kondisi ini. Lakukan update jika ingin mengubah harga');

            if (!$model->insert($data)) {
                return $this->fail($model->errors());
            }
        } else {
            $data = [
                'harga_nilai' => $harga_nilai
            ];
            $model->set($data);
            $model->where('harga_id', $harga_id);
            if (!$model->update()) {
                return $this->fail($model->errors());
            }
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil disimpan'
            ]
        ];
        return $this->respond($response);
    }
    function deleteharga($id)
    {
        if (!$this->model->deleteData('harga', $id)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data berhasil dihapus'
            ]
        ];
        return $this->respond($response);
    }
    function noharga()
    {
        $model = new HargaModel();
        $data = $model->getNoHarga();
        return $this->respond($data, 200);
    }
    function hargaAll()
    {
        $model = new HargaModel();
        $data = $model->getHarga();
        return $this->respond($data, 200);
    }
    function galeri()
    {
        $data = $this->model->getGaleri();
        return $this->respond($data, 200);
    }
    function harga()
    {
        $subkategori_id = $this->request->getVar('subkategori_id');
        $kondisi_id = $this->request->getVar('kondisi_id');
        $jumlah = $this->request->getVar('jumlah');
        $data['harga'] = 0;

        $hargaModel = new HargaModel();
        $harga = $hargaModel->findHarga($subkategori_id, $kondisi_id);
        if ($harga != null) {
            $data['harga'] = $harga->harga_nilai * $jumlah;
        }
        return $this->respond($data, 200);
    }
}
