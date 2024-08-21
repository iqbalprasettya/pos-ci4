<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Halaman -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Pengaturan Toko</h2>
            </div>
        </div>
    </div>
</div>
<!-- Tubuh Halaman -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-md-3 border-end">
                    <div class="card-body">
                        <h4 class="subheader">Pengaturan Bisnis</h4>
                        <div class="list-group list-group-transparent">
                            <a href="<?= base_url('/profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center">Akun Saya</a>
                            <a href="<?= base_url('/settings') ?>" class="list-group-item list-group-item-action d-flex align-items-center active">Pengaturan</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 d-flex flex-column">
                    <form id="settingsForm" action="<?= base_url('settings/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <h2 class="mb-4">Pengaturan Toko</h2>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h3 class="card-title">Nama Toko</h3>
                                    <p class="card-subtitle text-muted">Masukkan nama toko Anda</p>
                                    <input type="text" name="store_name" class="form-control" value="<?= $storeSettings['store_name'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title">Alamat Toko</h3>
                                    <p class="card-subtitle text-muted">Masukkan alamat lengkap toko Anda</p>
                                    <input type="text" name="store_address" class="form-control" value="<?= $storeSettings['store_address'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h3 class="card-title">Nomor Telepon</h3>
                                    <p class="card-subtitle text-muted">Masukkan nomor telepon yang dapat dihubungi</p>
                                    <input type="text" name="store_phone" class="form-control" value="<?= $storeSettings['store_phone'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title">Email Toko</h3>
                                    <p class="card-subtitle text-muted">Masukkan alamat email resmi toko</p>
                                    <input type="email" name="store_email" class="form-control" value="<?= $storeSettings['store_email'] ?? '' ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h3 class="card-title">Jam Kerja</h3>
                                    <p class="card-subtitle text-muted">Masukkan jam operasional toko</p>
                                    <input type="text" name="working_hours" class="form-control" value="<?= $storeSettings['working_hours'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title">Facebook</h3>
                                    <p class="card-subtitle text-muted">Masukkan URL halaman Facebook toko (opsional)</p>
                                    <input type="url" name="social_media_facebook" class="form-control" value="<?= $storeSettings['social_media_facebook'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h3 class="card-title">Instagram</h3>
                                    <p class="card-subtitle text-muted">Masukkan URL profil Instagram toko (opsional)</p>
                                    <input type="url" name="social_media_instagram" class="form-control" value="<?= $storeSettings['social_media_instagram'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title">Teks Footer</h3>
                                    <p class="card-subtitle text-muted">Masukkan teks yang akan ditampilkan di footer situs</p>
                                    <textarea name="footer_text" class="form-control" rows="3"><?= $storeSettings['footer_text'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="<?= base_url() ?>" class="btn">Batal</a>
                                <button type="button" class="btn btn-primary" onclick="confirmSave()">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<!-- Bagian JavaScript -->
<?= $this->section('javascript') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        Swal.fire({
            title: 'Error!',
            html: '<?= implode("<br>", session()->getFlashdata('errors')) ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
});

function confirmSave() {
    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah Anda yakin ingin menyimpan perubahan?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('settingsForm').submit();
        }
    });
}
</script>
<?= $this->endSection() ?>