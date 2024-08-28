<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreSettingsModel extends Model
{
    protected $table            = 'store_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['key', 'value', 'branch_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getBranch()
    {
        return $this->belongsTo('App\Models\BranchModel', 'branch_id', 'id');
    }

    public function getSetting($key)
    {
        $result = $this->where('key', $key)->first();
        return $result ? $result['value'] : null;
    }

    public function setSetting($key, $value, $branch_id = null)
    {
        $existingSetting = $this->where('key', $key)->first();
        if ($existingSetting) {
            return $this->update($existingSetting['id'], ['value' => $value]);
        } else {
            return $this->insert([
                'key' => $key,
                'value' => $value,
                'branch_id' => $branch_id
            ]);
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