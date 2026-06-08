<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class WhatsappGateway extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper('user');
        if (!is_superadmin()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $data = [
            'title' => 'WhatsApp Gateway',
            'ctx' => 'whatsapp',
        ];

        return view('admin/whatsapp/index', $data);
    }

    private function callGateway(string $endpoint, string $method = 'GET', array $data = [])
    {
        $apiUrl = getenv('WHATSAPP_API_URL') ?: 'http://localhost:3000/send-message';
        $baseUrl = rtrim(str_replace('send-message', '', $apiUrl), '/');
        $url = $baseUrl . '/' . ltrim($endpoint, '/');

        $curl = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
            $options[CURLOPT_HTTPHEADER] = ['Content-Type: application/json'];
        }

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return [
                'status' => false,
                'message' => 'Gagal terhubung ke WhatsApp Gateway: ' . $err
            ];
        }

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => false,
                'message' => 'Format respons dari gateway tidak valid.'
            ];
        }

        return $decoded;
    }

    public function status()
    {
        $res = $this->callGateway('status');
        return $this->response->setJSON($res);
    }

    public function logout()
    {
        $res = $this->callGateway('logout', 'POST');
        return $this->response->setJSON($res);
    }

    public function testSend()
    {
        $number = $this->request->getPost('number');
        $message = $this->request->getPost('message');

        if (empty($number) || empty($message)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Nomor penerima dan isi pesan wajib diisi.'
            ]);
        }

        $res = $this->callGateway('send-message', 'POST', [
            'number' => $number,
            'message' => $message
        ]);

        return $this->response->setJSON($res);
    }
}
