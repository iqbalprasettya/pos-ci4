<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'total_price', 'payment_method', 'transaction_number'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; // Kosongkan ini jika tidak ada kolom updated_at
}