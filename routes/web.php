<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'show'])->name('company.show');
Route::post('/company', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');

Route::resource('customers', App\Http\Controllers\CustomerController::class);
Route::resource('items', App\Http\Controllers\ItemController::class);
Route::resource('invoices', App\Http\Controllers\InvoiceController::class)->except('update');

Route::get('/invoices/{invoice}/print', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoice.print');
