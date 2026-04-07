<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Jangan lupa import ini

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // ==========================================
        // SKENARIO 1: TAMPILAN KHUSUS PEGAWAI
        // ==========================================
        if ($user->hasRole('pegawai')) {
            
            // 1. Query Dasar
            $query = Salary::where('user_id', $user->id);

            // 2. Logika Filter (Jika user memilih Bulan/Tahun)
            if ($request->filled('filter_month')) {
                $query->where('month', $request->filter_month);
            }

            if ($request->filled('filter_year')) {
                $query->where('year', $request->filter_year);
            }

            // 3. Eksekusi Query untuk Tabel Riwayat
            // Clone query agar tidak mengganggu query salary terbaru nanti
            $salaries = (clone $query)
                ->orderBy('year', 'desc')
                ->orderByRaw("FIELD(month, 'Desember', 'November', 'Oktober', 'September', 'Agustus', 'Juli', 'Juni', 'Mei', 'April', 'Maret', 'Februari', 'Januari')")
                ->get();

            // 4. Ambil Slip Paling Baru (Tanpa Filter - Selalu tampilkan yang terbaru di kartu atas)
            // Kita ambil dari database langsung tanpa filter agar kartu "Terbaru" tidak hilang saat difilter
            $latestSalary = Salary::where('user_id', $user->id)
                            ->orderBy('year', 'desc')
                            ->orderByRaw("FIELD(month, 'Desember', 'November', 'Oktober', 'September', 'Agustus', 'Juli', 'Juni', 'Mei', 'April', 'Maret', 'Februari', 'Januari')")
                            ->first();

            // 5. Ambil Daftar Tahun yang tersedia (Untuk Dropdown)
            $availableYears = Salary::where('user_id', $user->id)
                ->select('year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');

            return view('user.dashboard', compact('salaries', 'latestSalary', 'availableYears'));
        }

        // ==========================================
        // SKENARIO 2: TAMPILAN KHUSUS ADMIN (Kode Lama Anda)
        // ==========================================
        if ($user->hasRole('admin')) {
            // 1. Total Pegawai
            $totalPegawai = User::role('pegawai')->count();
            
            // 2. Total Admin
            $totalAdmin = User::role('admin')->count();
            
            // 3. Ambil bulan & tahun terbaru dari database salary
            $latestSalaryData = Salary::latest('id')->first();
            
            if ($latestSalaryData) {
                $currentMonth = $latestSalaryData->month;
                $currentYear = $latestSalaryData->year;
                $currentMonthIndo = $currentMonth; 
            } else {
                $currentMonth = now()->format('F');
                $currentYear = now()->year;
                
                $monthMap = [
                    'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
                    'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
                    'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
                    'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
                ];
                
                $currentMonthIndo = $monthMap[$currentMonth];
            }
            
            // 4. Hitung slip gaji yang sudah terupload
            $slipUploaded = Salary::where('month', $currentMonthIndo)
                ->where('year', $currentYear)
                ->select('user_id')
                ->distinct()
                ->count();
            
            // 5. Persentase
            $slipPercentage = $totalPegawai > 0 ? round(($slipUploaded / $totalPegawai) * 100) : 0;
            
            // 6. Pending
            $slipPending = $totalPegawai - $slipUploaded;
            
            // 7. Pegawai baru
            $newEmployeesThisMonth = User::role('pegawai')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            // Return ke view dashboard admin (view lama Anda)
            return view('dashboard', compact(
                'totalPegawai', 'totalAdmin', 'currentMonthIndo', 'currentYear',
                'slipUploaded', 'slipPercentage', 'slipPending', 'newEmployeesThisMonth'
            ));
        }

        // Default jika tidak punya role
        abort(403);
    }
}