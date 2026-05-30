<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

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

Route::get('/jual', function () {
    return view('jual');
});

Route::get('/property', function () {
    return view('property');
});

Route::get('/saved', function () {
    return view('saved');
});

// routes for authentication
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');