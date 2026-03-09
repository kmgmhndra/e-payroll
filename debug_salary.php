<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Salary;

echo "=== DEBUG SALARY DATA ===\n\n";

// 1. Total Pegawai
$totalPegawai = User::role('pegawai')->count();
echo "1. Total Pegawai: $totalPegawai\n\n";

// 2. Semua data salary di database
echo "2. Semua Salary Records:\n";
$allSalaries = Salary::all();
echo "   Total: " . count($allSalaries) . " records\n";
if (count($allSalaries) > 0) {
    foreach ($allSalaries->take(5) as $s) {
        echo "   - User: {$s->user_id}, Month: '{$s->month}', Year: {$s->year}\n";
    }
    if (count($allSalaries) > 5) {
        echo "   ... dan " . (count($allSalaries) - 5) . " records lainnya\n";
    }
}

// 3. Cek bulan dan tahun unik
echo "\n3. Bulan & Tahun Unik di Database:\n";
$months = Salary::select('month', 'year')->distinct()->get();
foreach ($months as $m) {
    echo "   - $m->month $m->year\n";
}

// 4. Coba query untuk Januari 2026
echo "\n4. Query: where('month', 'Januari') AND where('year', 2026)\n";
$jan2026 = Salary::where('month', 'Januari')->where('year', 2026)->get();
echo "   Total Records: " . count($jan2026) . "\n";

// 5. Coba dengan distinct
echo "\n5. Query dengan distinct('user_id'):\n";
$distinctUsers = Salary::where('month', 'Januari')
    ->where('year', 2026)
    ->select('user_id')
    ->distinct()
    ->get();
echo "   Total Unique Users: " . count($distinctUsers) . "\n";

echo "\n=== END DEBUG ===\n";
