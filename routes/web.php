<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\GalleryController;

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

Route::get('/', function () {
    return view('home/index');
});

Route::get('/home', function () {
    return view('home/index');
})->name('home');
// Route::get('/page', function () {
//     return view('page');
// })->name('page');
// Route::get('/pesan', function () {
//     return view('pesan');
// })->name('pesan');
// Route::get('/gallery', function () {
//     return view('gallery');
// })->name('gallery');

Route::get('/page', [PageController::class, 'index'])->name('page');
Route::get('/pesan', [PesanController::class, 'index'])->name('pesan');
Route::post('/pesans', [PesanController::class, 'store'])->name('pesans');
Route::get('/tampil', [PesanController::class, 'tampil'])->name('tampil');
// Route::resource('/allpesan', [PesanController::class]);
Route::resource('pegawaiAjax', PageController::class);
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');



