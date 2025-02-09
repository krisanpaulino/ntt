<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{

    function getJenis($jenis_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('jenis');
        if ($jenis_id != null) {
            $builder->where('jenis_id', $jenis_id);
            return $builder->get()->getRowObject();
        }
        return $builder->get()->getResultObject();
    }
    function getKabupaten($kabupaten_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('kabupaten');
        if ($kabupaten_id != null) {
            $builder->where('kabupaten_id', $kabupaten_id);
            return $builder->get()->getRowObject();
        }
        return $builder->get()->getResultObject();
    }
    function getKecamatan($kabupaten_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('kecamatan');
        $builder->join('kabupaten', 'kabupaten.kabupaten_id = kecamatan.kabupaten_id');
        if ($kabupaten_id != null) {
            $builder->where('kecamatan.kabupaten_id', $kabupaten_id);
            // return $builder->get()->getRowObject();
        }
        return $builder->get()->getResultObject();
    }
    function getKelurahan($kecamatan_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('kelurahan');
        $builder->join('kecamatan', 'kecamatan.kecamatan_id = kelurahan.kecamatan_id');
        if ($kecamatan_id != null) {
            $builder->where('kelurahan.kecamatan_id', $kecamatan_id);
            // return $builder->get()->getRowObject();
        }
        return $builder->get()->getResultObject();
    }
    function getDusun($kelurahan_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('dusun');
        $builder->join('kelurahan', 'dusun.kelurahan_id = kelurahan.kelurahan_id');
        $builder->join('posyandu', 'dusun.posyandu_id = posyandu.posyandu_id');
        if ($kelurahan_id != null) {
            $builder->where('kelurahan.kelurahan_id', $kelurahan_id);
            // return $builder->get()->getRowObject();
        }
        return $builder->get()->getResultObject();
    }
    function subDetail($id)
    {
        $builder = $this->db->table('subkategori');
        $builder->where('subkategori_id', $id);
        $builder->join('kategori', 'kategori.kategori_id = subkategori.kategori_id');
        return $builder->get()->getRowObject();
    }
    function detail($id, $table)
    {
        $builder = $this->db->table($table);
        $builder->where($table . '_id', $id);
        return $builder->get()->getRowObject();
    }
    function hargaDetail($id)
    {
        $builder = $this->db->table('harga');
        $builder->where('harga_id', $id);
        $builder->join('subkategori', 'subkategori.subkategori_id = harga.subkategori_id');
        $builder->join('kondisi', 'kondisi.kondisi_id = harga.kondisi_id');
        return $builder->get()->getRowObject();
    }
    function getHarga($subkategori_id = null, $kondisi_id = null)
    {
        // $db = \Config\Database::connect();
        $builder = $this->db->table('harga');
        $builder->join('kondisi', 'kondisi.kondisi_id = harga.kondisi_id');
        $builder->join('subkategori', 'subkategori.subkategori_id = harga.subkategori_id');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.kategori_id', 'left');
        // $builder->join('jenis', 'jenis.jenis_id = kategori.jenis_id');
        $builder->where('subkategori.deleted', '0');
        $builder->where('harga.deleted', '0');
        if ($subkategori_id != null && $kondisi_id != null) {
            $builder->where('harga.subkategori_id', $subkategori_id);
            $builder->where('harga.kondisi_id', $kondisi_id);
            return $builder->get()->getRowObject();
        }
        if ($subkategori_id != null)
            $builder->where('harga.subkategori_id', $subkategori_id);
        return $builder->get()->getResultObject();
    }
    function getNoHarga()
    {
        $builder = $this->db->table('subkategori, kondisi');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.kategori_id', 'left');
        $builder->where('NOT EXISTS(Select * From harga a where a.kondisi_id = kondisi.kondisi_id and a.subkategori_id = subkategori.subkategori_id)', null, false);
        $builder->where('subkategori.deleted', '0');
        $builder->where('kondisi.deleted', '0');
        // return $builder->getCompiledSelect();
        return $builder->get()->getResultObject();
    }
    function getRT()
    {
        $builder = $this->db->table('rt');
        return $builder->get()->getRowObject();
    }
    function getKondisi()
    {
        $builder = $this->db->table('kondisi');
        return $builder->get()->getResultObject();
    }
    function getMaster($table, bool $deleted = true)
    {
        $builder = $this->db->table($table);
        if ($deleted)
            $builder->where('deleted', '0');
        return $builder->get()->getResultObject();
    }

    function insertDataBatch($table, $data)
    {
        $builder = $this->db->table($table);
        return $builder->insertBatch($data);
    }
    function saveData($table, $id = null, array $data)
    {
        $builder = $this->db->table($table);
        if ($id == null) {
            return $builder->insert($data);
        } else {
            $builder->where($table . '_id', $id);
            $builder->set($data);
            return $builder->update();
        }
    }
    function deleteData($table, $id)
    {
        $builder = $this->db->table($table);
        $builder->where($table . '_id', $id);
        return $builder->delete();
    }
    function getGaleri()
    {
        $builder = $this->db->table('galeri');
        $builder->select("galeri_id, CONCAT('https://banksampah.unwira.com/assets/images/bs/', galeri_file) as file");
        return $builder->get()->getResultObject();
    }
}
