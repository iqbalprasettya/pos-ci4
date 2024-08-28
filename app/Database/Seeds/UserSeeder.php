<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Database\RawSql;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'owner',
                'name' => 'Owner',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'role'     => 'owner',
                'created_at' => new RawSql('CURRENT_TIMESTAMP'),
                'updated_at' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ];

        // Menggunakan query builder untuk insert data ke tabel users
        $this->db->table('users')->insertBatch($data);
    }
}
