<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (\Illuminate\Http\Request $request) {
            session()->flash('error', 'Harap login untuk akses halaman lebih lanjut!');

            session()->flash('auto_open_login', true);

            return url('/');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
