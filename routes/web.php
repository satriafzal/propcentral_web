<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function (){
    return view('contact');
});

Route::get('/profile', function () {
    return view('profile');
});