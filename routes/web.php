<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoComplete\ItemSearch;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReportPdf;
use App\Http\Controllers\ReportTransaction;
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

Route::get('/', [AuthController::class, 'index']); //halama index
Route::post('login', [AuthController::class, 'authenticate'])->name('login'); // url halaman logi
Route::get('logout', [AuthController::class, 'logout'])->name('logout'); // url logout
//url items => daftar barang
Route::resource('items', ItemController::class);
//url transactions untuk laporan transaksi => dashboard
Route::resource('transactions', TransactionController::class)->except('create', 'edit');
//url carts untuk input belanjaan => transaksi
Route::resource('carts', CartController::class);
//url register
Route::post('register', [AuthController::class, 'registerUser'])->name('register');

Route::get('report-transaction-pdf', ReportPdf::class)->name('pdf');
