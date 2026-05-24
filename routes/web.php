<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/register', function () {
    return view('auth.register');
});