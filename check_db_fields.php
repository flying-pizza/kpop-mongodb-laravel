<?php

use App\Models\Kpop;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $kpop = Kpop::first();
    if ($kpop) {
        echo "Found record:\n";
        print_r($kpop->getAttributes());
    } else {
        echo "No records found in 'idols' collection.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
