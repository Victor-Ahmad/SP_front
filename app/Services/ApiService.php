<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class ApiService
{
    protected $baseUrl;
    protected $http;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.base_url'), '/') . '/';
        $this->http = Http::timeout(120);
    }

    public function signUp(array $data)
    {
        $response = $this->http->post($this->baseUrl . 'sign_up', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function login(array $data)
    {
        $response = $this->http->post($this->baseUrl . 'login', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }


    public function verifyOtp(array $data)
    {
        $response = $this->http->post($this->baseUrl . 'verify_OTP', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function setPassword(array $data)
    {
        $response = $this->http->withToken(Session::get('token'))->post($this->baseUrl . 'add_Password', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }



    public function getSwapTypes()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . 'get_swap_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getHouseTypes()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . 'get_houses_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }
    public function getChats()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . 'chats');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getChatMessages($chatId, $page = 1)
    {

        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . "show_chats/{$chatId}?page={$page}");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function completeAccount($data, $files)
    {
        // Initialize the HTTP request with token and multipart form data
        $httpRequest = $this->http->withToken(Session::get('token'))->asMultipart();

        // Attach files to the request
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $httpRequest = $httpRequest->attach(
                        'images[]',
                        fopen($file->getPathname(), 'r'),
                        $file->getClientOriginalName()
                    );
                }
            }
        }

        // Send the API request with the data and files
        $response = $httpRequest->post($this->baseUrl . 'complete_registeration', $data);

        // Check the response
        if ($response->successful()) {
            return $response->json();
        }
        error_log(json_encode($response->json()));
        throw new \Exception('API call failed: ' . $response->body());
    }
    public function getPosts($data = [])
    {
        $response = $this->http->withToken(Session::get('token'))->post($this->baseUrl . 'get_swap_houses', $data);
        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }
}
