<?php


use App\Http\Middleware\CheckRole;
use App\Http\Middleware\LayoutConfigGuest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
                "role" => CheckRole::class,
                "layout-guest" => LayoutConfigGuest::class,
            ]
            );
        $middleware->web([
            RealRashid\SweetAlert\ToSweetAlert::class,
        ]);
//        $middleware->trustHosts([
//            "http://localhost:8000"
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
