<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Salary extends Model
{
    use HasFactory, HasUuids;

    // 1. KEAMANAN: Casting 'encrypted'
    // Laravel akan otomatis mengenkripsi data saat disimpan (Save)
    // dan mendekripsi saat diambil (Get). 
    // Di database isinya acak (jhk234...sw), di kodingan isinya Array normal.
    protected $casts = [
        'income_details'    => 'encrypted:array',    // <--- Ubah jadi encrypted
        'deduction_details' => 'encrypted:array',    // <--- Ubah jadi encrypted
        // 'take_home_pay'  => 'encrypted',          // (Opsional) Jika ingin total gaji juga rahasia
    ];

    protected $guarded = [];

    // Relasi ke User (Pegawai)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* |--------------------------------------------------------------------------
    | ACCESSOR (OPTIMALISASI LOGIKA)
    |--------------------------------------------------------------------------
    | Data ini dihitung di level aplikasi (PHP), bukan database.
    | Sangat menghemat ruang database karena kita tidak perlu menyimpan kolom 
    | 'total_income' yang statis jika detailnya berubah.
    */

    public function getTotalIncomeAttribute()
    {
        // Null Coalescing Operator (??) agar tidak error jika data kosong
        return array_sum($this->income_details ?? []);
    }

    public function getTotalDeductionAttribute()
    {
        return array_sum($this->deduction_details ?? []);
    }

    public function getTakeHomePayAttribute()
    {
        // Kita hitung dinamis agar selalu akurat dengan detail terbaru
        return $this->total_income - $this->total_deduction;
    }
}