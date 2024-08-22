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
                    Transaksi
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
                                                    <?= $totalStock ?> Produk tersedia
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
                                                <!-- Tambahkan tombol cetak -->
                                                <button type="button" class="btn btn-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report-<?= $transaction['id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                    </svg>
                                                </button>
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

    <!-- Tambahkan modal untuk cetak invoice -->
    <?php foreach ($transactions as $transaction): ?>
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
                        <button type="button" class="btn btn-primary ms-auto" onclick="printInvoice(<?= $transaction['id'] ?>)">
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
    <?php endforeach; ?>

    <?= $this->endSection() ?>

    <!-- javascript section -->
    <?= $this->section('javascript') ?>
    <script>
        new DataTable('#tableTransaction', {
            responsive: true,
            order: [
                [1, 'desc']
            ] // Mengurutkan berdasarkan kolom kedua (indeks 1) secara descending
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

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }

        // Tambahkan event listener untuk link transaction_number
        document.querySelectorAll('.transaction-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const transactionId = this.getAttribute('data-transaction-id');
                showTransactionDetails(transactionId);
            });
        });

        function printInvoice(transactionId) {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById(`modal-report-${transactionId}`));
            modal.hide();

            // Tunggu sebentar untuk memastikan modal telah tertutup sepenuhnya
            setTimeout(() => {
                const printContent = document.getElementById(`invoicePrint-${transactionId}`).innerHTML;
                const originalContent = document.body.innerHTML;

                document.body.innerHTML = printContent;

                window.print();

                // Setelah print selesai, refresh halaman
                window.onafterprint = function() {
                    window.location.reload();
                };

                // Jika window.onafterprint tidak didukung atau tidak terpicu
                setTimeout(() => {
                    window.location.reload();
                }, 1000); // Tunggu 1 detik sebelum refresh sebagai fallback
            }, 300);
        }
    </script>
    <?= $this->endSection() ?>