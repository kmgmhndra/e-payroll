<?php

namespace App\Imports;

use App\Models\Salary;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalaryImport implements ToModel, WithHeadingRow
{
    protected $month;
    protected $year;
    
    // [WAJIB ADA] Variabel untuk menghitung nomor urut 1, 2, 3...
    private $nomorUrut = 0; 

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * Helper untuk membersihkan format uang dari Excel
     * Mengubah "5,014,100" atau "5.014.100" menjadi angka murni 5014100
     */
    private function cleanMoney($value)
    {
        if (empty($value)) return 0;
        
        // Hapus semua karakter KECUALI angka (0-9)
        // Ini akan membuang koma, titik, Rp, spasi, dll.
        return (int) preg_replace('/[^0-9]/', '', $value);
    }

    public function model(array $row)
    {
        // 1. Cleaning NIP
        $nipExcel = trim((string) $row['nip']);
        $user = User::where('nip', $nipExcel)->first();

        // Log jika user tidak ditemukan (biar tidak silent fail)
        if (!$user) {
            \Illuminate\Support\Facades\Log::warning("Import Skip: NIP $nipExcel tidak ditemukan.");
            return null; 
        }

        // [WAJIB ADA] Tambah nomor urut setiap kali baris dibaca
        $this->nomorUrut++; 

        // 2. Mapping Data (DENGAN PEMBERSIH ANGKA)
        // Kita bungkus setiap nilai uang dengan $this->cleanMoney(...)
        $incomeDetails = [
            'Gaji Induk'        => $this->cleanMoney($row['gaji_induk']),
            'Tunjangan Kinerja' => $this->cleanMoney($row['tunjangan_kinerja']),
        ];

        
        $deductionDetails = [
            'Angsuran BPD'          => $this->cleanMoney($row['angsuran_bpd']),
            'Iuran Tabungan Korpri' => $this->cleanMoney($row['iuran_tabungan_korpri']),
            'Iuran Korpri'          => $this->cleanMoney($row['iuran_korpri']),
            'Arisan DW'             => $this->cleanMoney($row['arisan_dw']),
            'Simpan Pinjam'         => $this->cleanMoney($row['simpan_pinjam']),
            'Iuran Hindu'           => $this->cleanMoney($row['iuran_hindu']),
            
            // URUTAN BARU SESUAI TEMPLATE
            'Pengajian'             => $this->cleanMoney($row['pengajian']),
            'Simpatik'              => $this->cleanMoney($row['simpatik']),
            'Dana Sosial Budaya'    => $this->cleanMoney($row['dana_sosial_budaya']),
            'Sumbangan DW'          => $this->cleanMoney($row['sumbangan_dw']),
            'PIPAS'                 => $this->cleanMoney($row['pipas']),
            
            // LAIN-LAIN (Kain Dihapus)
            'Lain-lain 1'           => $this->cleanMoney($row['lain_lain_1']),
            'Lain-lain 2'           => $this->cleanMoney($row['lain_lain_2']),
            'Lain-lain 3'           => $this->cleanMoney($row['lain_lain_3']),
        ];

        // 3. Hitung Total
        $totalIncome    = array_sum($incomeDetails);
        $totalDeduction = array_sum($deductionDetails);
        $takeHomePay    = $totalIncome - $totalDeduction;

        // 4. Simpan ke Database
        return Salary::updateOrCreate(
            [
                'user_id' => $user->id,
                'month'   => $this->month,
                'year'    => $this->year,
            ],
            [
                'income_details'    => $incomeDetails,
                'deduction_details' => $deductionDetails,
                'total_income'      => $totalIncome,
                'total_deduction'   => $totalDeduction,
                'take_home_pay'     => $takeHomePay,
                
                // [WAJIB ADA] Simpan nomor urut agar muncul di PDF
                'no_urut'           => $this->nomorUrut, 
            ]
        );
    }
}