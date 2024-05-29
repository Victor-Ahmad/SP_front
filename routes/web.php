<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GooglePlacesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;




Route::post('/get-place-details', [GooglePlacesController::class, 'getPlaceDetails']);
Route::post('/get-place-details-by-coords', [GooglePlacesController::class, 'getPlaceDetailsByCoords']);

Route::middleware([Localization::class])->group(function () {
    Route::get('/privacy-policy', function () {
        $locale = Session::get('locale', 'en');
        if ($locale == 'nl') {
            return view('privacy-policy-nl');
        }
        return view('privacy-policy-en');
    })->name('privacy-policy');




    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'nl'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang.switch');




    Route::get('/', function () {
        if (Session::get('token')) {
            return redirect()->route('home');
        }
        return view('landing_page');
    })->name('landing_page');

    Route::get('/old_otp', function () {
        return view('Auth.otp');
    });
    Route::get('/old_register', function () {
        return view('Auth.register');
    });


    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
    Route::get('/login', [RegistrationController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [RegistrationController::class, 'login']);
    Route::get('/logout', [RegistrationController::class, 'logout'])->name('logout');
    Route::get('/otp', [RegistrationController::class, 'showOtpForm'])->name('otp');
    Route::post('/otp', [RegistrationController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('/password', [RegistrationController::class, 'showPasswordForm'])->name('password.show');
    Route::post('/password', [RegistrationController::class, 'setPassword'])->name('password.set');
    Route::get('/account_completion', [RegistrationController::class, 'account_completion'])->name('account_completion');
    Route::post('/account_completion', [RegistrationController::class, 'complete_account'])->name('complete_account');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/home/{id}', [HomeController::class, 'singlePost'])->name('singlePost');
    Route::get('/chats', [ChatController::class, 'chats'])->name('chats');
    Route::get('/chat/{id}', [ChatController::class, 'showChatMessages'])->name('chat.show');
    Route::get('/feed_back', [HomeController::class, 'feedBack'])->name('feed_back');
    Route::post('/send_feedback', [HomeController::class, 'sendFeedback'])->name('send_feedback');
    Route::get('/profile', [HomeController::class, 'getProfile'])->name('profile.get');
    Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');



    Route::get('/check_chat/{userId}', [ChatController::class, 'checkChat'])->name('checkChat');




    // web.php
    Route::get('/check-unread-messages', [ChatController::class, 'checkUnreadMessages'])->name('checkUnreadMessages');


    // Route::get('/index', function () {
    //     return view('index');
    // })->name('index.view');

    // Route::get('/home02', function () {
    //     return view('home02');
    // })->name('home02.view');

    // Route::get('/home03', function () {
    //     return view('home03');
    // })->name('home03.view');

    // Route::get('/home04', function () {
    //     return view('home04');
    // })->name('home04.view');

    // Route::get('/home05', function () {
    //     return view('home05');
    // })->name('home05.view');

    // // Agency Views
    // Route::get('/agencies', function () {
    //     return view('agencies');
    // })->name('agencies.view');

    // Route::get('/agencies-detail', function () {
    //     return view('agencies-detail');
    // })->name('agencies-detail.view');

    // Route::get('/agencies-sidebar-v1', function () {
    //     return view('agencies-sidebar-v1');
    // })->name('agencies-sidebar-v1.view');

    // Route::get('/agencies-sidebar-v2', function () {
    //     return view('agencies-sidebar-v2');
    // })->name('agencies-sidebar-v2.view');

    // // Agent Views
    // Route::get('/agents', function () {
    //     return view('agents');
    // })->name('agents.view');

    // Route::get('/agents-detail', function () {
    //     return view('agents-detail');
    // })->name('agents-detail.view');

    // Route::get('/agents-sidebar-v1', function () {
    //     return view('agents-sidebar-v1');
    // })->name('agents-sidebar-v1.view');

    // Route::get('/agents-sidebar-v2', function () {
    //     return view('agents-sidebar-v2');
    // })->name('agents-sidebar-v2.view');

    // // Property Views
    // Route::get('/properties-grid', function () {
    //     return view('properties-grid');
    // })->name('properties-grid.view');

    // Route::get('/properties-list', function () {
    //     return view('properties-list');
    // })->name('properties-list.view');

    // Route::get('/properties-map-v1', function () {
    //     return view('properties-map-v1');
    // })->name('properties-map-v1.view');

    // Route::get('/properties-map-v2', function () {
    //     return view('properties-map-v2');
    // })->name('properties-map-v2.view');

    // Route::get('/properties-map-v3', function () {
    //     return view('properties-map-v3');
    // })->name('properties-map-v3.view');

    // Route::get('/property-detail-v1', function () {
    //     return view('property-detail-v1');
    // })->name('property-detail-v1.view');

    // Route::get('/property-detail-v2', function () {
    //     return view('property-detail-v2');
    // })->name('property-detail-v2.view');

    // Route::get('/property-detail-v3', function () {
    //     return view('property-detail-v3');
    // })->name('property-detail-v3.view');

    // // Properties Grid with Sidebar Views
    // Route::get('/properties-grid-sidebar-v1', function () {
    //     return view('properties-grid-sidebar-v1');
    // })->name('properties-grid-sidebar-v1.view');

    // Route::get('/properties-grid-sidebar-v2', function () {
    //     return view('properties-grid-sidebar-v2');
    // })->name('properties-grid-sidebar-v2.view');

    // // Properties List with Sidebar Views
    // Route::get('/properties-list-sidebar-v1', function () {
    //     return view('properties-list-sidebar-v1');
    // })->name('properties-list-sidebar-v1.view');

    // Route::get('/properties-list-sidebar-v2', function () {
    //     return view('properties-list-sidebar-v2');
    // })->name('properties-list-sidebar-v2.view');

    // // Dashboard Views
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard.view');

    // Route::get('/dashboard-profile', function () {
    //     return view('dashboard-profile');
    // })->name('dashboard-profile.view');

    // Route::get('/dashboard-properties', function () {
    //     return view('dashboard-properties');
    // })->name('dashboard-properties.view');

    // Route::get('/dashboard-review', function () {
    //     return view('dashboard-review');
    // })->name('dashboard-review.view');

    // // Additional Views
    // Route::get('/blog', function () {
    //     return view('blog');
    // })->name('blog.view');

    // Route::get('/blog-grid', function () {
    //     return view('blog-grid');
    // })->name('blog-grid.view');

    // Route::get('/blog-detail', function () {
    //     return view('blog-detail');
    // })->name('blog-detail.view');

    // Route::get('/contact', function () {
    //     return view('contact');
    // })->name('contact.view');

    // Route::get('/faq', function () {
    //     return view('faq');
    // })->name('faq.view');

    // Route::get('/pricing', function () {
    //     return view('pricing');
    // })->name('pricing.view');

    // Route::get('/error', function () {
    //     return view('error');
    // })->name('error.view');

    // Route::get('/welcome', function () {
    //     return view('welcome');
    // })->name('welcome.view');
});
