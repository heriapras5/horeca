<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pusat Furniture',
            'email' => 'admin@jif.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}
