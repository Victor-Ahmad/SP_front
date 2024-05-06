<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/indexView', function () {
    return view('index');
})->name('index.view');
