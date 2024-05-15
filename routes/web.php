<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.register');
});


Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/otp', [RegistrationController::class, 'showOtpForm'])->name('otp');
Route::post('/otp', [RegistrationController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/password', [RegistrationController::class, 'showPasswordForm'])->name('password.show');
Route::post('/password', [RegistrationController::class, 'setPassword'])->name('password.set');
Route::get('/home', [HomeController::class, 'home'])->name('home');

















Route::get('/index', function () {
    return view('index');
})->name('index.view');

Route::get('/home02', function () {
    return view('home02');
})->name('home02.view');

Route::get('/home03', function () {
    return view('home03');
})->name('home03.view');

Route::get('/home04', function () {
    return view('home04');
})->name('home04.view');

Route::get('/home05', function () {
    return view('home05');
})->name('home05.view');

// Agency Views
Route::get('/agencies', function () {
    return view('agencies');
})->name('agencies.view');

Route::get('/agencies-detail', function () {
    return view('agencies-detail');
})->name('agencies-detail.view');

Route::get('/agencies-sidebar-v1', function () {
    return view('agencies-sidebar-v1');
})->name('agencies-sidebar-v1.view');

Route::get('/agencies-sidebar-v2', function () {
    return view('agencies-sidebar-v2');
})->name('agencies-sidebar-v2.view');

// Agent Views
Route::get('/agents', function () {
    return view('agents');
})->name('agents.view');

Route::get('/agents-detail', function () {
    return view('agents-detail');
})->name('agents-detail.view');

Route::get('/agents-sidebar-v1', function () {
    return view('agents-sidebar-v1');
})->name('agents-sidebar-v1.view');

Route::get('/agents-sidebar-v2', function () {
    return view('agents-sidebar-v2');
})->name('agents-sidebar-v2.view');

// Property Views
Route::get('/properties-grid', function () {
    return view('properties-grid');
})->name('properties-grid.view');

Route::get('/properties-list', function () {
    return view('properties-list');
})->name('properties-list.view');

Route::get('/properties-map-v1', function () {
    return view('properties-map-v1');
})->name('properties-map-v1.view');

Route::get('/properties-map-v2', function () {
    return view('properties-map-v2');
})->name('properties-map-v2.view');

Route::get('/properties-map-v3', function () {
    return view('properties-map-v3');
})->name('properties-map-v3.view');

Route::get('/property-detail-v1', function () {
    return view('property-detail-v1');
})->name('property-detail-v1.view');

Route::get('/property-detail-v2', function () {
    return view('property-detail-v2');
})->name('property-detail-v2.view');

Route::get('/property-detail-v3', function () {
    return view('property-detail-v3');
})->name('property-detail-v3.view');

// Properties Grid with Sidebar Views
Route::get('/properties-grid-sidebar-v1', function () {
    return view('properties-grid-sidebar-v1');
})->name('properties-grid-sidebar-v1.view');

Route::get('/properties-grid-sidebar-v2', function () {
    return view('properties-grid-sidebar-v2');
})->name('properties-grid-sidebar-v2.view');

// Properties List with Sidebar Views
Route::get('/properties-list-sidebar-v1', function () {
    return view('properties-list-sidebar-v1');
})->name('properties-list-sidebar-v1.view');

Route::get('/properties-list-sidebar-v2', function () {
    return view('properties-list-sidebar-v2');
})->name('properties-list-sidebar-v2.view');

// Dashboard Views
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.view');

Route::get('/dashboard-profile', function () {
    return view('dashboard-profile');
})->name('dashboard-profile.view');

Route::get('/dashboard-properties', function () {
    return view('dashboard-properties');
})->name('dashboard-properties.view');

Route::get('/dashboard-review', function () {
    return view('dashboard-review');
})->name('dashboard-review.view');

// Additional Views
Route::get('/blog', function () {
    return view('blog');
})->name('blog.view');

Route::get('/blog-grid', function () {
    return view('blog-grid');
})->name('blog-grid.view');

Route::get('/blog-detail', function () {
    return view('blog-detail');
})->name('blog-detail.view');

Route::get('/contact', function () {
    return view('contact');
})->name('contact.view');

Route::get('/faq', function () {
    return view('faq');
})->name('faq.view');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing.view');

Route::get('/error', function () {
    return view('error');
})->name('error.view');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.view');
