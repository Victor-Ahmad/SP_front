<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                Session::put('user_id', $response['result']['id']);
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

                ]);
            } else {
                // Handle API call failures
                return back()->withErrors(['message' => 'Failed to fetch data from API.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        Session::forget('user_id');
        return redirect()->route('landing_page')->with('status', 'You have been logged out successfully.');
    }
}
//    error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());