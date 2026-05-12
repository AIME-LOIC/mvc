<?php

use App\Http\Controllers\HardwareController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')
    ->prefix('hardware')
    ->name('hardware.')
    ->group(function () {
        Route::get('/', [HardwareController::class, 'index'])->name('dashboard');

        Route::get('{category}/{item_id?}', [HardwareController::class, 'show'])
            ->where([
                'category' => '[A-Za-z0-9\-]+',
                'item_id' => '[0-9]+',
            ])
            ->name('show');
    });
