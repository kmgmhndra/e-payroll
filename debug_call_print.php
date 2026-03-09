<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\Admin\UserController;

try {
    $ctrl = new UserController();
    $result = $ctrl->printSalary(31);
    echo "Controller returned: ";
    if (is_string($result)) {
        echo substr($result,0,200) . "\n";
    } elseif (is_object($result)) {
        echo get_class($result) . "\n";
    } else {
        var_dump($result);
    }
} catch (Throwable $e) {
    echo "EXCEPTION: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
