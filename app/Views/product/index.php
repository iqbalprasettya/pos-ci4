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
                    Produk Management
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <?php if (session()->get('role') !== 'owner'): ?>

                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-product">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Produk
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-product">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                        <div class="modal modal-blur fade" id="modal-product" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form id="productForm" method="POST" action="<?= base_url('product/addProduct') ?>">
                                        <div class="modal-header">
                                            <h5 class="modal-title">New Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Product</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Kategori</label>
                                                        <select name="category_id" class="form-select" required>
                                                            <option selected disabled>Pilih Kategori</option>
                                                            <?php foreach ($categories as $category): ?>
                                                                <option value="<?= esc($category['id']) ?>"><?= esc($category['name']) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" rows="3" name="description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Harga</label>
                                                        <input type="text" class="form-control" name="price" id="price" required oninput="formatRupiah(this)" placeholder="Rp. 0,00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Stok</label>
                                                        <input type="number" class="form-control" name="stock" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </a>
                                            <button type="submit" class="btn btn-primary ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php if (session()->get('role') !== 'owner'): ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Semua Produk</h3>
                        </div>
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table id="tableProducts" class="table mb-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $index => $product): ?>
                                            <?php if ($product['branch_id'] == session()->get('branch_id')): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= esc($product['name']) ?></td>
                                                    <td>
                                                        <span class="badge bg-blue text-blue-fg">
                                                            <?php
                                                            $category = array_filter($categories, fn($cat) => $cat['id'] == $product['category_id']);
                                                            echo esc($category ? reset($category)['name'] : 'Tidak ada kategori');
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td><?= esc($product['description']) ?></td>
                                                    <td>Rp <?= number_format(esc($product['price']), 0, ',', '.') ?></td>
                                                    <td><?= esc($product['stock']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-product-<?= $product['id'] ?>">Edit</button>
                                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $product['id'] ?>, 'product')">Hapus</button>
                                                    </td>
                                                    <!-- Modal Edit Product -->
                                                    <div class="modal modal-blur fade" id="modal-edit-product-<?= $product['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form id="productForm" method="POST" action="<?= base_url('product/updateProduct/' . $product['id']) ?>">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Product</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nama Product</label>
                                                                                    <input type="text" class="form-control" name="name" value="<?= esc($product['name']) ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Kategori</label>
                                                                                    <select name="category_id" class="form-select" required>
                                                                                        <option selected disabled>Pilih Kategori</option>
                                                                                        <?php foreach ($categories as $category): ?>
                                                                                            <option value="<?= esc($category['id']) ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= esc($category['name']) ?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Deskripsi</label>
                                                                                    <textarea class="form-control" rows="3" name="description" required><?= esc($product['description']) ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Harga</label>
                                                                                    <input type="text" class="form-control" name="price" id="price" value="Rp <?= number_format(esc($product['price']), 0, ',', '.') ?>" required oninput="formatRupiah(this)" placeholder="Rp. 0,00">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Stok</label>
                                                                                    <input type="number" class="form-control" name="stock" value="<?= esc($product['stock']) ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</a>
                                                                        <button type="submit" class="btn btn-primary ms-auto">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Kategori Produk</h3>
                        <?php if (session()->get('role') === 'admin' || session()->get('role') === 'owner'): ?>
                            <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-category">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </button>
                        <?php endif; ?>
                        <?php if (session()->get('role') === 'admin' || session()->get('role') === 'owner'): ?>
                            <div class="modal modal-blur fade" id="modal-category" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="<?= base_url('product/addCategory') ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Kategori Baru</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Kategori</label>
                                                            <input type="text" class="form-control" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" rows="3" name="description" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </a>
                                                <button type="submit" class="btn btn-primary ms-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                                    </svg>
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tableCategory" class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td><span class="badge bg-blue text-blue-fg"><?= esc($category['name']) ?></span></td>
                                        <td><?= esc($category['description']) ?></td>
                                        <td><?= date('Y-m-d', strtotime($category['created_at'])) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-category-<?= $category['id'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $category['id'] ?>, 'category')">Hapus</button>
                                        </td>
                                    </tr>
                                    <div class="modal modal-blur fade" id="modal-edit-category-<?= $category['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="<?= base_url('product/updateCategory/' . $category['id']) ?>">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Kategori</label>
                                                                    <input type="text" class="form-control" name="name" value="<?= esc($category['name']) ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" rows="3" name="description" required><?= esc($category['description']) ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                                            Batal
                                                        </a>
                                                        <button type="submit" class="btn btn-primary ms-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                                            </svg>
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body" style="overflow-y: hidden; max-height: 500px;">
                        <h3 class="card-title">Semua Kategori</h3>
                        <div style="overflow-y: auto; max-height: 500px;">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-end">Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categoryStockCounts as $categoryId => $stockCount): ?>
                                        <?php
                                        $category = array_filter($categories, function ($cat) use ($categoryId) {
                                            return $cat['id'] == $categoryId;
                                        });
                                        $category = reset($category);
                                        $percentage = ($totalStock > 0) ? ($stockCount / $totalStock) * 100 : 0;
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: <?= number_format($percentage, 2) ?>%" role="progressbar" aria-valuenow="<?= number_format($percentage, 2) ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= number_format($percentage, 2) ?>% Complete">
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text"><?= esc($category['name']) ?></div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end"><?= $stockCount ?></td>
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
</div>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= implode('<br>', session()->getFlashdata('errors')) ?>',
            footer: 'Silakan periksa kembali inputan Anda.'
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>

<!-- javascript section -->
<?= $this->section('javascript') ?>
<script>
    new DataTable('#tableProducts, #tableCategory', {
        responsive: true
    });

    function confirmDelete(id, type) {
        let text = type === 'product' ? "Produk ini akan dihapus!" : "Kategori ini akan dihapus!";
        let url = type === 'product' ? '/product/deleteProduct/' : '/product/deleteCategory/';

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url + id;
            }
        });
    }

    // Fungsi untuk memformat Rupiah
    function formatRupiah(input) {
        var value = input.value.replace(/[^,\d]/g, '').toString();
        var split = value.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }

    // Menerapkan format Rupiah ke semua input harga
    document.addEventListener('DOMContentLoaded', function() {
        var priceInputs = document.querySelectorAll('input[name="price"]');
        priceInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                formatRupiah(this);
            });
        });
    });
</script>
<?= $this->endSection() ?>