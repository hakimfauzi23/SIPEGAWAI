<?php

use App\Http\Controllers\CutiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PresensiHarianController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\HrdPegawaiController;
use App\Http\Controllers\HrdRiwayatDivisiController;
use App\Http\Controllers\RekapKinerjaController;
use App\Http\Controllers\RiwayatDivisiController;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

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
    $currentPage = 'home';
    return view('user.layouts.landingPage', ['currentPage' => $currentPage]);
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
Route::post('/presensi/import_excel', [PresensiHarianController::class, 'import'])->name('presensi.import');
Route::get('/presensi/template_download', [PresensiHarianController::class, 'download'])->name('presensi.template');


//Cuti 
Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
Route::get('/cuti/detail/{data}', [CutiController::class, 'show'])->name('cuti.details');
Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create');
Route::post('/cuti/store', [CutiController::class, 'store'])->name('cuti.store');
Route::get('/cuti/edit/{data}', [CutiController::class, 'edit'])->name('cuti.edit');
Route::put('/cuti/update/{data}', [CutiController::class, 'update'])->name('cuti.update');
Route::get('/cuti/destroy/{data}', [CutiController::class, 'destroy'])->name('cuti.destroy');


//RiwayatJabatan
Route::get('/riwayat_jabatan/show/{data}', [RiwayatJabatanController::class, 'show'])->name('riwayatJabatan.show');
Route::get('/riwayat_jabatan/edit/{data}', [RiwayatJabatanController::class, 'edit'])->name('riwayatJabatan.edit');
Route::put('/riwayat_jabatan/update/{data}', [RiwayatJabatanController::class, 'update'])->name('riwayatJabatan.update');
Route::get('/riwayat_jabatan/destroy/{data}', [RiwayatJabatanController::class, 'destroy'])->name('riwayatJabatan.destroy');


//RiwayatDivisi
Route::get('/riwayat_divisi/show/{data}', [RiwayatDivisiController::class, 'show'])->name('riwayatDivisi.show');
Route::get('/riwayat_divisi/edit/{data}', [RiwayatDivisiController::class, 'edit'])->name('riwayatDivisi.edit');
Route::put('/riwayat_divisi/update/{data}', [RiwayatDivisiController::class, 'update'])->name('riwayatDivisi.update');
Route::get('/riwayat_divisi/destroy/{data}', [RiwayatDivisiController::class, 'destroy'])->name('riwayatDivisi.destroy');


//RekapKinerja
Route::get('/kinerja/show/{data}', [RekapKinerjaController::class, 'show'])->name('rekapKinerja.show');



// HRD MENU!! // 

//Pegawai
Route::resource('hrdPegawai', HrdPegawaiController::class);
Route::get('landingPage', function () {
    $currentPage = 'home';
    return view('user.layouts.landingPage', ['currentPage' => $currentPage]);
});
Route::get('/hrdPegawai/destroy/{data}', [HrdPegawaiController::class, 'destroy'])->name('hrdPegawai.destroy');
Route::get('/hrdPegawai/rekapKinerja/{data}', [HrdPegawaiController::class, 'rekapKinerja'])->name('hrdRekapKinerja.show');


//RiwayatDivisi
Route::resource('hrdRiwayatDivisi',HrdRiwayatDivisiController::class);