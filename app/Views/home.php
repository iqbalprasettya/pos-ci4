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
                    Dashboard
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
                                                    78 Transaksi
                                                </div>
                                                <div class="text-secondary">
                                                    12 Hari ini
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
                                                    Rp 30.000 Masuk
                                                </div>
                                                <div class="text-secondary">
                                                    12 Transaksi
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
                                                    <td><button class="btn btn-success btn-sm btn-icon cart-action" data-product-id="<?= $product['id'] ?>" data-action="add">+</button></td>
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
                        <div class="card-body">
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
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="font-weight-bold strong text-uppercase text-end">Total</td>
                                        <td class="font-weight-bold text-end" id="cartTotal">Rp 0</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="text-center mt-3">
                                <button class="btn btn-primary" id="checkoutButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                                    </svg>
                                    Checkout
                                </button>
                            </div>

                            <p class="text-secondary text-center mt-5">Terima kasih banyak telah berbisnis dengan kami. Kami berharap dapat bekerja sama dengan Anda lagi!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>

    <!-- javascript section -->
    <?= $this->section('javascript') ?>
    <script>
        new DataTable('#tableCashier', {
            responsive: true
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
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        // Fungsi untuk memperbarui tampilan keranjang
        function updateCart(cart) {
            const cartTable = document.getElementById('cartTable').getElementsByTagName('tbody')[0];
            const cartTotal = document.getElementById('cartTotal');

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

            // Tambahkan event listener untuk input quantity dan tombol
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-product-id');
                    const newQuantity = parseInt(this.value);
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

                if (cartItem) {
                    button.textContent = '-';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                    button.setAttribute('data-action', 'remove');
                } else {
                    button.textContent = '+';
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                    button.setAttribute('data-action', 'add');
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
                        alert(data.message);
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
                    alert(data.message);
                    // Kosongkan keranjang setelah checkout berhasil
                    updateCart([]);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

    <?= $this->endSection() ?>