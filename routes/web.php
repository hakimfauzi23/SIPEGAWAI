<?php

use App\Http\Controllers\CutiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PresensiHarianController;


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
    return view('admin.content');
});


//Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/detail/{data}', [PegawaiController::class, 'show'])->name('pegawai.details');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/edit/{data}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/update/{data}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::get('/pegawai/destroy/{data}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

//Jabatan 
Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
Route::post('/jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
Route::get('/jabatan/edit/{data}', [JabatanController::class, 'edit'])->name('jabatan.edit');
Route::put('/jabatan/update/{data}', [JabatanController::class, 'update'])->name('jabatan.update');
Route::get('/jabatan/destroy/{data}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

//Divisi
Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::get('/divisi/create', [DivisiController::class, 'create'])->name('divisi.create');
Route::post('/divisi/store', [DivisiController::class, 'store'])->name('divisi.store');
Route::get('/divisi/edit/{data}', [DivisiController::class, 'edit'])->name('divisi.edit');
Route::put('/divisi/update/{data}', [DivisiController::class, 'update'])->name('divisi.update');
Route::get('/divisi/destroy/{data}', [DivisiController::class, 'destroy'])->name('divisi.destroy');


//Presensi 
Route::get('/presensi', [PresensiHarianController::class, 'index'])->name('presensi.index');
Route::get('/presensi/create', [PresensiHarianController::class, 'create'])->name('presensi.create');
Route::post('/presensi/store', [PresensiHarianController::class, 'store'])->name('presensi.store');
Route::get('/presensi/edit/{data}', [PresensiHarianController::class, 'edit'])->name('presensi.edit');
Route::put('/presensi/update/{data}', [PresensiHarianController::class, 'update'])->name('presensi.update');
Route::get('/presensi/destroy/{data}', [PresensiHarianController::class, 'destroy'])->name('presensi.destroy');


//Cuti 
Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
Route::get('/cuti/detail/{data}', [CutiController::class, 'show'])->name('cuti.details');
Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create');
Route::post('/cuti/store', [CutiController::class, 'store'])->name('cuti.store');
Route::get('/cuti/edit/{data}', [CutiController::class, 'edit'])->name('cuti.edit');
Route::put('/cuti/update/{data}', [CutiController::class, 'update'])->name('cuti.update');
Route::get('/cuti/destroy/{data}', [CutiController::class, 'destroy'])->name('cuti.destroy');
