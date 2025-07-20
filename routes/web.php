<?php

use App\Http\Controllers\LedgerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
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
    Route::get('/', function() {
        return Inertia::render('Home');
    });

    Route::get('/home', function () {
        return Inertia::render('Home');
    })->name('home');

    Route::resource('ledgers', LedgerController::class);

    Route::get('/statistics', function() {
        return Inertia::render('Statistics');
    })
    ->name('statistics.index');
});
