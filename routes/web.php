<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoComplete\ItemSearch;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
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

Route::get('home', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('search-items', ItemSearch::class)->name('items.search');
Route::get('tes', function () {
    return view('tes');
});
Route::resource('items', ItemController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('carts', CartController::class);
