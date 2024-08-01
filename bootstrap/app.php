<?php

use App\Http\Middleware\userType;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\TrustHosts;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
                "admin" => userType::class
            ]
            );
        $middleware->web([
            RealRashid\SweetAlert\ToSweetAlert::class,
        ]);
        $middleware->trustHosts([
            "http://localhost:8000"
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
