<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admin';
    protected $primaryKey       = 'admin_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_nama',
        'admin_jk',
        'admin_tempatlahir',
        'admin_tgllahir',
        'admin_alamat',
        'admin_hp',
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
        'admin_nama' => 'required',
        'admin_jk' => 'required',
        'admin_tempatlahir' => 'required',
        'admin_tgllahir' => 'required',
        'admin_alamat' => 'required',
        'admin_hp' => 'required',
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

    public function findAdmin($admin_id = null)
    {

        $this->join('user', 'user.user_id = admin.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = admin.kelurahan_id');
        if ($admin_id != null) {
            $this->where('admin_id', $admin_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }
    public function findUserAdmin($user_id = null)
    {

        $this->join('user', 'user.user_id = admin.user_id');
        $this->join('kelurahan', 'kelurahan.kelurahan_id = admin.kelurahan_id');
        if ($user_id != null) {
            $this->where('admin.user_id', $user_id);
            return $this->first();
        } else {
            return $this->find();
        }
    }

    public function findByDesa($kelurahan_id)
    {
        $this->where('kelurahan_id', $kelurahan_id);
        return $this->find();
    }
}
