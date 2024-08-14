<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SalesModel;
use App\Models\SaleItemModel;

class Home extends BaseController
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
        $this->saleItemModel = new SaleItemModel();
    }

    public function index(): string|RedirectResponse
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        session()->remove('cart');

        $data = [
            'productCount' => $this->productModel->countAllResults(),
            'categoryCount' => $this->categoryModel->countAllResults(),
            'totalStock' => $this->productModel->selectSum('stock')->get()->getRow()->stock,
            'products' => $this->productModel->select('products.*, categories.name as category_name')
                ->join('categories', 'categories.id = products.category_id')
                ->findAll()
        ];

        return view('home', $data);
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
            $saleData = [
                'user_id' => session()->get('user_id'),
                'total_price' => $totalPrice,
                'payment_method' => 'cash',
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

            return $this->response->setJSON(['success' => true, 'message' => 'Checkout berhasil']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['success' => false, 'message' => 'Checkout gagal: ' . $e->getMessage()]);
        }
    }
}
