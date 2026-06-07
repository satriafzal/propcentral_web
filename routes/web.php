<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Offercontroller;

Route::get('/', [HomeController::class, 'index']);

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

Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');

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

    Route::get('/property', [PropertyController::class, 'index'])->name('property.index');
    Route::post('/property', [PropertyController::class, 'store'])->name('property.store');

    Route::get('/jual', function () {
        return view('jual');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    // for crud penawaran saya
    Route::get('/penawaran-saya', [PropertyController::class, 'myOffers'])->name('penawaran-saya');
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // for update profile user
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // for update profile photo user
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

    // Chat routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{user}/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');

    // Fitur Penawaran
    Route::post('/offers', [Offercontroller::class, 'store'])->name('offers.store');
    Route::get('/penawaran-masuk', [Offercontroller::class, 'incomingOffers'])->name('offers.incoming');
    Route::get('/penawaran-diajukan', [Offercontroller::class, 'myOffers'])->name('offers.mine');
    Route::post('/offers/{id}/respond', [Offercontroller::class, 'respond'])->name('offers.respond');

    // Open Profile & Ulasan
    Route::get('/user/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/user/{id}/reviews', [ProfileController::class, 'storeReview'])->name('profile.reviews.store');

});