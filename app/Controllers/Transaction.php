<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Transaction extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $salesModel;
    protected $saleItemModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->salesModel = new SalesModel();
        // $this->saleItemModel = new SaleItemModel();
    }
    public function index(): string|RedirectResponse
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        session()->remove('cart');

        $today = date('Y-m-d');
        $totalTransactions = $this->salesModel->countAllResults();
        $todayTransactions = $this->salesModel->where('DATE(created_at)', $today)->countAllResults();
        $totalIncome = $this->salesModel->selectSum('total_price')->get()->getRow()->total_price;

        $transactions = $this->salesModel->select('sales.*, users.username')
            ->join('users', 'users.id = sales.user_id')
            ->orderBy('sales.created_at', 'DESC')
            ->findAll();

        $data = [
            'productCount' => $this->productModel->countAllResults(),
            'categoryCount' => $this->categoryModel->countAllResults(),
            'totalStock' => $this->productModel->selectSum('stock')->get()->getRow()->stock,
            'totalTransactions' => $totalTransactions,
            'todayTransactions' => $todayTransactions,
            'totalIncome' => $totalIncome,
            'transactions' => $transactions
        ];

        return $this->render('Transaction/index', $data);
    }
}
