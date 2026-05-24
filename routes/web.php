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

Route::get('/panduan', function () {
    return view('panduan');
});

Route::get('/property', function () {
    return view('property');
});