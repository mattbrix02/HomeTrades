<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        //CSRF Token error fix Master Laravel 11 and Vue 3 - Build SPA Application - Lesson 85

        $middleware->validateCsrfTokens(except: [
            '/logout'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
