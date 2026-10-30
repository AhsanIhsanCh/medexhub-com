<?php
use App\Http\Controllers\PayPalWebhookController;

Route::post('/paypal/webhook',
    [PayPalWebhookController::class, 'handle']
);
