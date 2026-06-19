<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    \Illuminate\Support\Facades\Mail::raw('Test koneksi SMTP PropCentral berhasil!', function($m) {
        $m->to('althafarros05@gmail.com')->subject('Test SMTP PropCentral');
    });
    echo "✅ SMTP BERHASIL - Email terkirim!\n";
} catch (\Exception $e) {
    echo "❌ SMTP GAGAL: " . $e->getMessage() . "\n";
}
