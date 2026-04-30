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
    */

    public function getTotalIncomeAttribute()
    {
        return array_sum($this->income_details ?? []);
    }

    public function getTotalDeductionAttribute()
    {
        return array_sum($this->deduction_details ?? []);
    }

    public function getTakeHomePayAttribute()
    {
        return $this->total_income - $this->total_deduction;
    }

    /**
     * Helper: Mendapatkan nama bulan sebelumnya dalam Bahasa Indonesia.
     * Contoh: Jika salary->month = "Januari" dan year = 2026 → "Desember 2025"
     */
    public function getBulanSebelumnyaAttribute()
    {
        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $currentIndex = array_search($this->month, $bulanList);
        
        if ($currentIndex === false) {
            return $this->month; // Fallback
        }

        if ($currentIndex === 0) {
            // Januari → Desember tahun sebelumnya
            return 'Desember ' . ($this->year - 1);
        }

        return $bulanList[$currentIndex - 1] . ' ' . $this->year;
    }
}