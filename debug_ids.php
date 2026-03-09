<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Salary;

$salaries = Salary::all();
echo "Total salaries: " . count($salaries) . "\n";
foreach ($salaries as $s) {
    echo "id: {$s->id} | user_id: {$s->user_id} | month: {$s->month} | year: {$s->year}\n";
}
