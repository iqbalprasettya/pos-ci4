<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dasbor
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-md-7">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M11.5 21h-2.926a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304h11.339a2 2 0 0 1 1.977 2.304l-.5 3.248" />
                                                        <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                        <path d="M15 19l2 2l4 -4" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <?= $totalStock ?> Produk
                                                </div>
                                                <div class="text-secondary">
                                                    <?= $categoryCount ?> Kategori
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-twitter text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17h-11v-14h-2" />
                                                        <path d="M6 5l14 1l-1 7h-13" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <?= $totalTransactions ?> Transaksi
                                                </div>
                                                <div class="text-secondary">
                                                    <?= $todayTransactions ?> Hari ini
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-green text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-businessplan">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                                        <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                                        <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                        <path d="M5 15v1m0 -8v1" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    Rp <?= number_format($totalIncome, 0, ',', '.') ?> Masuk
                                                </div>
                                                <div class="text-secondary">
                                                    <?= $totalTransactions ?> Transaksi
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Semua Produk</h3>
                            </div>
                            <div class="card-body">
                                <div id="table-default" class="table-responsive">
                                    <table id="tableCashier" class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $index => $product): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $product['name'] ?></td>
                                                    <td><?= $product['category_name'] ?></td>
                                                    <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                                                    <td><?= $product['stock'] ?></td>
                                                    <td>
                                                        <?php if ($product['stock'] > 0): ?>
                                                            <button class="btn btn-success btn-sm btn-icon cart-action" data-product-id="<?= $product['id'] ?>" data-action="add">+</button>
                                                        <?php else: ?>
                                                            <span class=" text-center badge bg-red text-red-fg">Stok Habis</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                </svg>
                                Daftar Produk
                            </h3>
                        </div>
                        <div class="card-body" style="min-height: 600px; position: relative; padding-bottom: 150px;">
                            <div style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-transparent table-responsive" id="cartTable">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Qnt</th>
                                            <th class="text-end">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Keranjang akan diperbarui di sini -->
                                    </tbody>
                                </table>
                            </div>

                            <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;" class="border-top border-2">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="font-weight-bold strong text-uppercase">Total</span>
                                    <span class="font-weight-bold" id="cartTotal">Rp 0</span>
                                </div>

                                <div class="text-center mt-3">
                                    <button class="btn btn-primary" id="checkoutButton" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                                        </svg>
                                        Checkout
                                    </button>
                                </div>

                                <p class="text-secondary text-center mt-3">Terima kasih banyak telah berbisnis dengan kami. Kami berharap dapat bekerja sama dengan Anda lagi!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div id="table-default" class="table-responsive">
                            <table id="tableTransaction" class="table mb-2">
                                <thead>
                                    <tr>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Harga</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Kasir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $transaction): ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="transaction-link" data-transaction-id="<?= $transaction['id'] ?>">
                                                    <?= $transaction['transaction_number'] ?>
                                                </a>
                                            </td>
                                            <td><?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></td>
                                            <td>Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                                            <td><?= ucfirst($transaction['payment_method']) ?></td>
                                            <td>Kasir</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="showTransactionDetails(<?= $transaction['id'] ?>)">
                                                    Detail
                                                </button>
                                                <!-- Tombol untuk membuka modal -->
                                                <button type="button" class="btn btn-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report-<?= $transaction['id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                    </svg>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal modal-blur fade" id="modal-report-<?= $transaction['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Invoice Transaksi</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card card-lg" id="invoicePrint-<?= $transaction['id'] ?>">
                                                                    <div class="card-body">
                                                                        <div class="row justify-content-center">
                                                                            <div class="col-6 text-center">
                                                                                <h1><?= $store_name ?></h1>
                                                                                <address>
                                                                                    <?= $store_address ?><br>
                                                                                    <?= $store_phone ?><br>
                                                                                    <?= $store_email ?>
                                                                                </address>
                                                                            </div>
                                                                            <div class="col-12 my-5">
                                                                                <h3>Invoice <?= $transaction['transaction_number'] ?></h3>
                                                                                <p>Tanggal: <?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <table class="table table-transparent table-responsive">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center" style="width: 1%">No</th>
                                                                                    <th>Produk</th>
                                                                                    <th class="text-center" style="width: 1%">Jumlah</th>
                                                                                    <th class="text-end" style="width: 1%">Harga</th>
                                                                                    <th class="text-end" style="width: 1%">Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php 
                                                                                $items = $saleItemModel->getSaleItems($transaction['id']);
                                                                                foreach ($items as $index => $item): 
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="text-center"><?= $index + 1 ?></td>
                                                                                    <td>
                                                                                        <p class="strong mb-1"><?= $item['product_name'] ?></p>
                                                                                    </td>
                                                                                    <td class="text-center"><?= $item['quantity'] ?></td>
                                                                                    <td class="text-end" style="white-space: nowrap;">Rp <?= number_format($item['price'] / $item['quantity'], 0, ',', '.') ?></td>
                                                                                    <td class="text-end" style="white-space: nowrap;">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                                                                </tr>
                                                                                <?php endforeach; ?>
                                                                                <tr>
                                                                                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Total</td>
                                                                                    <td class="font-weight-bold text-end" style="white-space: nowrap;">Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="text-secondary text-center mt-5"><?= $footer_text ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                                                    Tutup
                                                                </button>
                                                                <button type="button" class="btn btn-primary ms-auto" onclick="generateReport(<?= $transaction['id'] ?>)">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                                    </svg>
                                                                    Print Invoice
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk detail transaksi -->
    <div class="modal modal-blur fade" id="transactionDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="transactionDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>

    <!-- javascript section -->
    <?= $this->section('javascript') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        new DataTable('#tableCashier', {
            responsive: true
        });

        new DataTable('#tableTransaction', {
            responsive: true,
            order: [
                [1, 'desc']
            ] // Mengurutkan berdasarkan kolom kedua (indeks 1) secara descending
        });

        // Fungsi untuk menambahkan produk ke keranjang
        function addToCart(productId) {
            fetch('/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        productId: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCart(data.cart);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }

        // Fungsi untuk memperbarui tampilan keranjang
        function updateCart(cart) {
            const cartTable = document.getElementById('cartTable').getElementsByTagName('tbody')[0];
            const cartTotal = document.getElementById('cartTotal');
            const checkoutButton = document.getElementById('checkoutButton');

            cartTable.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const row = cartTable.insertRow();
                row.innerHTML = `
                    <td>
                        <p class="strong mb-1">${item.name}</p>
                        <div class="text-secondary">${item.category}</div>
                    </td>
                    <td class="text-center">
                        <div class="input-group input-group-sm d-flex">
                            <button class="btn btn-outline-secondary btn-sm btn-icon quantity-btn" type="button" data-action="decrease" data-product-id="${item.id}">-</button>
                            <input type="number" class="form-control form-control-sm text-center quantity-input" 
                                   value="${item.quantity}" min="1" max="${item.stock}" data-product-id="${item.id}" style="width: 30px;">
                            <button class="btn btn-outline-secondary btn-sm btn-icon quantity-btn" type="button" data-action="increase" data-product-id="${item.id}" ${item.quantity >= item.stock ? 'disabled' : ''}>+</button>
                        </div>
                    </td>
                    <td class="text-end">${formatRupiah(item.price)}</td>
                `;
                total += item.price * item.quantity;
            });

            cartTotal.textContent = formatRupiah(total);

            // Tampilkan atau sembunyikan tombol checkout berdasarkan isi keranjang
            if (cart.length > 0) {
                checkoutButton.style.display = 'inline-block';
            } else {
                checkoutButton.style.display = 'none';
            }

            // Tambahkan event listener untuk input quantity dan tombol
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-product-id');
                    let newQuantity = parseInt(this.value);
                    const maxStock = parseInt(this.getAttribute('max'));

                    if (newQuantity > maxStock) {
                        newQuantity = maxStock;
                        this.value = maxStock;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Jumlah melebihi stok yang tersedia. Jumlah disesuaikan dengan stok maksimal.'
                        });
                    } else if (newQuantity < 1) {
                        newQuantity = 1;
                        this.value = 1;
                    }

                    updateQuantity(productId, newQuantity);
                });
            });

            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const action = this.getAttribute('data-action');
                    const input = this.parentElement.querySelector('.quantity-input');
                    let newQuantity = parseInt(input.value);
                    const maxStock = parseInt(input.getAttribute('max'));

                    if (action === 'increase') {
                        if (newQuantity < maxStock) {
                            newQuantity++;
                        }
                    } else if (action === 'decrease' && newQuantity > 1) {
                        newQuantity--;
                    }

                    input.value = newQuantity;
                    updateQuantity(productId, newQuantity);
                });
            });

            // Perbarui status tombol "Tambah ke Keranjang" atau "Hapus dari Keranjang"
            updateCartButtons(cart);
        }

        // Fungsi baru untuk memperbarui status tombol keranjang
        function updateCartButtons(cart) {
            document.querySelectorAll('.cart-action').forEach(button => {
                const productId = button.getAttribute('data-product-id');
                const cartItem = cart.find(item => item.id == productId);
                const productRow = button.closest('tr');
                const stockCell = productRow.querySelector('td:nth-child(5)');
                const stock = parseInt(stockCell.textContent);

                if (stock === 0) {
                    button.style.display = 'none';
                    const stockOutBadge = document.createElement('span');
                    stockOutBadge.className = 'badge bg-red text-red-fg';
                    stockOutBadge.textContent = 'Stok Habis';
                    button.parentNode.appendChild(stockOutBadge);
                } else if (cartItem) {
                    button.textContent = '-';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                    button.setAttribute('data-action', 'remove');
                    button.style.display = 'inline-block';
                } else {
                    button.textContent = '+';
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                    button.setAttribute('data-action', 'add');
                    button.style.display = 'inline-block';
                }
            });
        }

        // Fungsi untuk menghapus produk dari keranjang
        function removeFromCart(productId) {
            fetch('/remove-from-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        productId: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCart(data.cart);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Event listener untuk tombol keranjang
        document.querySelectorAll('.cart-action').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const action = this.getAttribute('data-action');

                if (action === 'add') {
                    addToCart(productId);
                } else if (action === 'remove') {
                    removeFromCart(productId);
                }
            });
        });

        // Fungsi untuk memperbarui jumlah produk
        function updateQuantity(productId, newQuantity) {
            fetch('/update-cart-quantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCart(data.cart);
                    } else {
                        console.error(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Event listener untuk tombol tambah
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                addToCart(productId);
            });
        });

        // Event listener untuk tombol checkout
        document.getElementById('checkoutButton').addEventListener('click', function() {
            fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message
                        }).then(() => {
                            // Refresh halaman setelah checkout berhasil
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function showTransactionDetails(transactionId) {
            fetch(`/transaction-details/${transactionId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let detailsHtml = '<table class="table">';
                        detailsHtml += '<thead><tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr></thead>';
                        detailsHtml += '<tbody>';

                        let total = 0;
                        data.details.forEach(item => {
                            const subtotal = item.price * item.quantity;
                            detailsHtml += `<tr>
                            <td>${item.name}</td>
                            <td>${item.quantity}</td>
                            <td>${formatRupiah(item.price)}</td>
                            <td>${formatRupiah(subtotal)}</td>
                        </tr>`;
                            total += subtotal;
                        });

                        detailsHtml += `<tr><td colspan="3" class="text-end"><strong>Total:</strong></td><td><strong>${formatRupiah(total)}</strong></td></tr>`;
                        detailsHtml += '</tbody></table>';

                        document.getElementById('transactionDetails').innerHTML = detailsHtml;
                        new bootstrap.Modal(document.getElementById('transactionDetailModal')).show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Tambahkan event listener untuk link transaction_number
        document.querySelectorAll('.transaction-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const transactionId = this.getAttribute('data-transaction-id');
                showTransactionDetails(transactionId);
            });
        });

        function generateReport(transactionId) {
            const printContent = document.getElementById(`invoicePrint-${transactionId}`).innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print();

            document.body.innerHTML = originalContent;

            // Inisialisasi ulang event listeners dan komponen lain yang mungkin hilang
            initializeComponents();
        }

        function initializeComponents() {
            // Inisialisasi ulang DataTables
            new DataTable('#tableCashier', {
                responsive: true
            });

            new DataTable('#tableTransaction', {
                responsive: true,
                order: [
                    [1, 'desc']
                ]
            });

            // Inisialisasi ulang event listeners
            document.querySelectorAll('.cart-action').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const action = this.getAttribute('data-action');

                    if (action === 'add') {
                        addToCart(productId);
                    } else if (action === 'remove') {
                        removeFromCart(productId);
                    }
                });
            });

            // ... inisialisasi ulang komponen lain jika diperlukan ...
        }
    </script>

    <?= $this->endSection() ?>