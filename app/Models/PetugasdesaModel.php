<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasdesaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugasdesa';
    protected $primaryKey       = 'petugasdesa_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'petugasdesa_nama',
        'petugasdesa_jk',
        'petugasdesa_tempatlahir',
        'petugasdesa_tgllahir',
        'petugasdesa_alamat',
        'petugasdesa_hp',
        'user_id',
        'kelurahan_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'petugasdesa_nama' => 'required',
        'petugasdesa_jk' => 'required',
        'petugasdesa_tempatlahir' => 'required',
        'petugasdesa_tgllahir' => 'required',
        'petugasdesa_alamat' => 'required',
        'petugasdesa_hp' => 'required',
        'kelurahan_id' => 'required'
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

        $this->join('user', 'user.user_id = petugasdesa.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = petugasdesa.kelurahan_id');
        if ($petugas_id != null) {
            $this->where('petugasdesa_id', $petugas_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }
    public function findUserPetugas($user_id = null)
    {

        $this->join('user', 'user.user_id = petugasdesa.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = petugasdesa.kelurahan_id');
        if ($user_id != null) {
            $this->where('petugasdesa.user_id', $user_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }

    public function findByDesa($kelurahan_id)
    {
        $this->join('user', 'user.user_id = petugasdesa.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = petugasdesa.kelurahan_id');
        $this->where('petugasdesa.kelurahan_id', $kelurahan_id);
        return $this->find();
    }
}
