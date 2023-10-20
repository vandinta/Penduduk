<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\LaporanController;

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
Route::get('/', function () {return view('home');})->name('home');

Route::get('/provinsi/search', [ProvinsiController::class, 'search'])->name('provsearch');
Route::get('/kabupaten/search', [KabupatenController::class, 'search'])->name('kabsearch');
Route::get('/penduduk/search', [PendudukController::class, 'search'])->name('pensearch');

Route::get('/getKabupaten/{id}', function ($id) {
  $kabupaten = App\Models\Kabupaten::where('id_provinsi',$id)->get();
  return response()->json($kabupaten);
});

Route::resource('/provinsi', ProvinsiController::class);
Route::resource('/kabupaten', KabupatenController::class);
Route::resource('/penduduk', PendudukController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/search', [LaporanController::class, 'search'])->name('lapsearch');

Route::get('/laporan/print', [LaporanController::class, 'print'])->name('print');
Route::get('/laporan/excel', [LaporanController::class, 'excel'])->name('excel');