<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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
            return redirect()->route('landing_page');
        } else {
            error_log(Session::get('token'));
        }
        if (!(Session::get('user')['swap_type_id'] ?? false)) {
            return redirect()->route('account_completion')->with('success', '');
        }
        try {
            $data = [
                'price_min' => request()->min_value,
                'price_max' => request()->max_value,
                'number_of_rooms' => request()->rooms != 'any' ? request()->rooms : null,
                'location' => request()->location,
            ];

            $data = array_filter($data, function ($value) {
                return !is_null($value) && $value !== '';
            });

            $response = $this->apiService->getPosts($data);
            $posts = $response['result']['filtered_houses'];
            $first_posts = [];
            $last_posts = [];
            $my_interest = Session::get('my_location') ?? '';

            foreach ($posts as  $post) {
                $in_interest = false;
                foreach ($post['user']['intersts'] as $interest) {
                    if (Str::contains($interest['interest'], $my_interest)) {
                        $in_interest = true;
                    }
                }
                if ($in_interest) {
                    $first_posts[] = $post;
                } else {
                    $last_posts[] = $post;
                }
            }
            $posts = array_merge($first_posts, $last_posts);

            // return  $posts[1]['user']['intersts'][0]['interest'];
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
            if (!$response['result']['one_to_one_swap_house']) {
                return redirect()->route('account_completion');
            }
            return view('profile', ['profile' => $response['result']]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function updateProfile(Request $request)
    {

        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }

        try {
            $data = [
                'interests' => $request->interests,
                'delete_images' => $request->delete_images,
                'delete_interests' => $request->delete_interests,
                'location' => $request->location,
                'post_code' => $request->post_code,
                'street' => $request->street,
                'house_number' => $request->house_number,
                'number_of_rooms' => $request->number_of_rooms,
            ];

            $data = array_filter($data, function ($value) {
                return !is_null($value) && $value !== '';
            });
            $files = $request->file('images');


            $response = $this->apiService->updateProfile($data, $files);
            if ($response['success'] == 1) {
                return redirect()->route('profile.get');
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function deleteAccount()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {
            $response = $this->apiService->deleteAccount();

            // return $response;
            if ($response['success'] == 1) {
                Session::forget('user_id');
                Session::forget('user');
                Session::forget('token');
                return response()->json([
                    'success' => true,
                    'redirect' => route('landing_page')
                ]);
            }
            return view('profile', ['profile' => $response['result']]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }


    public function getPost($id)
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {
            $response = $this->apiService->getPost($id);


            if ($response['success'] == 1) {
                $post = $response['result']['house'];
                $post['intersts'] = $response['result']['house_owner']['intersts'];
                $post['owner_name'] = $response['result']['house_owner']['first_name'] . ' ' . $response['result']['house_owner']['last_name'];

                return view('single_post', compact('post'));
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
