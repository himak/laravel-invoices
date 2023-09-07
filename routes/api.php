<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ItemController;
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

Route::post('auth/register', RegisterController::class);
Route::post('auth/login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::put('auth/password', PasswordUpdateController::class);
    Route::post('auth/logout', LogoutController::class);

    Route::get('/company', [CompanyController::class, 'show']);
    Route::put('/company', [CompanyController::class, 'update']);

    Route::apiResource('/items', ItemController::class)->names('api.items');
});
