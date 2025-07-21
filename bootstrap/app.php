<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function(Response $response, Throwable $exception, Request $request)
        : Response {
            $statusCode = $response->getStatusCode();
            if (!app()->isLocal()
                && \App\Services\HttpService::isFailedRequest($statusCode)
            ) {
                return Inertia::render('ErrorPage', ['status' => $statusCode])
                    ->toResponse($request)
                    ->setStatusCode($statusCode);
            }

            if ($statusCode === 419) {
                return back()->with(['message' => 'The page expired, please try again.']);
            }

            return $response;
        });
    })->create();
