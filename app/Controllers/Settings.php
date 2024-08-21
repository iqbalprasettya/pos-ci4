<?php

namespace App\Controllers;

use App\Models\StoreSettingsModel;

class Settings extends BaseController
{
    protected $storeSettingsModel;

    public function __construct()
    {
        $this->storeSettingsModel = new StoreSettingsModel();
    }

    public function index()
    {
        $storeSettings = $this->storeSettingsModel->getAllSettings();
        return $this->render('settings/index', ['storeSettings' => $storeSettings]);
    }

    public function update()
    {
        $rules = [
            'store_name' => 'required|min_length[3]|max_length[255]',
            'store_address' => 'required',
            'store_phone' => 'required',
            'store_email' => 'required|valid_email',
            'working_hours' => 'required',
            'social_media_facebook' => 'valid_url|permit_empty',
            'social_media_instagram' => 'valid_url|permit_empty',
            'footer_text' => 'required'
        ];

        $messages = [
            'store_name' => [
                'required' => 'Nama toko harus diisi',
                'min_length' => 'Nama toko minimal 3 karakter',
                'max_length' => 'Nama toko maksimal 255 karakter'
            ],
            'store_address' => [
                'required' => 'Alamat toko harus diisi'
            ],
            'store_phone' => [
                'required' => 'Nomor telepon toko harus diisi'
            ],
            'store_email' => [
                'required' => 'Email toko harus diisi',
                'valid_email' => 'Format email tidak valid'
            ],
            'working_hours' => [
                'required' => 'Jam kerja harus diisi'
            ],
            'social_media_facebook' => [
                'valid_url' => 'URL Facebook tidak valid'
            ],
            'social_media_instagram' => [
                'valid_url' => 'URL Instagram tidak valid'
            ],
            'footer_text' => [
                'required' => 'Teks footer harus diisi'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fields = [
            'store_name', 'store_address', 'store_phone', 'store_email',
            'working_hours', 'social_media_facebook', 'social_media_instagram',
            'footer_text'
        ];

        foreach ($fields as $field) {
            $this->storeSettingsModel->setSetting($field, $this->request->getPost($field));
        }

        return redirect()->to('/settings')->with('success', 'Pengaturan toko berhasil disimpan');
    }
}