<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

// Login sebagai admin
$admin = User::find(1);
auth()->login($admin);

echo "Step 1: Get salary...\n";
$salary = \App\Models\Salary::with('user')->find(31);
echo "  Salary found: id={$salary->id}\n";

echo "Step 2: Generate terbilang...\n";
$ctrl = new \App\Http\Controllers\Admin\UserController();
$terbilang = ucwords($ctrl->terbilang($salary->take_home_pay) . ' rupiah');
echo "  Terbilang: " . substr($terbilang, 0, 50) . "...\n";

echo "Step 3: Render view as HTML (no PDF)...\n";
try {
    $html = view('admin.salary.print', compact('salary', 'terbilang'))->render();
    echo "  HTML rendered successfully. Size: " . strlen($html) . " bytes\n";
    echo "  First 200 chars:\n";
    echo "  " . substr($html, 0, 200) . "\n";
} catch (Throwable $e) {
    echo "  ERROR: " . $e->getMessage() . "\n";
}

echo "\nStep 4: Generate PDF...\n";
try {
    ini_set('memory_limit', '2048M');
    ini_set('max_execution_time', 300);
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.salary.print', compact('salary', 'terbilang'));
    echo "  PDF object created\n";
    $pdf->setPaper('A4', 'portrait');
    echo "  Paper set\n";
    $stream = $pdf->stream();
    echo "  Stream returned successfully\n";
} catch (Throwable $e) {
    echo "  ERROR: " . get_class($e) . " - " . $e->getMessage() . "\n";
}

echo "\nDone!\n";
?>
