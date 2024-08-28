<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'name', 'description', 'price', 'stock', 'branch_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'category_id' => 'required|integer',
        'name'        => 'required|min_length[3]|max_length[255]',
        'price'       => 'required|numeric',
        'stock'       => 'required|integer',
        'branch_id'   => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getCategory()
    {
        return $this->belongsTo('App\Models\CategoryModel', 'category_id', 'id');
    }

    public function getBranch()
    {
        return $this->belongsTo('App\Models\BranchModel', 'branch_id', 'id');
    }
}