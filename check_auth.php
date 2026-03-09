<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

// Cek user dengan role admin
$admins = User::role('admin')->get();
echo "Total Admins: " . count($admins) . "\n";
foreach ($admins as $u) {
    echo "- ID: {$u->id}, Name: {$u->name}, Email: {$u->email}\n";
}

// Cek user dengan role pegawai
$employees = User::role('pegawai')->get();
echo "\nTotal Pegawai: " . count($employees) . "\n";
foreach ($employees->take(3) as $u) {
    echo "- ID: {$u->id}, Name: {$u->name}, Email: {$u->email}\n";
}

// Cek Salary dengan id=31
echo "\n---\n";
$s = \App\Models\Salary::find(31);
if ($s) {
    echo "Salary found: id={$s->id}, user_id={$s->user_id}\n";
    echo "User: " . ($s->user ? $s->user->name : "NULL") . "\n";
} else {
    echo "Salary id=31 NOT FOUND\n";
}

// Cek kondisi di tabel slaries
echo "\nTotal Salaries: " . \App\Models\Salary::count() . "\n";
?>
