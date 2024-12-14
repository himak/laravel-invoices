<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes();

Route::middleware(['auth', 'company'])->group(function () {
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('items', App\Http\Controllers\ItemController::class);
    Route::resource('invoices', App\Http\Controllers\InvoiceController::class)
        ->except(['edit', 'update']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
