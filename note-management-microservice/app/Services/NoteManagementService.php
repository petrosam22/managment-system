<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class NoteManagementService
{
    protected $client;
    protected $baseUrl;
    protected $accessToken;

    public function __construct($baseUrl, $accessToken)
    {
        $this->client = new Client();
        $this->baseUrl = $baseUrl;
        $this->accessToken = $accessToken;
    }

    public function createNote($data)
    {
        try {
            $response = $this->client->post($this->baseUrl . '/api/notes', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ],
                'json' => $data,
            ]);

            return $response;
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }
}