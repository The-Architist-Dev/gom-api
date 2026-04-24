<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Custom CORS middleware must run first to handle OPTIONS preflight
        $middleware->prepend(\App\Http\Middleware\CorsMiddleware::class);
        $middleware->append(\App\Http\Middleware\AddCOOPHeader::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
