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

        // 2. Buat Akun Admin
        $admin = User::create([
            'name' => 'Admin Kemenkum',
            'email' => 'admin@kemenkum.go.id',
            'nip' => '199001012020011001',
            'pangkat_golongan' => 'III/c Penata',
            'jabatan' => 'Administrator Sistem',
            'grade' => 10,
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole($adminRole);

        // 3. Buat Akun Pegawai Contoh (untuk testing)
        $pegawai = User::create([
            'name' => 'Drs. I Wayan Redana,MH.',
            'email' => 'redana@kemenkum.go.id',
            'nip' => '196711201993031001',
            'no_rekening' => '1234567890',
            'pangkat_golongan' => 'IV/c Pembina Utama Muda',
            'jabatan' => 'Kepala Divisi Pelayanan Hukum',
            'grade' => 14,
            'password' => bcrypt('1234567890'),
            'email_verified_at' => now(),
        ]);
        $pegawai->assignRole($userRole);
    }
}
