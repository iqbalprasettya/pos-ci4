<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SalesModel;
use App\Models\SaleItemModel;
use App\Models\StoreSettingsModel;

class Home extends BaseController
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
            'products' => $this->productModel->select('products.*, categories.name as category_name')
                ->join('categories', 'categories.id = products.category_id')
                ->findAll(),
            'transactions' => $transactions,
            'store_name' => $this->storeSettings->getSetting('store_name'),
            'store_address' => $this->storeSettings->getSetting('store_address'),
            'store_phone' => $this->storeSettings->getSetting('store_phone'),
            'store_email' => $this->storeSettings->getSetting('store_email'),
            'footer_text' => $this->storeSettings->getSetting('footer_text'),
            'saleItemModel' => $this->saleItemModel,
        ];

        return $this->render('home', $data);
    }

    public function addToCart()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $productId = $this->request->getJSON()->productId;
        $product = $this->productModel->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id')
            ->find($productId);

        if (!$product) {
            return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan']);
        }

        $cart = session()->get('cart') ?? [];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $cart[$productId]['total'] = $cart[$productId]['quantity'] * $product['price'];
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'category' => $product['category_name'],
                'price' => $product['price'],
                'quantity' => 1,
                'stock' => $product['stock'],
                'total' => $product['price']
            ];
        }

        session()->set('cart', $cart);

        return $this->response->setJSON([
            'success' => true,
            'cart' => array_values($cart)
        ]);
    }

    public function updateCartQuantity()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $productId = $this->request->getJSON()->productId;
        $newQuantity = $this->request->getJSON()->quantity;

        $cart = session()->get('cart') ?? [];

        if (!isset($cart[$productId])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan di keranjang']);
        }

        $cart[$productId]['quantity'] = $newQuantity;
        $cart[$productId]['total'] = $newQuantity * $cart[$productId]['price'];

        session()->set('cart', $cart);

        return $this->response->setJSON([
            'success' => true,
            'cart' => array_values($cart)
        ]);
    }

    public function removeFromCart()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $productId = $this->request->getJSON()->productId;
        $cart = session()->get('cart') ?? [];

        if (!isset($cart[$productId])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan di keranjang']);
        }

        unset($cart[$productId]);
        session()->set('cart', $cart);

        return $this->response->setJSON([
            'success' => true,
            'cart' => array_values($cart)
        ]);
    }

    public function checkout()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Keranjang kosong']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $totalPrice = array_sum(array_column($cart, 'total'));
            
            // Membuat nomor transaksi
            $transactionNumber = 'TRX' . date('YmdHis') . rand(1000, 9999);
            
            $saleData = [
                'user_id' => session()->get('user_id'),
                'total_price' => $totalPrice,
                'payment_method' => 'cash',
                'transaction_number' => $transactionNumber, // Menambahkan nomor transaksi
            ];

            $this->salesModel->insert($saleData);
            $saleId = $db->insertID();

            if (!$saleId) {
                throw new \Exception('Gagal menyimpan data penjualan');
            }

            foreach ($cart as $item) {
                $saleItemData = [
                    'sale_id' => $saleId,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['total'],
                ];

                $this->saleItemModel->insert($saleItemData);

                $product = $this->productModel->find($item['id']);
                $newStock = $product['stock'] - $item['quantity'];
                $this->productModel->update($item['id'], ['stock' => $newStock]);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi gagal');
            }

            session()->remove('cart');

            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Checkout berhasil',
                'transaction_number' => $transactionNumber // Mengembalikan nomor transaksi
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['success' => false, 'message' => 'Checkout gagal: ' . $e->getMessage()]);
        }
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