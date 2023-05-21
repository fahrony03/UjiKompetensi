<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/baca/{id}', [WelcomeController::class, 'show'])->name('read-article');
Route::post('/kirim-komentar', [WelcomeController::class, 'storeKomentar'])->name('store_komentar');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'storeLoginPenulis'])->name('login_store_penulis');
Route::get('/login-admin', [AuthController::class, 'indexAdmin'])->name('login_admin');
Route::post('/login-admin', [AuthController::class, 'storeLoginAdmin'])->name('login_store_admin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegisterPenulis'])->name('register_store_penulis');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/artikel', ArtikelController::class);
Route::get('/komentar', [KomentarController::class, 'index'])->name('komentar.index');
Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis.index');
Route::put('/penulis/{id}', [PenulisController::class, 'update'])->name('penulis.update');