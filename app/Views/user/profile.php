<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header Halaman -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Pengaturan Akun</h2>
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
                            <a href="<?= base_url('/profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center active">Akun Saya</a>
                            <a href="<?= base_url('/settings') ?>" class="list-group-item list-group-item-action d-flex align-items-center">Pengaturan</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9 d-flex flex-column">
                    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <h2 class="mb-4">Akun Saya</h2>
                            <h3 class="card-title">Detail Profil</h3>
                            <div class="row align-items-center">
                                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(<?= base_url('uploads/avatars/' . $user['avatar']) ?>)"></span></div>
                                <div class="col-auto"><input type="file" name="avatar" class="form-control" accept="image/*"></div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-ghost-danger" id="delete-avatar-btn">Hapus Avatar</button>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Nama</h3>
                            <p class="card-subtitle">Nama lengkap Anda.</p>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" name="name" class="form-control w-auto" value="<?= $user['name'] ?? '' ?>" />
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Username</h3>
                            <p class="card-subtitle">Username ini akan ditampilkan kepada orang lain secara publik, jadi pilihlah dengan hati-hati.</p>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" name="username" class="form-control w-auto" value="<?= $user['username'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Kata Sandi</h3>
                            <p class="card-subtitle">Anda dapat mengatur kata sandi baru jika Anda ingin mengubahnya.</p>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="password" name="new_password" class="form-control w-auto" placeholder="Kata Sandi Baru" />
                                    </div>
                                    <div class="col-auto">
                                        <input type="password" name="confirm_password" class="form-control w-auto" placeholder="Konfirmasi Kata Sandi" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="<?= base_url() ?>" class="btn">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    document.getElementById('delete-avatar-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('profile/delete-avatar') ?>';
            }
        })
    });

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success') ?>'
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')): ?>
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: '<?= session()->getFlashdata('info') ?>'
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: '<?= implode(", ", session()->getFlashdata('errors')) ?>'
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>