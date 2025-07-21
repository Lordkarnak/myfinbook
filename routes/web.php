<?php

use App\Http\Controllers\LedgerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (): \Inertia\Response {
    return Inertia::render('MainMenu', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function(): \Illuminate\Http\RedirectResponse {
        return redirect('home', \App\Services\HttpService::HTTP_RESPONSE_FOUND);
    });

    Route::get('/home', function (): \Inertia\Response {
        return Inertia::render('Home');
    })->name('home');

    Route::resource('ledgers', LedgerController::class);

    Route::get('/statistics', function(): \Inertia\Response {
        return Inertia::render('Statistics');
    })
    ->name('statistics.index');
});
