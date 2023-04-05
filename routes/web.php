<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
    return view('auth/welcome');
});

// Dibuat middleware group untuk memperingkas
Route::middleware('akses_guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

// Dibuat middleware group untuk memperingkas
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['akses_admin']);
    Route::resource('/categories', CategoryController::class)->middleware('akses_admin');

    Route::get('/profile', [UserController::class, 'profile'])->middleware(['akses_client']);
});

// Route Guest
Route::middleware('akses_guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

//route book
Route::resource('/books', BookController::class)->middleware('akses_admin');

// Route Client untuk mengakses list buku
Route::get('/list-books', [ClientController::class, 'index'])->name('client.list');

// Route Client untuk mengakses detail buku
Route::get('/detail-book/{id}', [ClientController::class, 'detailBook'])->name('client.detail-book');











