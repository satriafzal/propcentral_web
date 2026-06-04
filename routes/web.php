<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssistantController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/verify-email', function () {
    return view('auth.verify-email');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

Route::get('/panduan', function () {
    return view('panduan');
});

Route::get('/saved', function () {
    return view('saved');
});

Route::get('/seller-profile', function () {
    return view('seller-profile');
});

Route::get('/property-detail', function () {
    return view('property-detail');
});

// routes for authentication
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

// for ai assistant
Route::post('/assistant/chat', [AssistantController::class, 'chat'])->name('assistant.chat');

// for acces role permissions
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

    // for update profile photo user
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
});