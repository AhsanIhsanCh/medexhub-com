<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PayPalController extends Controller
{
    public function checkout()
    {
        return view('payments.checkout');
    }

    public function pay(PayPalService $paypal)
    {
        // Demo price. In production, retrieve this
        // from your database rather than the browser.
        $amountMinor = 4999;
        $currency = config('services.paypal.currency');

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'description' => 'MedexHub Exam Access',
            'amount_minor' => $amountMinor,
            'currency' => $currency,
            'status' => 'pending',
        ]);

        try {
            $order = $paypal->createOrder(
                number_format($amountMinor / 100, 2, '.', ''),
                $currency,
                'payment-' . $payment->id
            );

            $payment->update([
                'paypal_order_id' => $order['id'],
                'status' => 'created',
            ]);

            $approvalUrl = collect($order['links'] ?? [])
                ->first(fn ($link) =>
                    in_array(
                        $link['rel'] ?? '',
                        ['payer-action', 'approve'],
                        true
                    )
                )['href'] ?? null;

            if (!$approvalUrl) {
                throw new \RuntimeException(
                    'PayPal approval URL missing.'
                );
            }

            return redirect()->away($approvalUrl);

        } catch (\Throwable $e) {
            report($e);

            $payment->update(['status' => 'failed']);

            return back()->withErrors([
                'paypal' => 'Unable to initialise payment.',
            ]);
        }
    }

    public function success(
        Request $request,
        PayPalService $paypal
    ) {
        $request->validate([
            'token' => ['required', 'string', 'max:255'],
        ]);

        $orderId = $request->query('token');

        $payment = Payment::where('paypal_order_id', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($payment->status === 'completed') {
            return view('payments.success');
        }

        try {
            // Confirm approval and transaction identity.
            $order = $paypal->getOrder($orderId);

            if (($order['status'] ?? null) !== 'APPROVED') {
                return redirect()->route('paypal.checkout')
                    ->withErrors([
                        'paypal' => 'Payment not yet approved.',
                    ]);
            }

            $unit = $order['purchase_units'][0] ?? [];

            if (($unit['reference_id'] ?? null)
                    !== 'payment-' . $payment->id) {
                throw new \RuntimeException(
                    'Order reference mismatch.'
                );
            }

            $amount = number_format(
                $payment->amount_minor / 100,
                2,
                '.',
                ''
            );

            if (($unit['amount']['value'] ?? null) !== $amount
                || ($unit['amount']['currency_code'] ?? null)
                    !== $payment->currency) {
                throw new \RuntimeException(
                    'Payment amount or currency mismatch.'
                );
            }

            $result = $paypal->captureOrder(
                $orderId,
                'capture-payment-' . $payment->id
            );

            $capture = $result['purchase_units'][0]
                ['payments']['captures'][0] ?? [];

            if (($result['status'] ?? null) !== 'COMPLETED'
                || ($capture['status'] ?? null) !== 'COMPLETED'
                || empty($capture['id'])
                || ($capture['amount']['value'] ?? null) !== $amount
                || ($capture['amount']['currency_code'] ?? null)
                    !== $payment->currency) {
                throw new \RuntimeException(
                    'Payment capture not confirmed.'
                );
            }

            DB::transaction(function () use (
                $payment,
                $capture
            ) {
                $locked = Payment::whereKey($payment->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($locked->status !== 'completed') {
                    $locked->update([
                        'paypal_capture_id' => $capture['id'],
                        'status' => 'completed',
                        'paid_at' => now(),
                    ]);

                    // Grant purchased exam/course access here.
                    // This must be idempotent.
                }
            });

            return view('payments.success');

        } catch (\Throwable $e) {
            report($e);

            // Do not mark the payment failed here.
            // Capture may have succeeded before a timeout.

            return redirect()->route('paypal.checkout')
                ->withErrors([
                    'paypal' =>
                        'Payment confirmation is pending. '
                        . 'Please contact support before retrying.',
                ]);
        }
    }

    public function cancel()
    {
        return view('payments.cancel');
    }
}