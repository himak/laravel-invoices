<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public authentication routes
Route::name('api.')->group(function () {
    Route::post('auth/register', RegisterController::class)->name('register');
    Route::post('auth/login', LoginController::class)->name('login');
});

// Protected routes
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    // User information
    Route::get('/user', fn (Request $request) => UserResource::make($request->user()));

    // Authentication management
    Route::prefix('auth')->group(function () {
        Route::put('password', PasswordUpdateController::class)->name('password.update');
        Route::post('logout', LogoutController::class)->name('logout');
    });

    // Profile management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'show')->name('profile.show');
        Route::put('/profile', 'update')->name('profile.update');
    });

    // API Resources
    Route::apiResources([
        'items' => ItemController::class,
        'customers' => CustomerController::class,
    ]);

    Route::apiResource('invoices', InvoiceController::class)
        ->except('update')
        ->names('invoices');
});
