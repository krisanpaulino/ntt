<?php

namespace App\Models;

use CodeIgniter\Model;

class PosyanduModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'posyandu';
    protected $primaryKey       = 'posyandu_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['posyandu_nama', 'posyandu_foto', 'kelurahan_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'posyandu_nama' => 'required',
        // 'posyandu_foto' => 'required'
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

    function byKelurahan($kelurahan_id)
    {
        $this->where('posyandu.kelurahan_id', $kelurahan_id);
        $this->join('kelurahan', 'kelurahan.kelurahan_id = posyandu.kelurahan_id');
        return $this->find();
    }
}
