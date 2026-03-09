<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Salary;

$s = Salary::with('user')->find(31);
if ($s) {
    echo "Salary found: id {$s->id}, user_id {$s->user_id}\n";
    echo "User relation: " . ($s->user ? "present (id={$s->user->id})" : "null") . "\n";
} else {
    echo "Salary not found\n";
}

echo "View exists: " . (view()->exists('admin.salary.print') ? 'yes' : 'no') . "\n";

// Try simple render size (may be memory heavy, so we'll only get length)
try {
    $html = view('admin.salary.print', compact('s'))->render();
    echo "Rendered HTML length: " . strlen($html) . "\n";
} catch (Throwable $e) {
    echo "Render exception: " . get_class($e) . " - " . $e->getMessage() . "\n";
}
