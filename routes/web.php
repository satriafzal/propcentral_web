<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/panduan', function () {
    return view('panduan');
});

Route::get('/saved', function () {
    return view('saved');
});

// routes for authentication
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/verify-email', function () {
    return view('auth.verify-email');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

// acces role permissions
Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('profile');
    });

    Route::get('/property', function () {
        return view('property');
    });

    Route::get('/jual', function () {
        return view('jual');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // for update profile user
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});