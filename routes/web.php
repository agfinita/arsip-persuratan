<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\SuratDiarsipController;
use App\Http\Controllers\TentangPenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [HomeController::class, 'masuk'])->name('login')->middleware('guest');
Route::post('/prosesLogin', [HomeController::class, 'authenticate']);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [HomeController::class, 'hitungTotal']);

    Route::resource('/arsip-surat', SuratDiarsipController::class);
    Route::get('/arsip-surat/show/{id}', [SuratDiarsipController::class, 'show']);
    Route::get('/arsip-surat/edit/{id}', [SuratDiarsipController::class, 'edit']);
    Route::patch('/arsip-surat/edit/{id}', [SuratDiarsipController::class, 'update']);

    Route::resource('/arsip/kategori', KategoriSuratController::class)->except('show');
    Route::get('/arsip/kategori/edit/{id}', [KategoriSuratController::class, 'edit']);
    Route::patch('/arsip/kategori/edit/{id}', [KategoriSuratController::class, 'update']);

    Route::resource('/about', TentangPenggunaController::class)->except('create', 'store', 'show', 'edit', 'update', 'destroy');

});

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

