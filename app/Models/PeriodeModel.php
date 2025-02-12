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
        'periode_bulan' => 'required',
        'periode_tahun' => 'required',
        'periode_status' => 'required',
        'kelurahan_id' => 'required',
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

    public function findBuka($kelurahan_id = null)
    {
        if ($kelurahan_id != null)
            $this->where('periode.kelurahan_id', $kelurahan_id);
        $this->where('periode_status', 'buka');
        return $this->first();
    }
    public function findUrutan($kelurahan_id = null)
    {
        if ($kelurahan_id != null)
            $this->where('periode.kelurahan_id', $kelurahan_id);
        $this->orderBy('periode_id', 'desc');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = periode.kelurahan_id');
        if (user()->user_type == 'superadmin') {
            $this->join('kecamatan', 'kecamatan.kecamatan_id = kelurahan.kecamatan_id');
            $this->join('kabupaten', 'kabupaten.kabupaten_id = kecamatan.kabupaten_id');
        }
        return $this->find();
    }
}
