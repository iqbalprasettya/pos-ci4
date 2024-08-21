<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleItemModel extends Model
{
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sale_id', 'product_id', 'quantity', 'price'];

    public function getSaleItems($saleId)
    {
        return $this->select('sale_items.*, products.name as product_name')
            ->join('products', 'products.id = sale_items.product_id')
            ->where('sale_id', $saleId)
            ->findAll();
    }
}