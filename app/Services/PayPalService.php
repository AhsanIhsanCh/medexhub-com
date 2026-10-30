<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    private function baseUrl(): string
    {
        return config('services.paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    private function accessToken(): string
    {
        $response = Http::withBasicAuth(
            config('services.paypal.client_id'),
            config('services.paypal.client_secret')
        )
        ->asForm()
        ->post($this->baseUrl() . '/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);

        $response->throw();

        return $response->json('access_token')
            ?? throw new RuntimeException(
                'PayPal access token missing.'
            );
    }

    private function client()
    {
        return Http::withToken($this->accessToken())
            ->acceptJson()
            ->asJson()
            ->timeout(30);
    }

    public function createOrder(
        string $amount,
        string $currency,
        string $reference
    ): array {
        $response = $this->client()
            ->withHeaders([
                'PayPal-Request-Id' => $reference,
            ])
            ->post(
                $this->baseUrl() . '/v2/checkout/orders',
                [
                    'intent' => 'CAPTURE',
                    'purchase_units' => [[
                        'reference_id' => $reference,
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => $amount,
                        ],
                    ]],
                    'payment_source' => [
                        'paypal' => [
                            'experience_context' => [
                                'return_url' =>
                                    route('paypal.success'),
                                'cancel_url' =>
                                    route('paypal.cancel'),
                                'user_action' => 'PAY_NOW',
                            ],
                        ],
                    ],
                ]
            );

        $response->throw();

        return $response->json();
    }

    public function getOrder(string $orderId): array
    {
        $response = $this->client()->get(
            $this->baseUrl()
            . '/v2/checkout/orders/'
            . rawurlencode($orderId)
        );

        $response->throw();

        return $response->json();
    }

    public function captureOrder(
        string $orderId,
        string $requestId
    ): array {
        $response = $this->client()
            ->withHeaders([
                'PayPal-Request-Id' => $requestId,
            ])
            ->post(
                $this->baseUrl()
                . '/v2/checkout/orders/'
                . rawurlencode($orderId)
                . '/capture',
                new \stdClass()
            );

        $response->throw();

        return $response->json();
    }

    public function verifyWebhook(
        array $headers,
        array $event
    ): bool {
        $required = [
            'paypal-transmission-id',
            'paypal-transmission-time',
            'paypal-cert-url',
            'paypal-auth-algo',
            'paypal-transmission-sig',
        ];

        foreach ($required as $key) {
            if (empty($headers[$key])) {
                return false;
            }
        }

        $webhookId = config('services.paypal.webhook_id');

        if (!$webhookId) {
            return false;
        }

        $response = $this->client()->post(
            $this->baseUrl()
            . '/v1/notifications/verify-webhook-signature',
            [
                'transmission_id' =>
                    $headers['paypal-transmission-id'],
                'transmission_time' =>
                    $headers['paypal-transmission-time'],
                'cert_url' =>
                    $headers['paypal-cert-url'],
                'auth_algo' =>
                    $headers['paypal-auth-algo'],
                'transmission_sig' =>
                    $headers['paypal-transmission-sig'],
                'webhook_id' => $webhookId,
                'webhook_event' => $event,
            ]
        );

        $response->throw();

        return $response->json('verification_status')
            === 'SUCCESS';
    }
}