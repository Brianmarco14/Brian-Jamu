<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\ForuserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [App\Http\Controllers\LandingController::class, 'show']);


//halaman yang bisa diakses hanya admin
Route::middleware(['auth', 'admin'])->group(function () {   
    Route::resource('user', ForuserController::class);
});


//halaman yang diakses admin dan editor
Route::middleware(['auth', 'editor'])->group(function () {  
    Route::resource('post', PostController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});

Route::resource('dasboard', DasboardController::class);
Route::resource('/', LandingController::class);