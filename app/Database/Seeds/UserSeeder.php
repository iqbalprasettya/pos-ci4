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
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'created_at' => new RawSql('CURRENT_TIMESTAMP'),
                'updated_at' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            [
                'username' => 'kasir',
                'password' => password_hash('kasir123', PASSWORD_DEFAULT),
                'role'     => 'kasir',
                'created_at' => new RawSql('CURRENT_TIMESTAMP'),
                'updated_at' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ];

        // Menggunakan query builder untuk insert data ke tabel users
        $this->db->table('users')->insertBatch($data);
    }
}
