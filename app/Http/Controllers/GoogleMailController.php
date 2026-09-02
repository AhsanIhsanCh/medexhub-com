<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

class GoogleMailController extends Controller
{
    private function googleClient()
    {
        $client = new Client();

        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        $client->setScopes([
            Gmail::GMAIL_SEND
        ]);

        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }

    public function redirect()
    {
        $client = $this->googleClient();

        return redirect()->away($client->createAuthUrl());
    }

    public function callback()
    {
        if (!request('code')) {
            return 'Google authorization failed.';
        }

        $client = $this->googleClient();

        $token = $client->fetchAccessTokenWithAuthCode(
            request('code')
        );

        if (isset($token['error'])) {
            return response()->json($token, 400);
        }

        return response()->json([
            'message' => 'Authorization successful',
            'refresh_token' => $token['refresh_token'] ?? null,
            'access_token' => $token['access_token'] ?? null,
        ]);
    }

    public function sendTest()
    {
        $this->sendGmail(
            'medextech7@gmail.com',
            'Test Email',
            '<h2>Hello</h2><p>This email was sent from Laravel 12 using the Gmail API.</p>'
        );

        return 'Email sent successfully.';
    }

    public function sendGmail($to, $subject, $html)
    {
        $client = $this->googleClient();

        $refreshToken = config('services.google.refresh_token');

        $token = $client->fetchAccessTokenWithRefreshToken(
            $refreshToken
        );

        if (isset($token['error'])) {
            throw new \Exception(
                'Google authentication failed: ' .
                ($token['error_description'] ?? $token['error'])
            );
        }

        $client->setAccessToken($token);

        $gmail = new Gmail($client);

        $from = config('services.google.gmail_address');

        $rawMessage = "From: {$from}\r\n";
        $rawMessage .= "To: {$to}\r\n";
        $rawMessage .= "Subject: =?UTF-8?B?" .
            base64_encode($subject) .
            "?=\r\n";

        $rawMessage .= "MIME-Version: 1.0\r\n";
        $rawMessage .= "Content-Type: text/html; charset=UTF-8\r\n";
        $rawMessage .= "\r\n";
        $rawMessage .= $html;

        $encodedMessage = rtrim(
            strtr(
                base64_encode($rawMessage),
                '+/',
                '-_'
            ),
            '='
        );

        $message = new Message();
        $message->setRaw($encodedMessage);

        return $gmail->users_messages->send(
            'me',
            $message
        );
    }
}
