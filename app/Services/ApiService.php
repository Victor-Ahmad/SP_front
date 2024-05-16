<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        $response = Http::post($this->baseUrl . 'add_Password', $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }



    public function getSwapTypes()
    {
        $response = Http::get($this->baseUrl . 'get_swap_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getHouseTypes()
    {
        $response = Http::get($this->baseUrl . 'get_houses_types');

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('API call failed: ' . $response->body());
    }
}
