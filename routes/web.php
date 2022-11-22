<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;

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

Auth::routes();

// Auth::routes([
//     'register' => false,
//     'reset' => false,
// ]);

// Route::get('/', function () {
//     return view('index');
// });

// route untuk menampilkan data atau halaman index.blade
Route::get('/buku', [BukuController::class, 'index']);

// Route::get('/', [BukuController::class, 'index']);

// route untuk menambahkan data buku
Route::get('/buku/create', [BukuController::class, 'create'])->name('create');
Route::post('/buku', [BukuController::class, 'store'])->name('store');

// route untuk menghapus data buku
Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('destroy');

// route untuk mengedit data buku
Route::get('/buku/update/{id}', [BukuController::class, 'show'])->name('show');
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('update');

// route untuk mencari data buku
Route::get('/buku/search', [BukuController::class, 'search'])->name('search');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [BukuController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index']);

// route untuk tabel galeri
Route::get('/galeri', [GaleriController::class, 'index']);
Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
Route::get('/galeri/edit/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
Route::post('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::post('/galeri/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

// Sementara untuk SEO
Route::get('/list-buku', function () {
    return view('list-buku');
});

Route::get('/detail-buku/{bukuSeo}', [BukuController::class, 'galbuku'])->name('galbuku');