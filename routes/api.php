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
Route::post('auth/register', RegisterController::class)->name('api.register');
Route::post('auth/login', LoginController::class)->name('api.login');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', static function (Request $request) {
        return UserResource::make($request->user());
    });

    Route::put('auth/password', PasswordUpdateController::class)->name('api.password.update');
    Route::post('auth/logout', LogoutController::class)->name('api.logout');

    Route::get('/profile', [ProfileController::class, 'show'])->name('api.profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('api.profile.update');

    Route::apiResource('/items', ItemController::class)->names('api.items');
    Route::apiResource('/customers', CustomerController::class)->names('api.customers');
    Route::apiResource('/invoices', InvoiceController::class)->except('update')->names('api.invoices');
});
