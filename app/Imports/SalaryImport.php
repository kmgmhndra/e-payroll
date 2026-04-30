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
    
    // Variabel untuk menghitung nomor urut 1, 2, 3...
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
        return (int) preg_replace('/[^0-9]/', '', $value);
    }

    public function model(array $row)
    {
        // 1. Cleaning NIP
        $nipExcel = trim((string) $row['nip']);
        $user = User::where('nip', $nipExcel)->first();

        // Log jika user tidak ditemukan
        if (!$user) {
            \Illuminate\Support\Facades\Log::warning("Import Skip: NIP $nipExcel tidak ditemukan.");
            return null; 
        }

        // Tambah nomor urut setiap kali baris dibaca
        $this->nomorUrut++; 

        // 2. Mapping Data Penghasilan (STRUKTUR BARU)
        $incomeDetails = [
            'Gaji Pokok'          => $this->cleanMoney($row['gaji_pokok'] ?? null),
            'Tunjangan Keluarga'  => $this->cleanMoney($row['tunjangan_keluarga'] ?? null),
            'Tunjangan Jabatan'   => $this->cleanMoney($row['tunjangan_jabatan'] ?? null),
            'Pembulatan'          => $this->cleanMoney($row['pembulatan'] ?? null),
            'Tunjangan Pajak'     => $this->cleanMoney($row['tunjangan_pajak'] ?? null),
            'Tunjangan Beras'     => $this->cleanMoney($row['tunjangan_beras'] ?? null),
            'Tunjangan Kinerja'   => $this->cleanMoney($row['tunjangan_kinerja'] ?? null),
            'Uang Makan'          => $this->cleanMoney($row['uang_makan'] ?? null),
        ];

        // 3. Mapping Data Potongan (STRUKTUR BARU)
        $deductionDetails = [
            'Iuran Wajib Pegawai'      => $this->cleanMoney($row['iuran_wajib_pegawai'] ?? null),
            'BPJS'                      => $this->cleanMoney($row['bpjs'] ?? null),
            'Pajak Penghasilan'         => $this->cleanMoney($row['pajak_penghasilan'] ?? null),
            'Sewa Rumah Dinas'          => $this->cleanMoney($row['sewa_rumah_dinas'] ?? null),
            'Angsuran BPD'              => $this->cleanMoney($row['angsuran_bpd'] ?? null),
            'Iuran Tabungan Korpri'     => $this->cleanMoney($row['iuran_tabungan_korpri'] ?? null),
            'Iuran Korpri'              => $this->cleanMoney($row['iuran_korpri'] ?? null),
            'Seksi Usaha Dharma Wanita' => $this->cleanMoney($row['seksi_usaha_dw'] ?? null),
            'Arisan Dharma Wanita'      => $this->cleanMoney($row['arisan_dw'] ?? null),
            'Arisan Pengayoman'         => $this->cleanMoney($row['arisan_pengayoman'] ?? null),
            'Simpan Pinjam'             => $this->cleanMoney($row['simpan_pinjam'] ?? null),
            'Iuran Hindu'               => $this->cleanMoney($row['iuran_hindu'] ?? null),
            'Dana Sosial Budaya'        => $this->cleanMoney($row['dana_sosial_budaya'] ?? null),
            'Simpatik'                  => $this->cleanMoney($row['simpatik'] ?? null),
            'Sumbangan DW'              => $this->cleanMoney($row['sumbangan_dw'] ?? null),
        ];

        // 4. Hitung Total
        $totalIncome    = array_sum($incomeDetails);
        $totalDeduction = array_sum($deductionDetails);
        $takeHomePay    = $totalIncome - $totalDeduction;

        // 5. Simpan ke Database
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
                'no_urut'           => $this->nomorUrut, 
            ]
        );
    }
}