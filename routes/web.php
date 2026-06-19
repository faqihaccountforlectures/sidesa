<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::controller(AuthController::class)->group(function() {
    //register form 
    Route::get('/register', 'register')->name('auth.register');
    //store register
    Route::post('/store', 'store')->name('auth.store');
    //login form
    Route::get('/login', 'login')->name('auth.login');
    //auth proses
    Route::post('/auth', 'auth')->name('auth.authentication');
    //logout
    Route::post('/logout', 'logout')->name('auth.logout');
    //dashboard page
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});


Route::get('/', function () {
    return view('welcome');
});
