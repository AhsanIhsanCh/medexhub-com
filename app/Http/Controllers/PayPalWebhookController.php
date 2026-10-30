<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayPalWebhookController extends Controller
{
    public function handle(
        Request $request,
        PayPalService $paypal
    ) {
        $event = $request->json()->all();

        try {
            $verified = $paypal->verifyWebhook([
                'paypal-transmission-id' =>
                    $request->header('PayPal-Transmission-Id'),
                'paypal-transmission-time' =>
                    $request->header('PayPal-Transmission-Time'),
                'paypal-cert-url' =>
                    $request->header('PayPal-Cert-Url'),
                'paypal-auth-algo' =>
                    $request->header('PayPal-Auth-Algo'),
                'paypal-transmission-sig' =>
                    $request->header('PayPal-Transmission-Sig'),
            ], $event);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Verification unavailable',
            ], 503);
        }

        if (!$verified) {
            return response()->json([
                'message' => 'Invalid signature',
            ], 400);
        }

        $type = $event['event_type'] ?? null;
        $resource = $event['resource'] ?? [];

        // PayPal's capture resource provides the order ID.
        $orderId = $resource['supplementary_data']
            ['related_ids']['order_id'] ?? null;

        if (!$orderId) {
            return response()->json(['received' => true]);
        }

        $payment = Payment::where(
            'paypal_order_id',
            $orderId
        )->first();

        if (!$payment) {
            return response()->json(['received' => true]);
        }

        if ($type === 'PAYMENT.CAPTURE.COMPLETED') {
            $amount = number_format(
                $payment->amount_minor / 100,
                2,
                '.',
                ''
            );

            if (($resource['status'] ?? null) !== 'COMPLETED'
                || empty($resource['id'])
                || ($resource['amount']['value'] ?? null)
                    !== $amount
                || ($resource['amount']['currency_code'] ?? null)
                    !== $payment->currency) {
                return response()->json([
                    'message' => 'Capture mismatch',
                ], 422);
            }

            DB::transaction(function () use (
                $payment,
                $resource
            ) {
                $locked = Payment::whereKey($payment->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($locked->status === 'completed') {
                    return;
                }

                $locked->update([
                    'status' => 'completed',
                    'paypal_capture_id' => $resource['id'],
                    'paid_at' => now(),
                ]);

                // Grant exam access exactly once here.
            });
        }

        if (in_array($type, [
            'PAYMENT.CAPTURE.REFUNDED',
            'PAYMENT.CAPTURE.REVERSED',
        ], true)) {
            // Reconcile with the original capture ID
            // before changing entitlements.
            // Record refund/reversal details separately.
        }

        return response()->json(['received' => true]);
    }
}