<?php

use App\Http\Controllers\CutiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PresensiHarianController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\RiwayatDivisiController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\HrdPegawaiController;
use App\Http\Controllers\HrdCutiController;
use App\Http\Controllers\HrdRiwayatDivisiController;
use App\Http\Controllers\HrdRiwayatJabatanController;
use App\Http\Controllers\HrdPresensiHarianController;
use App\Http\Controllers\RekapKinerjaController;
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

// Route::get('/', function () {
//     return view('admin.pegawai.index');
// });

Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');






// !!!!!DI SINI ADALAH ROUTES UNTUK MENU ADMIN!!!!! //

//Pegawai
Route::resource('pegawai', PegawaiController::class);
Route::get('/pegawai/destroy/{data}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');



//Jabatan
Route::resource('jabatan', JabatanController::class);
Route::get('/jabatan/destroy/{data}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

//Divisi
Route::resource('divisi', DivisiController::class);
Route::get('/divisi/destroy/{data}', [DivisiController::class, 'destroy'])->name('divisi.destroy');


//Presensi
Route::get('/presensi/tanggal/', [PresensiHarianController::class, 'tglPresensi'])->name('presensi.search');
Route::resource('presensi', PresensiHarianController::class);
Route::get('/presensi/destroy/{data}', [PresensiHarianController::class, 'destroy'])->name('presensi.destroy');
Route::post('/presensi/import_excel', [PresensiHarianController::class, 'import'])->name('presensi.import');
Route::get('/presensi/template_download', [PresensiHarianController::class, 'download'])->name('presensi.template');


//Cuti 
Route::get('/cuti/tanggal/', [CutiController::class, 'tglPresensi'])->name('cuti.search');
Route::get('/cuti/cutiBersama', [CutiController::class, 'cutiBersama'])->name('cuti.cutiBersama');
Route::post('/cutiBersama/store', [CutiController::class, 'storeCutiBersama'])->name('cuti.storeCutiBersama');
Route::resource('cuti', CutiController::class);
Route::get('/cuti/destroy/{data}', [CutiController::class, 'destroy'])->name('cuti.destroy');


//RiwayatJabatan
Route::resource('riwayatJabatan', RiwayatJabatanController::class);
Route::post('/riwayatJabatan/store', [RiwayatJabatanController::class, 'store'])->name('riwayatJabatan.store');
Route::get('/riwayatJabatan/createData/{data}', [RiwayatJabatanController::class, 'createData'])->name('riwayatJabatan.createData');
Route::get('/riwayatJabatan/destroy/{data}', [RiwayatJabatanController::class, 'destroy'])->name('riwayatJabatan.destroy');


//RiwayatDivisi
Route::resource('riwayatDivisi', RiwayatDivisiController::class);
Route::post('/riwayatDivisi/store', [RiwayatDivisiController::class, 'store'])->name('riwayatDivisi.store');
Route::get('/riwayatDivisi/createData/{data}', [RiwayatDivisiController::class, 'createData'])->name('riwayatDivisi.createData');
Route::get('/riwayatDivisi/destroy/{data}', [RiwayatDivisiController::class, 'destroy'])->name('riwayatDivisi.destroy');


//Kebijakan Jam Kerja & Cuti
Route::resource('peraturan', PeraturanController::class);
Route::put('/peraturan/editJamMasuk/{data}', [PeraturanController::class, 'jamMasuk'])->name('peraturan.editJamMasuk');
Route::put('/peraturan/editJamPulang/{data}', [PeraturanController::class, 'jamPulang'])->name('peraturan.editJamPulang');
Route::put('/peraturan/editCutiTahunan/{data}', [PeraturanController::class, 'cutiTahunan'])->name('peraturan.editCutiTahunan');
Route::put('/peraturan/editCutiBersama/{data}', [PeraturanController::class, 'cutiBersama'])->name('peraturan.editCutiBersama');
Route::put('/peraturan/editCutiPenting/{data}', [PeraturanController::class, 'cutiPenting'])->name('peraturan.editCutiPenting');
Route::put('/peraturan/editCutiSakit/{data}', [PeraturanController::class, 'cutiSakit'])->name('peraturan.editCutiSakit');
Route::put('/peraturan/editCutiBesar/{data}', [PeraturanController::class, 'cutiBesar'])->name('peraturan.editCutiBesar');
Route::put('/peraturan/editCutiHamil/{data}', [PeraturanController::class, 'cutiHamil'])->name('peraturan.editCutiHamil');



//RekapDataPresensi
Route::resource('rekapPresensi', RekapPresensiController::class);
Route::get('/rekapPresensi/{data}/showMonth/{thisMonth}/{intMonth}', [RekapPresensiController::class, 'showMonth'])->name('rekapPresensi.showMonth');









// // HRD MENU!! // 

// //Pegawai
// Route::get('/hrdPegawai/search', [HrdPegawaiController::class, 'search'])->name('hrdPegawai.search');
// Route::resource('hrdPegawai', HrdPegawaiController::class);
// Route::get('landingPage', function () {
//     $currentPage = 'home';
//     return view('user.layouts.landingPage', ['currentPage' => $currentPage]);
// });
// Route::get('/hrdPegawai/destroy/{data}', [HrdPegawaiController::class, 'destroy'])->name('hrdPegawai.destroy');
// Route::get('/hrdPegawai/rekapKinerja/{data}', [HrdPegawaiController::class, 'rekapKinerja'])->name('hrdRekapKinerja.show');



// //RiwayatDivisi
// Route::resource('hrdRiwayatDivisi', HrdRiwayatDivisiController::class);
// Route::get('/hrdRiwayatDivisi/destroy/{data}', [HrdRiwayatDivisiController::class, 'destroy'])->name('hrdRiwayatDivisi.destroy');




// //RiwayatJabatan
// Route::resource('hrdRiwayatJabatan', HrdRiwayatJabatanController::class);
// Route::get('/hrdRiwayatJabatan/destroy/{data}', [HrdRiwayatJabatanController::class, 'destroy'])->name('hrdRiwayatJabatan.destroy');




// //Cuti
// Route::get('/hrdCuti/search', [HrdCutiController::class, 'search'])->name('hrdCuti.search');
// Route::get('/hrdCuti/search_pengajuan', [HrdCutiController::class, 'search_pengajuan'])->name('hrdCuti.searchPengajuan');
// Route::get('/hrdCuti/pengajuan', [HrdCutiController::class, 'pengajuan'])->name('hrdCuti.pengajuan');
// Route::resource('hrdCuti', HrdCutiController::class);
// Route::get('/hrdCuti/destroy/{data}', [HrdCutiController::class, 'destroy'])->name('hrdCuti.destroy');
// Route::put('/hrdCuti/keputusan/{data}', [HrdCutiController::class, 'keputusan'])->name('hrdCuti.keputusan');
// Route::get('/hrdCuti/detail_pengajuan/{data}', [HrdCutiController::class, 'detail_pengajuan'])->name('hrdCuti.detailPengajuan');






// //PresensiHarian
// Route::get('/hrdPresensi/search', [HrdPresensiHarianController::class, 'search'])->name('hrdPresensi.search');
// Route::resource('hrdPresensi', HrdPresensiHarianController::class);
// Route::post('/hrdPresensi/import_excel', [HrdPresensiHarianController::class, 'import'])->name('hrdPresensi.import');
// Route::get('/hrdPresensi/destroy/{data}', [HrdPresensiHarianController::class, 'destroy'])->name('hrdPresensi.destroy');
