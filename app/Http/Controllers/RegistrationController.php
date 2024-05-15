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
        return view('auth.register');
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
        return view('auth.otp');
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
        return view('auth.password');
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
                return redirect()->route('home')->with('success', 'Password set successfully!');
            } else {
                return back()->withErrors(['password' => $response['message']]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['password' => $e->getMessage()]);
        }
    }
}
//    error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());