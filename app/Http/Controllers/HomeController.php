<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class HomeController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }



    public function home()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }

        try {
            $data = [
                'price_min' => request()->min_value,
                'price_max' => request()->max_value,
                'number_of_rooms' => request()->rooms,
                'location' => request()->location,
            ];

            $data = array_filter($data, function ($value) {
                return !is_null($value) && $value !== '';
            });

            $response = $this->apiService->getPosts($data);
            $posts = $response['result']['filtered_houses'];

            return view('home', ['posts' => $posts]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    public function feedBack()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }

        return view('feed_back');
    }
    public function sendFeedback(Request $request)
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        $data = [
            'message' => $request->message,
        ];
        $this->apiService->sendFeedback($data);
        return back()->with('status', 'Thank you for your feedback!');
    }


    public function getProfile()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {

            $response = $this->apiService->getProfile();

            return view('profile', ['profile' => $response['result']]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function updateProfile()
    {
    }
}
