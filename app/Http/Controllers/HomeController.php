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

    function landing()
    {
        if (Session::get('token')) {
            return redirect()->route('home');
        }
        $response = $this->apiService->getLandingPosts();
        $posts = $response['result'];
        $posts = array_slice($posts, 0, 8);
        return view('landing_page', ['posts' => $posts]);
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
                if (isset($post['user']['intersts']) && !empty($post['user']['intersts'])) {
                    foreach ($post['user']['intersts'] as $interest) {
                        if (Str::contains($interest['interest'], $my_interest)) {
                            $in_interest = true;
                        }
                    }
                }

                if ($in_interest) {
                    $first_posts[] = $post;
                } else {
                    $last_posts[] = $post;
                }
            }
            $posts = array_merge($first_posts, $last_posts);
            $progress =    $this->apiService->getProfileProgress()['result'];
            $showAll = $response['result']['has_more_than_two_images'];
            Session::put('showAll', $showAll);
            return view('home', ['posts' => $posts, 'progress' => $progress, 'showAll' => $showAll]);
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
            // return $response;
            $houseTypes = $this->apiService->getHouseTypes()['result'];
            $features = $this->apiService->getHouseProperties()['result'];
            return view('profile', [
                'profile' => $response['result'],
                'houseTypes' => $houseTypes,
                'features' => $features,
                'numberOfRooms' => [
                    ["id" => 1, "number" => "1"],
                    ["id" => 2, "number" => "2"],
                    ["id" => 3, "number" => "3"],
                    ["id" => 4, "number" => "4"],
                    ["id" => 5, "number" => "5"],
                    ["id" => 6, "number" => "6"],
                ],
                'areas' => [
                    '40',
                    '45',
                    '50',
                    '55',
                    '60',
                    '65',
                    '70',
                    '75',
                    '80',
                    '85',
                    '90',
                    '95',
                    '100',
                    '105',
                    '110',
                    '115',
                    '120',
                ],
            ]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function updateProfile(Request $request)
    {
        // return $request;
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        // return $request->all();
        try {
            $profileInfo = $this->apiService->getProfile()['result'];
            $deleted_images = $request->delete_images ? explode(",", $request->delete_images) : null;
            $data = [

                'first_name' => $profileInfo['first_name'],
                'last_name' => $profileInfo['last_name'],
                'email' => $profileInfo['email'],
                'number' => $profileInfo['number'],
                'agreed_privacy_policy' => (string)$profileInfo['agreed_to_privacy_policy'],
                'agreed_terms_of_use' => (string)$profileInfo['agreed_to_terms_of_use'],
                'wish' => [
                    'house_type_id' => $request->wish_house_type[0],
                    'number_of_rooms' => $request->wish_number_of_rooms,
                    'price' => $request->wish_price,
                    'area' => $request->area_wish,
                    'locations' => isset($request->interests) && $request->interests != null ? explode(',', $request->interests) : [],
                    // 'property_ids' => isset($request->features_wish) && !empty($request->features_wish) ? explode(',', substr($request->features_wish, 1)) : null,
                ],
                'house' => [
                    'house_number' => $profileInfo['one_to_one_swap_house']['house_number'],
                    'post_code' => $profileInfo['one_to_one_swap_house']['post_code'],
                    'location' => $profileInfo['one_to_one_swap_house']['location'],
                    'street' => $profileInfo['one_to_one_swap_house']['street'],
                    'number_of_rooms' => $request->number_of_rooms,
                    'price' => $request->price,
                    'area' => $profileInfo['one_to_one_swap_house']['area'],
                    'description' => $request->description,
                    'property_ids' => isset($request->features) && !empty($request->features) ? explode(', ', $request->features) : null,
                    'house_type_id' => (string)$profileInfo['one_to_one_swap_house']['house_type_id'],
                    'delete_images' => $deleted_images,
                ]
            ];
            // return isset($request->features) && !empty($request->features) ? explode(', ', $request->features) : null;

            // $data = [
            //     'interests' => $request->interests,
            //     'delete_images' => $request->delete_images,
            //     'delete_interests' => $request->delete_interests,
            //     'location' => $request->location,
            //     'post_code' => $request->post_code,
            //     'street' => $request->street,
            //     'house_number' => $request->house_number,
            //     'number_of_rooms' => $request->number_of_rooms,
            //     'description' => $request->description,
            //     // 'specific_properties' => '',
            // ];

            // $data = array_filter($data, function ($value) {
            //     return !is_null($value) && $value !== '';
            // });
            $files = $request->file('images');
            // return $data;
            // dd($request->all(), $data);
            $response = $this->apiService->updateProfile($data, $files);

            if ($response['success'] == 1) {
                return redirect()->route('profile.get');
            } else {
                return back()->withErrors(['message' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function getCompeleteProfile($type)
    {

        //type=1 description
        //type=2 images
        //type=3 both
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
            // $houseTypes = $this->apiService->getHouseTypes()['result'];
            // $features = $this->apiService->getHouseProperties()['result'];
            $show_images = false;
            $show_description = false;
            if ($type == 1) {
                $show_description = true;
            } elseif ($type == 2) {
                $show_images = true;
            } elseif ($type == 3) {
                $show_description = true;
                $show_images = true;
            } else {
                $show_description = false;
                $show_images = false;
            }
            return view('profile_compeletion', ['profile' => $response['result'], 'show_images' => $show_images, 'show_description' => $show_description]);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    public function compeleteProfile(Request $request)
    {
        // return $request;
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {
            $data = [];
            if ($request->house_description) {
                $data = [
                    'description' => $request->house_description,
                ];
            }

            $files = $request->file('gallery');
            $response = $this->apiService->compeleteProfile($data, $files);

            if ($response['success'] == 1) {
                return redirect()->route('home');
            } else {
                return back()->withErrors(['message' => $response['message']]);
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
                $post['showAll'] = Session::get('showAll') ?? 'false';
                $post['progress'] =   $this->apiService->getProfileProgress()['result'];
                return view('single_post', compact('post'));
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }


    public function progress()
    {
        if (!Session::get('token')) {
            return redirect()->route('login');
        } else {
            error_log(Session::get('token'));
        }
        try {
            $response = $this->apiService->getProfileProgress();
            return  $response;

            if ($response['success'] == 1) {
                return view('single_post');
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}



 //    $data = [
            //                 'delete_images' => $request->delete_images,
            //                 'first_name' => $profileInfo['first_name'],
            //                 'last_name' => $profileInfo['last_name'],
            //                 'email' => $profileInfo['email'],
            //                 'number' => $profileInfo['number'],
            //                 'agreed_privacy_policy' => (string)$profileInfo['agreed_to_privacy_policy'],
            //                 'agreed_terms_of_use' => (string)$profileInfo['agreed_to_terms_of_use'],
            //                 'wish' => [
            //                     'house_type_id' => (string)$profileInfo['wishes'][0]['house_type_id'],
            //                     'number_of_rooms' => (string)$profileInfo['wishes'][0]['number_of_rooms'],
            //                     'price' => $profileInfo['wishes'][0]['price'],
            //                     'area' => $profileInfo['wishes'][0]['area'],
            //                     'locations' => array_map(function ($location) {
            //                         return $location['location'];
            //                     }, $profileInfo['wishes'][0]['wish_locations']),
            //                     'property_ids' => array_filter(array_map(function ($property) {
            //                         return $property['specific_property'] ? (string)$property['specific_property']['id'] : null;
            //                     }, $profileInfo['wishes'][0]['specific_properties']))
            //                 ],
            //                 'house' => [
            //                     'house_number' => $profileInfo['one_to_one_swap_house']['house_number'],
            //                     'post_code' => $profileInfo['one_to_one_swap_house']['post_code'],
            //                     'location' => $profileInfo['one_to_one_swap_house']['location'],
            //                     'street' => $profileInfo['one_to_one_swap_house']['street'],
            //                     'number_of_rooms' => (string)$profileInfo['one_to_one_swap_house']['number_of_rooms'],
            //                     'price' => $profileInfo['one_to_one_swap_house']['price'],
            //                     'area' => $profileInfo['one_to_one_swap_house']['area'],
            //                     'description' => $profileInfo['one_to_one_swap_house']['description'],
            //                     'property_ids' => array_filter(array_map(function ($property) {
            //                         return $property['specific_property'] ? (string)$property['specific_property']['id'] : null;
            //                     }, $profileInfo['one_to_one_swap_house']['specific_properties'])),
            //                     'house_type_id' => (string)$profileInfo['one_to_one_swap_house']['house_type_id']
            //                 ]
            //             ];