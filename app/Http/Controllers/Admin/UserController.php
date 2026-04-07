<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\UsersImport;
use App\Imports\SalaryImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive; 
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pegawai.
     */
    public function index(Request $request)
    {
        // Query Dasar: Ambil user dengan role pegawai
        $query = User::role('pegawai');

        // LOGIKA SEARCH: Jika ada parameter 'search' di URL
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('nip', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter Role (Opsional jika dropdown filter diaktifkan)
        if ($request->has('role') && $request->role != 'Semua Role') {
            // Logika filter role tambahan jika diperlukan
        }

        // Ambil data dengan pagination (biar search tetap jalan saat pindah halaman)
        $users = $query->latest()->paginate(10)->withQueryString();

        // Data Statistik (Tetap sama)
        $total_semua    = User::count();
        $total_admin    = User::role('admin')->count();
        $total_pegawai  = User::role('pegawai')->count();

        return view('admin.users.index', compact('users', 'total_semua', 'total_admin', 'total_pegawai'));
    }

    /**
     * Menampilkan form edit pegawai.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Menampilkan detail pegawai.
     */
    public function show(User $user)
    {
        if ($user->wantsJson()) {
            return response()->json($user);
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * Menampilkan halaman import salary dengan riwayat upload.
     */
    public function showImportSalary()
    {
        // 1. Ambil Riwayat Gaji (Kodingan Lama Bapak - TETAP)
        $salaryHistory = Salary::select('month', 'year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderByRaw("FIELD(month, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') DESC")
            ->limit(10)
            ->get();
        
        // 2. [BARU] Tambahkan ini: Hitung Total Pegawai
        // Ini akan menghitung user yang punya role 'pegawai' saja (admin tidak dihitung)
        $total_pegawai = User::role('pegawai')->count();

        // 3. Update return view (Tambahkan 'total_pegawai' ke dalam compact)
        return view('admin.import-salary', compact('salaryHistory', 'total_pegawai'));
    }
    /**
     * Simpan Pegawai Baru (Manual).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|string|unique:users,nip',
            'no_rekening' => 'nullable|numeric',
        ]);

        // LOGIKA PASSWORD DISAMAKAN DENGAN IMPORT EXCEL
        // Prioritas: No Rekening -> Jika kosong pakai NIP
        $password = !empty($request->no_rekening) ? $request->no_rekening : $request->nip;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'no_rekening' => $request->no_rekening,
            'password' => bcrypt($password), 
            'email_verified_at' => now(),
        ]);

        $user->assignRole('pegawai');

        return redirect()->back()->with('success', "Pegawai berhasil ditambahkan. Password default: " . $password);
    }

    /**
     * Update Data Pegawai.
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'nip' => 'required|string|unique:users,nip,' . $user->id,
                'no_rekening' => 'nullable|numeric',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'no_rekening' => $request->no_rekening,
            ]);

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Data pegawai berhasil diperbarui.']);
            }
            return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', 'Gagal memperbarui data pegawai.');
        }
    }

    /**
     * Hapus Pegawai.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Pegawai berhasil dihapus.']);
            }
            return redirect()->back()->with('success', 'Pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', 'Gagal menghapus pegawai.');
        }
    }

    /**
     * Import Pegawai via Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            
            // ✅ Kembalikan JSON untuk AJAX Request
            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil diimport dari Excel.'
            ]);
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMsg = 'Gagal import baris ke-' . $failures[0]->row() . ': ' . $failures[0]->errors()[0];
            
            return response()->json([
                'success' => false,
                'message' => $errorMsg
            ], 422);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'System Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Import Data Gaji (Excel).
     */
    public function storeSalary(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            Excel::import(new SalaryImport($request->month, $request->year), $request->file('file'));
            return redirect()->back()->with('success', 'Data gaji periode ' . $request->month . ' ' . $request->year . ' berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import gaji: ' . $e->getMessage());
        }
    }

    /**
     * Halaman Arsip Gaji (Rekap per Bulan).
     */
    public function archive()
    {
        $reports = Salary::select(
                'year', 
                'month', 
                DB::raw('count(*) as total_pegawai'), 
                DB::raw('max(created_at) as tgl_upload')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderByRaw("FIELD(month, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') DESC")
            ->get()
            ->groupBy('year');

        return view('admin.archive', compact('reports'));
    }

    /**
     * Menampilkan Detail Gaji Per Periode (List Pegawai).
     */
    public function showPeriod($year, $month)
    {
        $salaries = Salary::with('user')
                    ->where('year', $year)
                    ->where('month', $month)
                    ->get();

        return view('admin.salary.period', compact('salaries', 'year', 'month'));
    }

    /**
     * Hapus Arsip Gaji (Semua data pada bulan & tahun terpilih)
     */
    public function destroyArchive($year, $month)
    {
        try {
            // Hapus semua data di tabel salaries yang cocok dengan bulan dan tahun
            Salary::where('year', $year)->where('month', $month)->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => "Arsip gaji periode $month $year berhasil dihapus."]);
            }
            return redirect()->back()->with('success', "Arsip gaji periode $month $year berhasil dihapus.");
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus arsip: ' . $e->getMessage()], 422);
            }
            return redirect()->back()->with('error', 'Gagal menghapus arsip gaji.');
        }
    }


    /**
     * CETAK SLIP GAJI (PDF SATUAN) - UPDATED
     */
    public function printSalary($id)
    {
        // 1. SAFEGUARD MEMORY
        ini_set('memory_limit', '2048M'); 
        ini_set('max_execution_time', 300);

        // 2. AMBIL DATA GAJI
        $salary = Salary::with('user')->findOrFail($id);

        // 3. SECURITY CHECK (Anti IDOR)
        if (!auth()->user()->hasRole('admin') && $salary->user_id !== auth()->id()) {
            \Illuminate\Support\Facades\Log::warning('Percobaan akses ilegal slip gaji ID: ' . $id . ' oleh User: ' . auth()->id());
            abort(403, 'TINDAKAN DILARANG: Anda tidak berhak melihat slip gaji ini.');
        }

        // 4. Generate Terbilang
        // (Pastikan fungsi terbilang ada di bawah controller ini)
        $terbilang = ucwords($this->terbilang($salary->take_home_pay) . ' rupiah');

        // === [BARU] 5. AMBIL DATA BENDAHARA DARI DATABASE ===
        // Mengambil data yang tadi kita buat di tabel settings
        $bendahara = [
            'nama'    => DB::table('settings')->where('key', 'bendahara_nama')->value('value') ?? 'I Wayan Sudirta',
            'nip'     => DB::table('settings')->where('key', 'bendahara_nip')->value('value') ?? '-',
            'jabatan' => DB::table('settings')->where('key', 'bendahara_jabatan')->value('value') ?? 'Pejabat Pengelola Administrasi Belanja Pegawai',
        ];
        // ====================================================

        // 6. Debug HTML (Opsional)
        if (request()->query('debug_html')) {
            return view('admin.salary.print', compact('salary', 'terbilang', 'bendahara'));
        }

        // 7. Generate PDF
        // Masukkan variabel $bendahara ke dalam compact()
        $pdf = Pdf::loadView('admin.salary.print', compact('salary', 'terbilang', 'bendahara'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Slip_Gaji_' . $salary->user->nip . '.pdf');
    }

    /**
     * DOWNLOAD ZIP (PDF MASSAL).
     */
    public function downloadZip($year, $month)
    {
        // --- OPTIMASI SERVER (PENTING) ---
        // Naikkan batas memori & waktu eksekusi agar tidak timeout saat generate ratusan PDF
        ini_set('max_execution_time', 600); // 10 Menit
        ini_set('memory_limit', '1024M');   // 1 GB RAM
        // ---------------------------------

        // 1. Setup Folder (SECURITY UPDATE 🔒)
        // Kita simpan di folder 'app/private_temp_zip' (bukan public)
        // Agar file ZIP tidak bisa ditembak/didownload orang lain lewat URL browser.
        $path = storage_path('app/private_temp_zip'); 
        
        if (!file_exists($path)) {
            mkdir($path, 0755, true); // 0755 sudah cukup aman untuk folder sistem
        }

        // 2. Ambil data
        $salaries = Salary::with('user')
            ->where('year', $year)
            ->where('month', $month)
            ->get();

        if ($salaries->isEmpty()) {
            return back()->with('error', 'Data gaji tidak ditemukan.');
        }

        // === AMBIL DATA BENDAHARA DARI DATABASE ===
        $bendahara = [
            'nama'    => DB::table('settings')->where('key', 'bendahara_nama')->value('value') ?? 'I Wayan Sudirta',
            'nip'     => DB::table('settings')->where('key', 'bendahara_nip')->value('value') ?? '-',
            'jabatan' => DB::table('settings')->where('key', 'bendahara_jabatan')->value('value') ?? 'Pejabat Pengelola Administrasi Belanja Pegawai',
        ];

        // 3. Nama File ZIP
        $zipFileName = 'Arsip_Gaji_' . $month . '_' . $year . '.zip';
        $zipFilePath = $path . '/' . $zipFileName;

        // 4. Proses ZIP
        $zip = new \ZipArchive;

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            
            foreach ($salaries as $salary) {
                // Generate Terbilang
                $terbilang = ucwords($this->terbilang($salary->take_home_pay) . ' rupiah');

                // Generate PDF
                $pdf = Pdf::loadView('admin.salary.print', compact('salary', 'terbilang', 'bendahara'));
                
                // Bersihkan nama file (Hanya huruf, angka, dan strip)
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', trim($salary->user->name));
                
                // Format nama file dalam ZIP: "NIP_Nama.pdf"
                $fileNameInsideZip = $salary->user->nip . '_' . $cleanName . '.pdf';

                $zip->addFromString($fileNameInsideZip, $pdf->output());
            }

            $zip->close();
        } else {
            return back()->with('error', 'Gagal membuat file ZIP (Permission Denied).');
        }

        // 5. Bersihkan Buffer (PENTING agar ZIP tidak corrupt)
        if (ob_get_length()) {
            ob_end_clean();
        }

        // 6. Download & Hapus File Sementara
        // deleteFileAfterSend(true) akan otomatis menghapus file ZIP dari server setelah terkirim
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    /**
     * Helper: Terbilang.
     */
    public function terbilang($nilai) {
        $nilai = abs((int)$nilai);
        if ($nilai === 0) return "nol";

        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";

        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = $this->terbilang($nilai - 10) . " belas";
        } elseif ($nilai < 100) {
            $temp = $this->terbilang((int)($nilai / 10)) . " puluh" . $this->terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = " seratus" . $this->terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = $this->terbilang((int)($nilai / 100)) . " ratus" . $this->terbilang($nilai % 100);
        } elseif ($nilai < 1000000) {
            $temp = $this->terbilang((int)($nilai / 1000)) . " ribu" . $this->terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = $this->terbilang((int)($nilai / 1000000)) . " juta" . $this->terbilang($nilai % 1000000);
        } else {
            $temp = $this->terbilang((int)($nilai / 1000000000)) . " miliar" . $this->terbilang($nilai % 1000000000);
        }

        return $temp;
    }
}