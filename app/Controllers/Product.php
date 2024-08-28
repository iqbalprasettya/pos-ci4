<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->to('/login');
        }

        $userRole = session()->get('role');
        $branchId = session()->get('branch_id');

        $data['categories'] = $this->categoryModel->findAll();

        if ($userRole === 'owner') {
            $data['products'] = $this->productModel->findAll();
        } else {
            $data['products'] = $this->productModel->where('branch_id', $branchId)->findAll();
        }

        // Hitung jumlah produk dan total stok untuk setiap kategori
        $categoryProductCounts = [];
        $categoryStockCounts = [];
        $totalStock = 0;
        foreach ($data['categories'] as $category) {
            if ($userRole === 'owner') {
                $products = $this->productModel->where('category_id', $category['id'])->findAll();
            } else {
                $products = $this->productModel->where('category_id', $category['id'])
                                               ->where('branch_id', $branchId)
                                               ->findAll();
            }
            $categoryProductCounts[$category['id']] = count($products);
            $categoryStockCounts[$category['id']] = array_sum(array_column($products, 'stock'));
            $totalStock += $categoryStockCounts[$category['id']];
        }

        // Urutkan kategori berdasarkan jumlah stok (dari besar ke kecil)
        arsort($categoryStockCounts);

        $data['categoryProductCounts'] = $categoryProductCounts;
        $data['categoryStockCounts'] = $categoryStockCounts;
        $data['totalStock'] = $totalStock;

        // Jika sudah login, tampilkan halaman home
        return $this->render('product/index', $data);
    }

    public function addCategory()
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->to('/login');
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description')
            ];

            // dd($data);
            $this->categoryModel->insert($data);
            return redirect()->to('/product')->with('success', 'Kategori berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->back();
    }

    public function updateCategory($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->to('/login');
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description')
            ];

            $this->categoryModel->update($id, $data);
            return redirect()->to('/product')->with('success', 'Kategori berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function deleteCategory($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('/product')->with('success', 'Kategori berhasil dihapus');
    }

    public function addProduct()
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'category_id' => 'required|is_not_unique[categories.id]',
            'description' => 'permit_empty|max_length[1000]',
            'price' => 'required',
            'stock' => 'required|integer'
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'category_id' => $this->request->getPost('category_id'),
                'description' => $this->request->getPost('description'),
                'price' => $this->cleanRupiahFormat($this->request->getPost('price')),
                'stock' => $this->request->getPost('stock'),
                'branch_id' => session()->get('branch_id')
            ];

            // Simpan produk ke database
            $this->productModel->insert($data);
            return redirect()->to('/product')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function updateProduct($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $branchId = session()->get('branch_id');
        $product = $this->productModel->where('id', $id)->where('branch_id', $branchId)->first();

        if (!$product) {
            return redirect()->to('/product')->with('error', 'Produk tidak ditemukan');
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'category_id' => 'required|is_not_unique[categories.id]',
            'description' => 'permit_empty|max_length[1000]',
            'price' => 'required',
            'stock' => 'required|integer'
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'category_id' => $this->request->getPost('category_id'),
                'description' => $this->request->getPost('description'),
                'price' => $this->cleanRupiahFormat($this->request->getPost('price')),
                'stock' => $this->request->getPost('stock')
            ];

            $this->productModel->update($id, $data);
            return redirect()->to('/product')->with('success', 'Produk berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function deleteProduct($id)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $branchId = session()->get('branch_id');
        $product = $this->productModel->where('id', $id)->where('branch_id', $branchId)->first();

        if (!$product) {
            return redirect()->to('/product')->with('error', 'Produk tidak ditemukan');
        }

        $this->productModel->delete($id);
        return redirect()->to('/product')->with('success', 'Produk berhasil dihapus');
    }

    private function cleanRupiahFormat($rupiahString)
    {
        // Hapus semua karakter kecuali angka dan koma
        $numericString = preg_replace('/[^0-9,]/', '', $rupiahString);
        // Ganti koma dengan titik untuk format desimal
        return str_replace(',', '.', $numericString);
    }
}