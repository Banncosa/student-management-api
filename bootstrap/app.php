<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
<<<<<<< HEAD
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
=======
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
>>>>>>> 28861232f560eefee5273d4de51d29b3ce51be40
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
<<<<<<< HEAD
        //
=======
        $exceptions->shouldRenderJsonWhen(fn () => true);
>>>>>>> 28861232f560eefee5273d4de51d29b3ce51be40
    })->create();
