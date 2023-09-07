<?php

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

Route::post('auth/register', \App\Http\Controllers\Api\Auth\RegisterController::class);
Route::post('auth/login', \App\Http\Controllers\Api\Auth\LoginController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/company', function (Request $request) {
        return $request->user()->only('name', 'email', 'business_name', 'identification_code');
    });
});
