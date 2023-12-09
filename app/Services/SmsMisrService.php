<?php

// app/Services/SmsMisrService.php

namespace App\Services;

use GuzzleHttp\Client;

class SmsMisrService
{
    protected $username;
    protected $password;
    protected $apiUrl;

    public function __construct($username, $password, $apiUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
    }

    public function sendSMS($to, $message)
    {
        $client = new Client();

        $response = $client->post($this->apiUrl, [
            'form_params' => [
                'username' => $this->username,
                'password' => $this->password,
                'numbers' => $to,
                'sender' => 'ElsayedbenRabeaa',
                'message' => $message,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}








?>