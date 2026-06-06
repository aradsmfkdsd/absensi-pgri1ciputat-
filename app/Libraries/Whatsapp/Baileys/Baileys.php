<?php

namespace App\Libraries\Whatsapp\Baileys;

use App\Libraries\Whatsapp\Whatsapp;

class Baileys implements Whatsapp
{
    public function __construct(public ?string $token = null) {}

    public function getProvider(): string
    {
        return 'Baileys';
    }

    public function getToken(): string
    {
        return $this->token ?? '';
    }

    /**
     * Send message using Baileys local server gateway
     * @param array|string $message
     * @return string
     */
    public function sendMessage(array|string $message): string
    {
        $apiUrl = getenv('WHATSAPP_API_URL') ?: 'http://localhost:3000/send-message';
        
        $number = '';
        $text = '';
        
        if (is_array($message)) {
            $number = $message['destination'] ?? ($message['target'] ?? '');
            $text = $message['message'] ?? '';
        } else {
            $text = $message;
        }

        if (empty($number)) {
            return 'Error: Nomor tujuan kosong';
        }

        $payload = json_encode([
            'number' => $number,
            'message' => $text
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload)
            ],
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error: " . $err;
        }

        try {
            $responseDecoded = json_decode($response, true);
            if (isset($responseDecoded['status']) && $responseDecoded['status'] === true) {
                return 'Sukses';
            }
            return $responseDecoded['message'] ?? 'Gagal mengirim via Baileys';
        } catch (\Exception $e) {
            return 'Exception: ' . $e->getMessage();
        }
    }
}
