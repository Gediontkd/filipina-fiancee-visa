<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Checking Stripe Config:\n";
$key = config('services.stripe.key');
$secret = config('services.stripe.secret');

if (empty($key)) {
    echo "STRIPE_KEY is MISSING in config!\n";
} else {
    echo "STRIPE_KEY is set (" . substr($key, 0, 4) . "...)\n";
}

if (empty($secret)) {
    echo "STRIPE_SECRET is MISSING in config!\n";
} else {
    echo "STRIPE_SECRET is set (" . substr($secret, 0, 4) . "...)\n";
}
