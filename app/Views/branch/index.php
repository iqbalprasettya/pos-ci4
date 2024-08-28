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
                    Cabang Toko
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-employee">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Tambah Karyawan
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-employee">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                    <div class="modal modal-blur fade" id="modal-employee" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form id="employeeForm" method="POST" action="<?= base_url('branch/addEmployee') ?>">
                                    <?= csrf_field() ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Karyawan Baru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>
                                                    <select class="form-select" name="role" required>
                                                        <option value="admin">Admin</option>
                                                        <option value="kasir">Kasir</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Cabang Toko</label>
                                                    <select class="form-select" name="branch_id" required>
                                                        <?php foreach ($branches as $branch): ?>
                                                            <option value="<?= $branch['id'] ?>"><?= esc($branch['name']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Karyawan Cabang</h3>
                    </div>
                    <div class="card-body">
                        <div id="table-default" class="table-responsive">
                            <table id="tableEmployee" class="table mb-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Cabang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $index => $employee): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($employee['username']) ?></td>
                                            <td><?= esc($employee['name']) ?></td>
                                            <td>
                                                <?php if ($employee['role'] == 'admin'): ?>
                                                    <span class="badge bg-green text-green-fg">Admin</span>
                                                <?php elseif ($employee['role'] == 'kasir'): ?>
                                                    <span class="badge bg-yellow text-yellow-fg">Kasir</span>
                                                <?php else: ?>
                                                    <?= esc($employee['role']) ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge bg-blue text-blue-fg"><?= esc($employee['branch_name']) ?></span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-employee-<?= $employee['id'] ?>">Edit</button>
                                                <button class="btn btn-sm btn-danger" onclick="confirmDeleteEmployee(<?= $employee['id'] ?>)">Hapus</button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Karyawan -->
                                        <div class="modal modal-blur fade" id="modal-edit-employee-<?= $employee['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="<?= base_url('branch/editEmployee/' . $employee['id']) ?>">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Karyawan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama</label>
                                                                        <input type="text" class="form-control" name="name" value="<?= esc($employee['name']) ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Username</label>
                                                                        <input type="text" class="form-control" name="username" value="<?= esc($employee['username']) ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Password</label>
                                                                        <input type="password" class="form-control" name="password">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Role</label>
                                                                        <select class="form-select" name="role" required>
                                                                            <option value="admin" <?= $employee['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                                            <option value="kasir" <?= $employee['role'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Cabang Toko</label>
                                                                        <select class="form-select" name="branch_id" required>
                                                                            <?php foreach ($branches as $branch): ?>
                                                                                <option value="<?= $branch['id'] ?>" <?= $employee['branch_id'] == $branch['id'] ? 'selected' : '' ?>><?= esc($branch['name']) ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
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
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Cabang Toko</h3>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-branch">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Cabang
                        </a>
                        <div class="modal modal-blur fade" id="modal-branch" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="<?= base_url('branch/add') ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cabang Toko Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Cabang</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">No Telp</label>
                                                        <input type="text" class="form-control" name="phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea class="form-control" rows="3" name="address" required></textarea>
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
                    <div class="card-body table-responsive">
                        <table id="tableBranch" class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Cabang</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($branches as $branch): ?>
                                    <tr>
                                        <td><span class="badge bg-blue text-blue-fg"><?= esc($branch['name']) ?></span></td>
                                        <td><?= esc($branch['address']) ?></td>
                                        <td><?= esc($branch['phone']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-branch-<?= $branch['id'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $branch['id'] ?>)">Hapus</button>
                                        </td>
                                    </tr>
                                    <div class="modal modal-blur fade" id="modal-edit-branch-<?= $branch['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="<?= base_url('branch/edit/' . $branch['id']) ?>">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Cabang Toko</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Cabang</label>
                                                                    <input type="text" class="form-control" name="name" value="<?= esc($branch['name']) ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="mb-3">
                                                                    <label class="form-label">No Telp</label>
                                                                    <input type="text" class="form-control" name="phone" value="<?= esc($branch['phone']) ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Alamat</label>
                                                                    <textarea class="form-control" rows="3" name="address" required><?= esc($branch['address']) ?></textarea>
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
        </div>
    </div>
</div>





<?= $this->endSection() ?>

<!-- javascript section -->
<?= $this->section('javascript') ?>
<script>
    new DataTable('#tableEmployee, #tableBranch', {
        responsive: true
    });

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: '<?= session()->getFlashdata('success')['title'] ?>',
            text: '<?= session()->getFlashdata('success')['text'] ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: '<?= session()->getFlashdata('error')['title'] ?>',
            text: '<?= session()->getFlashdata('error')['text'] ?>',
        });
    <?php endif; ?>

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Cabang toko ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('branch/delete/') ?>' + id;
            }
        });
    }

    function confirmDeleteEmployee(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Karyawan ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('branch/deleteEmployee/') ?>' + id;
            }
        });
    }
</script>
<?= $this->endSection() ?>