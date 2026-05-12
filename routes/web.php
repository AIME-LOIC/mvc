<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\HardwareCategoryController;
use App\Http\Controllers\HardwareItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'staff'])
    ->prefix('hardware')
    ->name('hardware.')
    ->group(function () {
        Route::get('/', [HardwareController::class, 'index'])->name('dashboard');

        Route::resource('categories', HardwareCategoryController::class)
            ->parameters(['categories' => 'category'])
            ->names('categories')
            ->except(['show']);

        Route::resource('items', HardwareItemController::class)
            ->parameters(['items' => 'item'])
            ->names('items')
            ->except(['show']);

        Route::get('{category}/{item_id?}', [HardwareController::class, 'show'])
            ->where([
                'category' => '[A-Za-z0-9\-]+',
                'item_id' => '[0-9]+',
            ])
            ->name('show');
    });
