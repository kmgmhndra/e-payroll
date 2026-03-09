<?php
ini_set('memory_limit', '2048M');
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Http\Controllers\Admin\UserController;

// Login sebagai admin
$admin = User::find(1);
auth()->login($admin);

echo "Logged in as: " . auth()->user()->name . "\n";
echo "Has role admin: " . (auth()->user()->hasRole('admin') ? 'YES' : 'NO') . "\n\n";

// Panggil method
try {
    $controller = new UserController();
    $response = $controller->printSalary(31);
    
    echo "Success! Response type: " . get_class($response) . "\n";
    if (method_exists($response, 'header')) {
        echo "Headers:\n";
        foreach ($response->headers as $k => $v) {
            if (is_string($v)) {
                echo "  $k: " . substr($v, 0, 100) . "\n";
            } elseif (is_array($v)) {
                echo "  $k: " . implode(", ", array_slice($v, 0, 2)) . "\n";
            }
        }
    }
} catch (Throwable $e) {
    echo "EXCEPTION: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "Trace:\n" . substr($e->getTraceAsString(), 0, 1000) . "\n";
}
?>
