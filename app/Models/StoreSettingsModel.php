<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreSettingsModel extends Model
{
    protected $table = 'store_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getSetting($key)
    {
        $result = $this->where('key', $key)->first();
        return $result ? $result['value'] : null;
    }

    public function setSetting($key, $value)
    {
        $existingSetting = $this->where('key', $key)->first();
        if ($existingSetting) {
            return $this->update($existingSetting['id'], ['value' => $value]);
        } else {
            return $this->insert(['key' => $key, 'value' => $value]);
        }
    }

    public function getAllSettings()
    {
        $settings = $this->findAll();
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['key']] = $setting['value'];
        }
        return $result;
    }
}