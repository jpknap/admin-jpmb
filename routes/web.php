<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

// routes/web.php, api.php or any other central route files you have

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->middleware('auth')->group(function () {

        Route::get('/', function () {
            return view('welcome');
        });
    });
}

Route::get('/login_', function () {
    return redirect('/login');
})->name('login');

