<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\SalesModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SaleItemModel;
use App\Models\StoreSettingsModel;

class Transaction extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $salesModel;
    protected $saleItemModel;
    protected $storeSettings;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->salesModel = new SalesModel();
        $this->saleItemModel = new SaleItemModel();
        $this->storeSettings = new StoreSettingsModel();
    }

    public function index(): string|RedirectResponse
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userRole = session()->get('role');
        $branchId = session()->get('branch_id');
        $today = date('Y-m-d');

        if ($userRole === 'owner') {
            $totalTransactions = $this->salesModel->countAllResults();
            $todayTransactions = $this->salesModel->where('DATE(created_at)', $today)->countAllResults();
            $totalIncome = $this->salesModel->selectSum('total_price')->get()->getRow()->total_price;

            $transactions = $this->salesModel->select('sales.*, users.username, branches.name as branch_name')
                ->join('users', 'users.id = sales.user_id')
                ->join('branches', 'branches.id = sales.branch_id')
                ->orderBy('sales.created_at', 'DESC')
                ->findAll();

            $totalStock = $this->productModel->selectSum('stock')->get()->getRow()->stock;
        } else {
            $totalTransactions = $this->salesModel->where('branch_id', $branchId)->countAllResults();
            $todayTransactions = $this->salesModel->where('DATE(created_at)', $today)->where('branch_id', $branchId)->countAllResults();
            $totalIncome = $this->salesModel->selectSum('total_price')->where('branch_id', $branchId)->get()->getRow()->total_price;

            $transactions = $this->salesModel->select('sales.*, users.username, branches.name as branch_name')
                ->join('users', 'users.id = sales.user_id')
                ->join('branches', 'branches.id = sales.branch_id')
                ->where('sales.branch_id', $branchId)
                ->orderBy('sales.created_at', 'DESC')
                ->findAll();

            $totalStock = $this->productModel->selectSum('stock')->where('branch_id', $branchId)->get()->getRow()->stock;
        }

        $categoryCount = $this->categoryModel->countAllResults();

        $data = [
            'totalTransactions' => $totalTransactions,
            'todayTransactions' => $todayTransactions,
            'totalIncome' => $totalIncome,
            'transactions' => $transactions,
            'totalStock' => $totalStock,
            'categoryCount' => $categoryCount,
            'store_name' => $this->storeSettings->getSetting('store_name'),
            'store_address' => $this->storeSettings->getSetting('store_address'),
            'store_phone' => $this->storeSettings->getSetting('store_phone'),
            'store_email' => $this->storeSettings->getSetting('store_email'),
            'footer_text' => $this->storeSettings->getSetting('footer_text'),
            'saleItemModel' => $this->saleItemModel,
        ];

        return $this->render('transaction/index', $data);
    }

    public function getTransactionDetails($transactionId)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $branchId = session()->get('branch_id');
        $sale = $this->salesModel->where('id', $transactionId)->where('branch_id', $branchId)->first();
        if (!$sale) {
            return $this->response->setJSON(['success' => false, 'message' => 'Transaksi tidak ditemukan']);
        }

        $saleItems = $this->saleItemModel->select('sale_items.*, products.name as product_name')
            ->join('products', 'products.id = sale_items.product_id')
            ->where('sale_id', $transactionId)
            ->findAll();

        $details = [];
        foreach ($saleItems as $item) {
            $details[] = [
                'name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'] / $item['quantity'], // Harga per item
                'subtotal' => $item['price']
            ];
        }

        return $this->response->setJSON([
            'success' => true,
            'transaction' => $sale,
            'details' => $details
        ]);
    }
}
