<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $response = $this->apiService->getPosts();
            $posts = $response['result']['all_houses'];
            return view('home', ['posts' => $posts]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
