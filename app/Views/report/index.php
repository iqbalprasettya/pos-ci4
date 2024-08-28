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
                    Laporan Cabang: <?= session()->get('branch_name') ?>
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div id="chart-completion-tasks"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Penjualan</h3>
                    </div>
                    <form id="reportForm" action="<?= base_url('report/exportExcel') ?>" method="get">
                        <div class="card-body">
                            <div class="form-label">Filter</div>
                            <div class="row g-2">
                                <div class="col-sm-4 col-6">
                                    <div class="input-icon mb-2">
                                        <input class="form-control" placeholder="Pilih tanggal mulai" id="datepicker-start" name="start_date" required />
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <div class="input-icon mb-2">
                                        <input class="form-control" placeholder="Pilih tanggal akhir" id="datepicker-end" name="end_date" required />
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <select type="text" class="form-select" id="select-payment" name="payment_method">
                                            <option value="all">Semua Metode</option>
                                            <option value="cash">Tunai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php if (session()->get('role') === 'owner'): ?>
                                        <div class="mb-3">
                                            <select type="text" class="form-select" id="select-branch" name="branch_id">
                                                <option value="all">Semua Cabang</option>
                                                <?php foreach ($branches as $branch): ?>
                                                    <option value="<?= $branch['id'] ?>"><?= $branch['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" id="displayButton" class="btn btn-outline-secondary">Display</button>
                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Detail Transaksi</h3>
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
                                        <?php if (session()->get('role') === 'owner'): ?>
                                            <th>Cabang</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- akan ter isi jika button display di klik -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Penjualan dan Keuntungan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableTransactionDay" class="table mb-2">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Transaksi</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- akan ter isi jika button display di klik -->
                                </tbody>
                            </table>
                        </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        var salesData = <?= json_encode($salesData) ?>;

        var dates = salesData.map(function(item) {
            return item.date;
        });

        var totals = salesData.map(function(item) {
            return parseInt(item.total);
        });

        window.ApexCharts && (new ApexCharts(document.getElementById('chart-completion-tasks'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Transaksi",
                data: totals
            }],
            tooltip: {
                theme: 'dark'
            },
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: dates,
            colors: [tabler.getColor("primary")],
            legend: {
                show: false,
            },
        })).render();
    });


    document.addEventListener("DOMContentLoaded", function() {
        window.Litepicker && (new Litepicker({
            element: document.getElementById('datepicker-start'),
            elementEnd: document.getElementById('datepicker-end'),
            singleMode: false,
            allowRepick: true,
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });

    document.addEventListener("DOMContentLoaded", function() {
        const displayButton = document.getElementById('displayButton');
        const reportForm = document.getElementById('reportForm');

        displayButton.addEventListener('click', function(e) {
            e.preventDefault();
            var form = document.getElementById('reportForm');
            var formData = new FormData(form);

            <?php if (session()->get('role') === 'owner'): ?>
            var branchSelect = document.getElementById('select-branch');
            formData.append('branch_id', branchSelect.value);
            <?php endif; ?>

            // Tampilkan loading alert
            Swal.fire({
                title: 'Menampilkan Data',
                text: 'Sedang memuat data, mohon tunggu...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                fetch('<?= base_url('report/getFilteredData') ?>?' + new URLSearchParams(formData), {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            Swal.fire('Error', data.error, 'error');
                        } else {
                            updateTables(data);
                            Swal.fire('Sukses', 'Data berhasil dimuat', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Terjadi kesalahan saat memuat data', 'error');
                    });
            }, 2000);
        });

        // Tambahkan event listener untuk tombol Cetak Laporan
        reportForm.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Membuat Laporan',
                text: 'Sedang membuat laporan, mohon tunggu...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                this.submit();
            }, 2000);
        });

        function updateTables(data) {
            // Update tabel transaksi
            var transactionTable = document.getElementById('tableTransaction').getElementsByTagName('tbody')[0];
            transactionTable.innerHTML = '';
            data.transactionsData.forEach(function(transaction) {
                var row = transactionTable.insertRow();
                row.insertCell(0).textContent = transaction.transaction_number;
                row.insertCell(1).textContent = transaction.created_at;
                row.insertCell(2).textContent = formatRupiah(transaction.total_price);
                row.insertCell(3).textContent = transaction.payment_method;
                <?php if (session()->get('role') === 'owner'): ?>
                    row.insertCell(4).textContent = transaction.branch_name;
                <?php endif; ?>
            });

            // Update tabel penjualan harian
            var dailyTable = document.getElementById('tableTransactionDay').getElementsByTagName('tbody')[0];
            dailyTable.innerHTML = '';
            data.dailySalesData.forEach(function(daily) {
                var row = dailyTable.insertRow();
                row.insertCell(0).textContent = daily.date;
                row.insertCell(1).textContent = daily.total_transactions;
                row.insertCell(2).textContent = formatRupiah(daily.total_revenue);
            });
        }

        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }
    });
</script>
<?= $this->endSection() ?>