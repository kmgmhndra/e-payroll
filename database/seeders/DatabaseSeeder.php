<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'pegawai']);

        // 2. Buat Akun Admin (Contoh Admin Kemenkumham)
        $admin = User::create([
            'name' => 'Admin Kemenkum',
            'email' => 'admin@kemenkum.go.id',
            'nip' => '199001012020011001',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole($adminRole);

    }
}
