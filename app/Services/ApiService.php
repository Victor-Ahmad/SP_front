<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.base_url'), '/') . '/';
    }

    public function signUp(array $data)
    {
        $response = Http::post($this->baseUrl . 'sign_up', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function login(array $data)
    {
        $response = Http::post($this->baseUrl . 'login', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }


    public function verifyOtp(array $data)
    {
        $response = Http::post($this->baseUrl . 'verify_OTP', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function setPassword(array $data)
    {
        $response = Http::withToken(Session::get('token'))->post($this->baseUrl . 'add_Password', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }



    public function getSwapTypes()
    {
        $response = Http::withToken(Session::get('token'))->get($this->baseUrl . 'get_swap_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getHouseTypes()
    {
        $response = Http::withToken(Session::get('token'))->get($this->baseUrl . 'get_houses_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function completeAccount($data, $files)
    {
        // Initialize the HTTP request with token and multipart form data
        $httpRequest = Http::withToken(Session::get('token'))->asMultipart();

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
        $response = Http::withToken(Session::get('token'))->post($this->baseUrl . 'get_swap_houses', $data);
        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }
}
