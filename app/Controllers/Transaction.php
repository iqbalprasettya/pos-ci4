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
            'transactions' => $transactions,
            'store_name' => $this->storeSettings->getSetting('store_name'),
            'store_address' => $this->storeSettings->getSetting('store_address'),
            'store_phone' => $this->storeSettings->getSetting('store_phone'),
            'store_email' => $this->storeSettings->getSetting('store_email'),
            'footer_text' => $this->storeSettings->getSetting('footer_text'),
            'saleItemModel' => $this->saleItemModel,
        ];

        return $this->render('Transaction/index', $data);
    }

    public function getTransactionDetails($transactionId)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $sale = $this->salesModel->find($transactionId);
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