<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ProdukModel;

class KeranjangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'keranjang';
    protected $primaryKey       = 'id_keranjang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_customer',
        'kode_produk',
        'qty',
        'total_harga',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    public function Produk()
    {
        return $this->hasMany(ProdukModel::class, 'kode_produk', 'kode_produk');
    }
}
