<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $data['user'] = $this->userModel->find($userId);
        return $this->render('user/profile', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'label' => 'Nama',
                'errors' => [
                    'required' => 'Nama harus diisi.',
                    'min_length' => 'Nama minimal terdiri dari 3 karakter.',
                    'max_length' => 'Nama maksimal terdiri dari 255 karakter.'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . $userId . ']',
                'label' => 'Username',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Username minimal terdiri dari 3 karakter.',
                    'max_length' => 'Username maksimal terdiri dari 50 karakter.',
                    'is_unique' => 'Username sudah digunakan, silakan pilih yang lain.'
                ]
            ],
            'avatar' => [
                'rules' => 'permit_empty|uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]',
                'label' => 'Avatar',
                'errors' => [
                    'uploaded' => 'Silakan unggah gambar untuk avatar.',
                    'max_size' => 'Ukuran avatar maksimal 1 MB.',
                    'is_image' => 'File yang diunggah bukan gambar.'
                ]
            ],
            'new_password' => [
                'rules' => 'permit_empty|min_length[6]',
                'label' => 'Kata Sandi Baru',
                'errors' => [
                    'min_length' => 'Kata sandi baru minimal terdiri dari 6 karakter.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'matches[new_password]',
                'label' => 'Konfirmasi Kata Sandi',
                'errors' => [
                    'matches' => 'Konfirmasi kata sandi tidak cocok.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $newData = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username')
        ];

        if ($avatar = $this->request->getFile('avatar')) {
            if ($avatar->isValid() && !$avatar->hasMoved()) {
                $newAvatarName = $avatar->getRandomName();
                $avatar->move(ROOTPATH . 'public/uploads/avatars', $newAvatarName);
                $newData['avatar'] = $newAvatarName;

                // Hapus avatar lama jika bukan default
                if ($user['avatar'] != 'default.png') {
                    unlink(ROOTPATH . 'public/uploads/avatars/' . $user['avatar']);
                }
            }
        }

        if ($newPassword = $this->request->getPost('new_password')) {
            $newData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $newData);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function deleteAvatar()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if ($user['avatar'] != 'default.png') {
            // Hapus file avatar lama
            $avatarPath = ROOTPATH . 'public/uploads/avatars/' . $user['avatar'];
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }

            // Set avatar ke default
            $this->userModel->update($userId, ['avatar' => 'default.png']);

            return redirect()->to('/profile')->with('success', 'Avatar berhasil dihapus');
        }

        return redirect()->to('/profile')->with('info', 'Avatar sudah menggunakan default');
    }
}