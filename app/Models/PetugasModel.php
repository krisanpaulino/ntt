<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugas';
    protected $primaryKey       = 'petugas_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'petugas_nama',
        'petugas_jk',
        'petugas_tempatlahir',
        'petugas_tgllahir',
        'petugas_alamat',
        'petugas_hp',
        'user_id',
        'posyandu_id',
        'petugas_foto'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'petugas_nama' => 'required',
        'petugas_jk' => 'required',
        'petugas_tempatlahir' => 'required',
        'petugas_tgllahir' => 'required',
        'petugas_alamat' => 'required',
        'petugas_hp' => 'required',
        'posyandu_id' => 'required'
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

    public function findPetugas($petugas_id = null)
    {

        $this->join('user', 'user.user_id = petugas.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = petugas.kelurahan_id');
        $this->join('posyandu', 'posyandu.posyandu_id = petugas.posyandu_id');
        if ($petugas_id != null) {
            $this->where('petugas_id', $petugas_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }
    public function findUserPetugas($user_id = null)
    {

        $this->join('user', 'user.user_id = petugas.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = petugas.kelurahan_id');
        $this->join('posyandu', 'posyandu.posyandu_id = petugas.posyandu_id');
        if ($user_id != null) {
            $this->where('petugas.user_id', $user_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }

    public function findByPos($posyandu_id)
    {
        $this->where('posyandu_id', $posyandu_id);
        return $this->find();
    }
}
