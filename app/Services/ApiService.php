<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;


class ApiService
{
    protected $baseUrl;
    protected $http;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.base_url'), '/') . '/';
        $this->http = Http::timeout(180);
    }

    // public function revokeLogin($response)
    // {
    //     if ($response->json()['message'] == "Unauthorized") {
    //         Session::forget('user_id');
    //         Session::forget('user');
    //         Session::forget('token');
    //     }
    // }


    public function signUp($data, $files)
    {
        $multipartData = [];

        // Helper function to handle nested arrays
        function addMultipartData(&$multipartData, $key, $value)
        {
            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    addMultipartData($multipartData, "{$key}[{$subKey}]", $subValue);
                }
            } else {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => (string) $value
                ];
            }
        }

        // Add form data to multipart
        foreach ($data as $key => $value) {
            addMultipartData($multipartData, $key, $value);
        }

        // Add files to multipart
        if ($files) {
            foreach ($files as $file) {
                if ($file instanceof UploadedFile && $file->isValid()) {
                    $multipartData[] = [
                        'name' => 'house[images][]',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName()
                    ];
                }
            }
        }

        // Make the HTTP request
        $response = $this->http->asMultipart()->post($this->baseUrl . 'sign_up', $multipartData);

        if ($response->successful()) {
            return $response->json();
        }

        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }












    // public function signUp($data, $files)
    // {

    //     $httpRequest = $this->http->asMultipart();

    //     if ($files) {
    //         foreach ($files as $file) {
    //             if ($file->isValid()) {
    //                 $httpRequest = $httpRequest->attach(
    //                     "house['images'][]",
    //                     fopen($file->getPathname(), 'r'),
    //                     $file->getClientOriginalName()
    //                 );
    //             }
    //         }
    //     }

    //     $response = $this->http->post($this->baseUrl . 'sign_up', $data);
    //     if ($response->successful()) {
    //         return $response->json();
    //     }

    //     $this->revokeLogin($response);
    //     throw new \Exception('API call failed: ' . $response->body());
    // }

    public function login(array $data)
    {
        $response = $this->http->post($this->baseUrl . 'login', $data);
        if ($response->successful()) {
            return $response->json();
        }
        if ($response->json()['success'] == 0) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }


    public function verifyOtp(array $data)
    {
        $response = $this->http->post($this->baseUrl . 'verify_OTP', $data);

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function setPassword(array $data)
    {
        $response = $this->http->withToken(Session::get('token'))->post($this->baseUrl . 'add_Password', $data);

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }



    public function getSwapTypes()
    {
        $response = $this->http->get($this->baseUrl . 'get_swap_types');

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getHouseTypes()
    {
        $response = $this->http->get($this->baseUrl . 'get_houses_types');

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }
    public function getHouseProperties()
    {
        $response = $this->http->get($this->baseUrl . 'get_specific_properties');

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getChats()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . 'chats');

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getChatMessages($chatId, $page = 1)
    {

        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . "show_chats/{$chatId}?page={$page}");

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
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
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }
    public function getPosts($data = [])
    {
        $response = $this->http->withToken(Session::get('token'))->post($this->baseUrl . 'get_swap_houses', $data);
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }


    public function sendFeedback($data)
    {
        $response = $this->http->withToken(Session::get('token'))->post($this->baseUrl . 'store_feedback', $data);

        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function getProfile()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . 'get_profile',);
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function updateProfile($data, $files)
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
        $response = $httpRequest->post($this->baseUrl . 'update_profile', $data);

        // Check the response
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function checkNewMessages()
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . "chats_with_unread_messages");
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }

    public function checkChat($userId)
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . "is_chat_existing/{$userId}");
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }


    public function deleteAccount()
    {
        $response = $this->http->withToken(Session::get('token'))->delete($this->baseUrl . "deleteUser");
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }


    public function getPost($id)
    {
        $response = $this->http->withToken(Session::get('token'))->get($this->baseUrl . "get_house_by_id/{$id}");
        if ($response->successful()) {
            return $response->json();
        }
        $this->revokeLogin($response);
        throw new \Exception('API call failed: ' . $response->body());
    }
}
