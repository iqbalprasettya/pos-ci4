<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BranchesModel;

class Branch extends BaseController
{
    protected $branchesModel;

    public function __construct()
    {
        $this->branchesModel = new BranchesModel();
        if (session()->get('role') !== 'owner') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $branches = $this->branchesModel->findAll();
        $userModel = new \App\Models\UserModel();
        $employees = $userModel->select('users.*, branches.name as branch_name')
                               ->join('branches', 'branches.id = users.branch_id')
                               ->findAll();
        return $this->render('branch/index', ['branches' => $branches, 'employees' => $employees]);
    }

    public function add()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama cabang harus diisi.',
                    'min_length' => 'Nama cabang minimal 3 karakter.',
                    'max_length' => 'Nama cabang maksimal 255 karakter.'
                ]
            ],
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat cabang harus diisi.'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[10]|max_length[20]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'min_length' => 'Nomor telepon minimal 10 digit.',
                    'max_length' => 'Nomor telepon maksimal 20 digit.'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'address' => $this->request->getPost('address'),
                'phone' => $this->request->getPost('phone'),
            ];

            $this->branchesModel->insert($data);
            // Ubah pesan sukses menjadi array untuk digunakan oleh SweetAlert
            return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Cabang toko berhasil ditambahkan']);
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama cabang harus diisi.',
                    'min_length' => 'Nama cabang minimal 3 karakter.',
                    'max_length' => 'Nama cabang maksimal 255 karakter.'
                ]
            ],
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat cabang harus diisi.'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[10]|max_length[20]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'min_length' => 'Nomor telepon minimal 10 digit.',
                    'max_length' => 'Nomor telepon maksimal 20 digit.'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getPost('name'),
                'address' => $this->request->getPost('address'),
                'phone' => $this->request->getPost('phone'),
            ];

            $this->branchesModel->update($id, $data);
            return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Cabang toko berhasil diperbarui']);
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function delete($id)
    {
        $branch = $this->branchesModel->find($id);
        if (!$branch) {
            return redirect()->to('/branch')->with('error', ['title' => 'Gagal!', 'text' => 'Cabang toko tidak ditemukan']);
        }

        $this->branchesModel->delete($id);
        return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Cabang toko berhasil dihapus']);
    }

    public function addEmployee()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,kasir]',
            'branch_id' => 'required|numeric|is_not_unique[branches.id]'
        ];

        $errors = [
            'name' => [
                'required' => 'Nama harus diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'max_length' => 'Nama maksimal 255 karakter.'
            ],
            'username' => [
                'required' => 'Username harus diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'max_length' => 'Username maksimal 50 karakter.',
                'is_unique' => 'Username sudah digunakan.'
            ],
            'password' => [
                'required' => 'Password harus diisi.',
                'min_length' => 'Password minimal 6 karakter.'
            ],
            'role' => [
                'required' => 'Role harus dipilih.',
                'in_list' => 'Role tidak valid.'
            ],
            'branch_id' => [
                'required' => 'Cabang harus dipilih.',
                'numeric' => 'Cabang tidak valid.',
                'is_not_unique' => 'Cabang tidak ditemukan.'
            ]
        ];

        if ($this->validate($rules, $errors)) {
            $userModel = new \App\Models\UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
                'branch_id' => $this->request->getPost('branch_id')
            ];

            $userModel->insert($data);
            return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Karyawan baru berhasil ditambahkan']);
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function editEmployee($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'role' => 'required|in_list[admin,kasir]',
            'branch_id' => 'required|numeric|is_not_unique[branches.id]'
        ];

        $errors = [
            'name' => [
                'required' => 'Nama harus diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'max_length' => 'Nama maksimal 255 karakter.'
            ],
            'username' => [
                'required' => 'Username harus diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'max_length' => 'Username maksimal 50 karakter.',
                'is_unique' => 'Username sudah digunakan.'
            ],
            'role' => [
                'required' => 'Role harus dipilih.',
                'in_list' => 'Role tidak valid.'
            ],
            'branch_id' => [
                'required' => 'Cabang harus dipilih.',
                'numeric' => 'Cabang tidak valid.',
                'is_not_unique' => 'Cabang tidak ditemukan.'
            ]
        ];

        if ($this->validate($rules, $errors)) {
            $userModel = new \App\Models\UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'branch_id' => $this->request->getPost('branch_id')
            ];

            // Jika password diisi, update password
            if ($this->request->getPost('password')) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $userModel->update($id, $data);
            // dd($data);
            return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Data karyawan berhasil diperbarui']);
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function deleteEmployee($id)
    {
        $userModel = new \App\Models\UserModel();
        $employee = $userModel->find($id);
        if (!$employee) {
            return redirect()->to('/branch')->with('error', ['title' => 'Gagal!', 'text' => 'Karyawan tidak ditemukan']);
        }

        $userModel->delete($id);
        return redirect()->to('/branch')->with('success', ['title' => 'Berhasil!', 'text' => 'Karyawan berhasil dihapus']);
    }
}
