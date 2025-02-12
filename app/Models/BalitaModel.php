<?php

namespace App\Models;

use CodeIgniter\Model;

class BalitaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'balita';
    protected $primaryKey       = 'balita_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'balita_nama',
        'balita_jk',
        'balita_umur',
        'balita_tgllahir',
        'balita_orangtua',
        'balita_alamat',
        'dusun_id',
        'user_id',
        'balita_long',
        'balita_lat',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'balita_nama' => 'required',
        'balita_jk' => 'required',
        'balita_umur' => 'required',
        'balita_tgllahir' => 'required',
        'balita_orangtua' => 'required',
        'balita_alamat' => 'required',
        'dusun_id' => 'required',
        // 'balita_long' => 'required',
        // 'balita_lat' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findBalita($balita_id = null, $kelurahan_id = null)
    {
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->join('kelurahan', 'dusun.kelurahan_id = kelurahan.kelurahan_id');
        $this->join('user', 'user.user_id = balita.user_id', 'left');
        if ($balita_id == null) {
            return $this->find();
        }
        if ($kelurahan_id != null) {
            $this->where('dusun.kelurahan_id', $kelurahan_id);
        }
        return $this->find($balita_id);
    }

    public function byDusun($dusun_id)
    {
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->where('balita.dusun_id', $dusun_id);
        return $this->find();
    }
    public function byPosyandu($posyandu_id)
    {
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->join('kelurahan', 'dusun.kelurahan_id = kelurahan.kelurahan_id');
        $this->where('dusun.posyandu_id', $posyandu_id);
        return $this->find();
    }

    public function belumPeriksa($periode_id, $posyandu_id = null)
    {
        $this->where("NOT EXISTS (SELECT * FROM hasilukur WHERE periode_id = '$periode_id' AND hasilukur.balita_id = balita.balita_id)", null, false);
        $this->where('balita_umur <=', 59, true);
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        if ($posyandu_id != null) {
            $this->where('dusun.posyandu_id', $posyandu_id);
        }
        return $this->find();
    }
    public function sudahPeriksa($periode_id, $posyandu_id = null)
    {
        $this->where("EXISTS (SELECT * FROM hasilukur WHERE periode_id = '$periode_id' AND hasilukur.balita_id = balita.balita_id)", null, false);
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = dusun.kelurahan_id');
        if ($posyandu_id != null)
            $this->where('dusun.posyandu_id', $posyandu_id);
        return $this->find();
    }

    public function byNama($nama)
    {
        $this->like('balita_nama', '%' . $nama . '%');
        return $this->find();
    }

    function findJumlahBalita($posyandu_id = null)
    {
        $this->selectCount('balita_id', 'jumlah');
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->where('balita_umur <= ', 59, true);
        if ($posyandu_id != null)
            $this->where('dusun.posyandu_id', $posyandu_id);
        return $this->first();
    }
    function findByKelurahan($kelurahan_id = null)
    {
        $this->selectCount('balita_id', 'jumlah');
        $this->join('dusun', 'dusun.dusun_id = balita.dusun_id');
        $this->where('balita_umur <= ', 59, true);
        if ($kelurahan_id != null)
            $this->where('dusun.kelurahan_id', $kelurahan_id);
        return $this->first();
    }
    function findCetak($periode_id, $posyandu_id = null)
    {
        $this->join('hasilukur', 'hasilukur.balita_id = balita.balita_id');
        $this->join('posyandu', 'posyandu.posyandu_id = balita.posyandu_id');
        $this->where('hasilukur.periode_id', $periode_id);
        if ($posyandu_id != null)
            $this->where('balita.posyandu_id', $posyandu_id);
        $this->orderBy('balita.posyandu_id');
        return $this->find();
    }
}
