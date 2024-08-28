<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['transaction_number', 'user_id', 'total_price', 'payment_method', 'branch_id'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField = ''; // Kosongkan ini jika tidak ada kolom updated_at  

    public function getUser()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id', 'id');
    }

    public function getBranch()
    {
        return $this->belongsTo('App\Models\BranchModel', 'branch_id', 'id');
    }

    public function getSaleItems()
    {
        return $this->hasMany('App\Models\SaleItemModel', 'sale_id', 'id');
    }

    public function getTransactions($branchId = null)
    {
        $builder = $this->select('sales.*, users.username, branches.name as branch_name')
            ->join('users', 'users.id = sales.user_id')
            ->join('branches', 'branches.id = sales.branch_id');
        
        if ($branchId !== null) {
            $builder->where('sales.branch_id', $branchId);
        }
        
        return $builder->orderBy('sales.created_at', 'DESC')->findAll();
    }

    public function getSalesSummary($branchId = null)
    {
        $builder = $this->select('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('DATE(created_at)')
            ->orderBy('DATE(created_at)', 'ASC');

        if ($branchId !== null && $branchId !== 'all') {
            $builder->where('branch_id', $branchId);
        }

        return $builder->findAll();
    }

    public function getDailySalesData($branchId = null, $startDateTime, $endDateTime, $paymentMethod = null)
    {
        $builder = $this->select('DATE(created_at) as date, COUNT(*) as total_transactions, SUM(total_price) as total_revenue')
            ->where('created_at >=', $startDateTime)
            ->where('created_at <=', $endDateTime)
            ->groupBy('DATE(created_at)')
            ->orderBy('DATE(created_at)', 'ASC');

        if ($branchId !== null && $branchId !== 'all') {
            $builder->where('branch_id', $branchId);
        }

        if ($paymentMethod && $paymentMethod !== 'all') {
            $builder->where('payment_method', $paymentMethod);
        }

        return $builder->findAll();
    }

    public function getTransactionsData($branchId = null, $startDateTime, $endDateTime, $paymentMethod = null)
    {
        $builder = $this->select('sales.*, DATE(sales.created_at) as sale_date, branches.name as branch_name')
            ->join('branches', 'branches.id = sales.branch_id')
            ->where('sales.created_at >=', $startDateTime)
            ->where('sales.created_at <=', $endDateTime)
            ->orderBy('sales.created_at', 'ASC');

        if ($branchId !== null && $branchId !== 'all') {
            $builder->where('sales.branch_id', $branchId);
        }

        if ($paymentMethod && $paymentMethod !== 'all') {
            $builder->where('sales.payment_method', $paymentMethod);
        }

        return $builder->findAll();
    }
}