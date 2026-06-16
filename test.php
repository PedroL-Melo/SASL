<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    App\Models\Laboratorio::create([
        'nome' => 'Lab Teste',
        'capacidade' => 30,
        'bloco' => 'B',
        'piso' => 1,
        'status_laboratorio' => 'disponivel'
    ]);
    echo "OK LAB CREATED\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
