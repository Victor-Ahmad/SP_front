<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\error;

class RegistrationController extends Controller
{

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showRegistrationForm()
    {
        return view('Auth.sign_up');
        // return view('Auth.register');
    }

    public function register(Request $request)
    {
        // Validate and save user data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'number' => $request->phone_number,
        ];

        try {
            $response = $this->apiService->signUp($data);

            if ($response['success'] == 1) {
                // if ($response['result']['id']) {
                //     Session::put('user_id', $response['result']['id']);
                // }

                if ($response['result']['user']) {
                    Session::put('user', $response['result']['user']);
                    Session::put('user_id', $response['result']['user']['id']);
                }
                if ($response['result']['token']) {
                    Session::put('token', $response['result']['token']);
                    return redirect()->route('password.show');
                }

                return redirect()->route('otp');
            } else {
                $messages = [];
                if (is_array($response['message'])) {
                    foreach ($response['message'] as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $messages[] = $error;
                        }
                    }
                } else {
                    $messages[] = $response['message'];
                }
                return back()->withErrors($messages);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function showLoginForm()
    {
        return view('Auth.sign_in');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|max:15',
        ]);

        $data = [
            'password' => $request->password,
            'number' => $request->phone_number,
        ];

        try {
            $response = $this->apiService->login($data);
            if ($response['success'] == 1) {
                Session::put('user', $response['result']['user']);
                Session::put('token', $response['result']['token']);
                if ($response['result']['user']['swap_type_id'])
                    return redirect()->route('home');
                else
                    return redirect()->route('account_completion')->with('success', '');
            } else {
                $messages = [];
                if (is_array($response['message'])) {
                    foreach ($response['message'] as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $messages[] = $error;
                        }
                    }
                } else {
                    $messages[] = $response['message'];
                }
                return back()->withErrors($messages);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function showOtpForm()
    {
        return view('Auth.verify_otp');
        // return view('Auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6',
        ]);

        $otpCode = $request->input('otp_code');
        $userId = Session::get('user_id');

        if (!$userId) {
            return back()->withErrors(['otp_code' => 'User ID not found in session. Please try again.']);
        }

        $data = [
            'id' => $userId,
            'code' => $otpCode,
        ];

        try {
            $response = $this->apiService->verifyOtp($data);

            if ($response['success'] == 1) {
                Session::put('user', $response['result']['user']);
                Session::put('token', $response['result']['token']);
                return redirect()->route('password.show');
            } else {
                return back()->withErrors(['otp_code' => $response['message']]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['otp_code' => $e->getMessage()]);
        }
    }
    public function showPasswordForm()
    {
        return view('Auth.set_password');
        // return view('Auth.password');
    }
    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $password = $request->input('password');
        $userId = Session::get('user_id');

        if (!$userId) {
            return back()->withErrors(['password' => 'User ID not found in session. Please try again.']);
        }

        $data = [
            'id' => $userId,
            'password' => $password,
        ];

        try {
            $response = $this->apiService->setPassword($data);

            if ($response['success'] == 1) {
                return redirect()->route('account_completion')->with('success', 'Password set successfully!');
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['password' => $e->getMessage()]);
        }
    }
    public function account_completion()
    {
        if ((Session::get('user')['swap_type_id'] ?? false)) {
            return redirect()->route('home')->with('success', '');
        }
        // return view(
        //     'account_completion',
        //     [
        //         'swapTypes' => [],
        //         'houseTypes' => [
        //             ["id" => 1, "type" => "Appartment"],
        //             ["id" => 2, "type" => "Town House"],
        //             ["id" => 3, "type" => "2 floors house"],
        //         ],
        //         'numberOfRooms' => [
        //             ["id" => 1, "number" => "1"],
        //             ["id" => 2, "number" => "2"],
        //             ["id" => 3, "number" => "3"],
        //             ["id" => 4, "number" => "4"],
        //             ["id" => 5, "number" => "5"],
        //             ["id" => 6, "number" => "6"],
        //         ]
        //     ],

        // );
        try {
            // Make multiple API calls
            $response1 = $this->apiService->getSwapTypes();
            $response2 = $this->apiService->getHouseTypes();
            // Check if the responses are successful
            if ($response1['success'] == 1 && $response2['success'] == 1) {
                // Pass the data to the view
                return view('account_completion', [
                    'swapTypes' => $response1['result'],
                    'houseTypes' => $response2['result'],
                    'numberOfRooms' => [
                        ["id" => 1, "number" => "1"],
                        ["id" => 2, "number" => "2"],
                        ["id" => 3, "number" => "3"],
                        ["id" => 4, "number" => "4"],
                        ["id" => 5, "number" => "5"],
                        ["id" => 6, "number" => "6"],
                    ]

                ]);
            } else {
                // Handle API call failures
                return back()->withErrors(['message' => 'Failed to fetch data from API.']);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        Session::forget('user_id');
        Session::forget('user');
        Session::forget('token');
        return redirect()->route('landing_page')->with('status', 'You have been logged out successfully.');
    }

    public function complete_account(Request $request)
    {

        $request->validate([
            'house_type' => 'required',
            'number_of_rooms' => 'required',
            'price' => 'required|numeric',
            'area' => 'numeric',
            'location_name' => 'required|string',
            'house_number' => 'required|string',
            'post_code' => 'required|string',
            'street' => 'string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'gallery.*' => 'nullable|file|mimes:jpg,jpeg,png,bmp|max:2048',
        ]);

        $data = [
            'swap_type_id' => 1,
            'house_type_id' => $request->house_type,
            'location' => $request->location_name,
            'post_code' => $request->post_code,
            'street' => $request->street,
            'house_number' => $request->house_number,
            'latitude' => $request->latitude ?? '0',
            'longitude' => $request->longitude ?? '0',
            'number_of_rooms' => $request->number_of_rooms,
            'price' => $request->price,
            'area' => $request->area ?? '',
            'street_view' => $request->street_view == 'on' ? 1 : 0,
            'interests' => $request->location_names ?? '',
        ];


        $files = $request->file('gallery');

        try {
            $response = $this->apiService->completeAccount($data, $files);
            if ($response['success'] == 1) {

                Session::forget('user');
                Session::put('user', $response['result'][0]['user']);
                return redirect()->route('home')->with('success', 'Added Successfully');
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return response()->json($response);
    }
}
//    error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());