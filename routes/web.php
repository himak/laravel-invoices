<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default redirect and authentication routes
Route::redirect('/', '/login');
Auth::routes();

// Guest accessible routes can go here if needed

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'show')->name('profile.show');
        Route::post('/profile', 'update')->name('profile.update');
    });

    // Company-specific routes
    Route::middleware(['company'])->group(function () {
        Route::resources([
            'customers' => CustomerController::class,
            'items' => ItemController::class,
            'invoices' => InvoiceController::class,
        ]);

        Route::resource('invoices', InvoiceController::class)->except(['edit', 'update']);
    });
});
