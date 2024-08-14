<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['category_id', 'name', 'description', 'price', 'stock']; // Field yang diizinkan untuk diisi
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
