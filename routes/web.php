<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriSuratController;
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

Route::group([], function () {

    Route::get('/page/login', function () {
        return view('views.login');
    });

    Route::get('/', [HomeController::class, 'hitungTotal']);

    Route::resource('/arsip-surat', ArsipSuratController::class);

    Route::resource('/arsip/kategori', KategoriSuratController::class)->except('show');
    Route::get('/arsip/kategori/edit/{id}', [KategoriSuratController::class, 'edit']);
    Route::patch('/arsip/kategori/edit/{id}', [KategoriSuratController::class, 'update']);

    Route::resource('/about', TentangPenggunaController::class)->except('create', 'store', 'show', 'edit', 'update', 'destroy');

});

