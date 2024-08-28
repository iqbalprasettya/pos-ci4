<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleItemModel extends Model
{
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sale_id', 'product_id', 'quantity', 'price'];

    public function getSaleItems($saleId, $branchId = null)
    {
        $builder = $this->select('sale_items.*, products.name as product_name')
            ->join('products', 'products.id = sale_items.product_id')
            ->join('sales', 'sales.id = sale_items.sale_id')
            ->where('sale_items.sale_id', $saleId);
        
        if ($branchId !== null) {
            $builder->where('sales.branch_id', $branchId);
        }
        
        return $builder->findAll();
    }
}