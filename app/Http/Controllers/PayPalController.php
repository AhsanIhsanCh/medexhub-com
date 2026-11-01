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

    
    public function pay(Request $request, PayPalService $paypal)
    {
        // Demo price. In production, retrieve this
        // from your database rather than the browser.
        // $amountMinor = 4999;
        $currency = config('services.paypal.currency');
        
        $payment = Payment::create([
            // 'user_id' => auth()->id(),
            'pay_u_id' => auth()->id(),
            'pay_in_id' => $request->input('InvoiceId'),
            'pay_e_id' => $request->input('ExamId'),
            'pay_for' => $request->input('PayFor'),
            'pay_purchase_type' => $request->input('PurchaseType'),
            'pay_amount_total' => $request->input('AmountTotal'),
            'pay_amount_minor' => $request->input('AmountPayable'),
            'pay_amount_discount' => $request->input('AmountDiscount'),
            'pay_description' => 'MedexHub Exam Access',
            'pay_currency' => $currency,
            'pay_status' => 'pending',
        ]);

        try {
            $order = $paypal->createOrder(
                number_format($amountMinor / 100, 2, '.', ''),
                $currency,
                'payment-' . $payment->id
            );

            $payment->update([
                'paypal_order_id' => $order['id'],
                'pay_status' => 'created',
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

            $payment->update(['pay_status' => 'failed']);

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
            ->where('pay_u_id', auth()->id())
            ->firstOrFail();

        if ($payment->pay_status === 'completed') {
            return view('payments.success');
        }

        try {
            // Confirm approval and transaction identity.
            $order = $paypal->getOrder($orderId);

            if (($order['pay_status'] ?? null) !== 'APPROVED') {
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

            $amount = number_format($payment->pay_amount_minor / 100,2,'.','');

            if (($unit['amount']['value'] ?? null) !== $amount
                || ($unit['amount']['currency_code'] ?? null)
                    !== $payment->pay_currency) {
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

            if (($result['pay_status'] ?? null) !== 'COMPLETED'
                || ($capture['pay_status'] ?? null) !== 'COMPLETED'
                || empty($capture['id'])
                || ($capture['amount']['value'] ?? null) !== $amount
                || ($capture['amount']['currency_code'] ?? null)
                    !== $payment->pay_currency) {
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

                if ($locked->pay_status !== 'completed') {
                    $locked->update([
                        'paypal_capture_id' => $capture['id'],
                        'pay_status' => 'completed',
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