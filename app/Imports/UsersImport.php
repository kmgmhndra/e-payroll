<?php

namespace App\Imports;

use App\Models\User;
use Spatie\Permission\Models\Role; // PENTING: Import Role
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows; // PENTING: Import SkipsEmptyRows

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * Mapping data dari Excel ke Database
    */
    public function model(array $row)
    {
        // Pengecekan Ganda: Pastikan data penting ada
        if (empty($row['nama']) || empty($row['nip'])) {
            return null;
        }

        // 1. Tentukan Password (No Rekening / NIP)
        $password = !empty($row['no_rekening']) ? $row['no_rekening'] : $row['nip'];

        // 2. Simpan User (Pakai updateOrCreate biar tidak error Duplicate)
        $user = User::updateOrCreate(
            ['nip' => $row['nip']], // Cek berdasarkan NIP
            [
                'name'              => $row['nama'],
                'email'             => $row['email'],
                'no_rekening'       => $row['no_rekening'] ?? null,
                'password'          => Hash::make($password),
                'email_verified_at' => now(), // Auto verify
            ]
        );

        // 3. Assign Role (Cek dulu role-nya ada atau tidak)
        // Ini solusi error database kosong (migrate:fresh)
        $role = Role::firstOrCreate(['name' => 'pegawai', 'guard_name' => 'web']);
        
        $user->assignRole($role);

        return $user;
    }

    /**
     * Validasi Data Excel
     * Kita hapus 'unique' disini karena sudah ditangani oleh updateOrCreate
     */
    public function rules(): array
    {
        return [
            'nama'  => 'required',
            'email' => 'required', // Hapus 'unique:users,email' agar bisa update data lama
            'nip'   => 'required', // Hapus 'unique:users,nip' agar bisa update data lama
        ];
    }
}