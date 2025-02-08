<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'periode';
    protected $primaryKey       = 'periode_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'periode_bulan',
        'periode_tahun',
        'periode_status',
        'posyandu_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'periode_bulan' => 'required',
        'periode_tahun' => 'required',
        'periode_status' => 'required',
        'posyandu_id' => 'required',
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

    public function findBuka($posyandu_id = null)
    {
        if ($posyandu_id != null)
            $this->where('posyandu_id', $posyandu_id);
        $this->where('periode_status', 'buka');
        return $this->first();
    }
    public function findUrutan($posyandu_id = null)
    {
        if ($posyandu_id != null)
            $this->where('posyandu_id', $posyandu_id);
        $this->orderBy('periode_id', 'desc');
        return $this->find();
    }
}
