<?php

use App\Http\Controllers\Controller;
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
use App\Http\Controllers\RekapCutiController;

use App\Http\Controllers\Hrd\HrdPeraturanController;
use App\Http\Controllers\Hrd\HrdPegawaiController;
use App\Http\Controllers\Hrd\HrdPresensiHarianController;
use App\Http\Controllers\Hrd\HrdCutiController;

use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\Hrd\HrdPengajuanCutiController;
use App\Http\Controllers\RekapKinerjaController;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Chart\Layout;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Staff\StaffCutiController;
use App\Http\Controllers\Staff\StaffPengajuanCutiController;
use RealRashid\SweetAlert\Facades\Alert;

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
//     return view('content');
// });


// !!!!!DI SINI ADALAH ROUTES UNTUK MENU LOGIN!!!!! //
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
/**  End Route Login**/


// !!!!!DI SINI ADALAH ROUTES UNTUK MENU REKAP DATA CUTI PRESENSI!!!!! //
//RekapDataPresensi
Route::resource('rekapPresensi', RekapPresensiController::class);
Route::get('/rekapPresensi/{data}/showMonth/{thisMonth}/{intMonth}', [RekapPresensiController::class, 'showMonth'])->name('rekapPresensi.showMonth');

//RekapCutiPegawai
Route::resource('rekapCuti', RekapCutiController::class);
Route::get('/rekapCuti/tahun/{data}', [RekapCutiController::class, 'showYear'])->name('rekapCuti.showYear');
/**  End Route Rekap Data Cuti Presensi**/

// !!!!!DI SINI ADALAH ROUTES UNTUK KEPERLUAN PROFIL DAN PASSWORD!!!!! //
//Profil
Route::resource('/profil', ProfilController::class);


//Password
Route::resource('/pass', PasswordController::class);
/**  End Route Profil dan Password**/


// !!!!!DI SINI ADALAH ROUTES UNTUK MENU ADMIN!!!!! //
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:superAdmin']], function () {

        Route::get('/superAdmin', function () {
            return view('admin.dashboard');
        });

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
        Route::post('/cuti/cutiBersama/store', [CutiController::class, 'storeCutiBersama'])->name('cuti.storeCutiBersama');
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
    });
    /**  End Menu Admin **/



    // !!!!!DI SINI ADALAH ROUTES UNTUK MENU HRD!!!!! //
    Route::group(['middleware' => ['cek_login:hrd']], function () {
        /*
        Route Khusus untuk role HRD
    	*/
        Route::get('/hrd', function () {
            return view('hrd.dashboard');
        });
        
        // Peraturan 
        Route::resource('hrdPeraturan', HrdPeraturanController::class);
        Route::put('/hrdPeraturan/editJamMasuk/{data}', [HrdPeraturanController::class, 'jamMasuk'])->name('hrdPeraturan.editJamMasuk');
        Route::put('/hrdPeraturan/editJamPulang/{data}', [HrdPeraturanController::class, 'jamPulang'])->name('hrdPeraturan.editJamPulang');
        Route::put('/hrdPeraturan/editCutiTahunan/{data}', [HrdPeraturanController::class, 'cutiTahunan'])->name('hrdPeraturan.editCutiTahunan');
        Route::put('/hrdPeraturan/editCutiBersama/{data}', [HrdPeraturanController::class, 'cutiBersama'])->name('hrdPeraturan.editCutiBersama');
        Route::put('/hrdPeraturan/editCutiPenting/{data}', [HrdPeraturanController::class, 'cutiPenting'])->name('hrdPeraturan.editCutiPenting');
        Route::put('/hrdPeraturan/editCutiSakit/{data}', [HrdPeraturanController::class, 'cutiSakit'])->name('hrdPeraturan.editCutiSakit');
        Route::put('/hrdPeraturan/editCutiBesar/{data}', [HrdPeraturanController::class, 'cutiBesar'])->name('hrdPeraturan.editCutiBesar');
        Route::put('/hrdPeraturan/editCutiHamil/{data}', [HrdPeraturanController::class, 'cutiHamil'])->name('hrdPeraturan.editCutiHamil');


        //Pegawai
        Route::resource('hrdPegawai', HrdPegawaiController::class);
        Route::get('/hrdPegawai/destroy/{data}', [HrdPegawaiController::class, 'destroy'])->name('hrdPegawai.destroy');

        Route::get('/hrdPegawai/showJabatan/{data}', [HrdPegawaiController::class, 'showJabatan'])->name('hrdPegawai.showJabatan');
        Route::get('/hrdPegawai/editRiwayatJabatan/{data}', [HrdPegawaiController::class, 'editRiwayatJabatan'])->name('hrdPegawai.editRiwayatJabatan');
        Route::put('/hrdPegawai/updateRiwayatJabatan/{data}', [HrdPegawaiController::class, 'updateRiwayatJabatan'])->name('hrdPegawai.updateRiwayatJabatan');

        Route::get('/hrdPegawai/showDivisi/{data}', [HrdPegawaiController::class, 'showDivisi'])->name('hrdPegawai.showDivisi');
        Route::get('/hrdPegawai/editRiwayatDivisi/{data}', [HrdPegawaiController::class, 'editRiwayatDivisi'])->name('hrdPegawai.editRiwayatDivisi');
        Route::put('/hrdPegawai/updateRiwayatDivisi/{data}', [HrdPegawaiController::class, 'updateRiwayatDivisi'])->name('hrdPegawai.updateRiwayatDivisi');


        //Presensi Harian//
        Route::get('/hrdPresensiHarian/tanggal/', [HrdPresensiHarianController::class, 'tglPresensi'])->name('hrdPresensiHarian.search');
        Route::resource('hrdPresensiHarian', HrdPresensiHarianController::class);
        Route::get('/hrdPresensiHarian/destroy/{data}', [HrdPresensiHarianController::class, 'destroy'])->name('hrdPresensiHarian.destroy');
        Route::post('/hrdPresensiHarian/import_excel', [HrdPresensiHarianController::class, 'import'])->name('hrdPresensiHarian.import');
        Route::get('/hrdPresensiHarian/template_download', [HrdPresensiHarianController::class, 'download'])->name('hrdPresensiHarian.template');

        //Cuti 
        Route::get('/hrdCuti/tanggal/', [HrdCutiController::class, 'tglPresensi'])->name('hrdCuti.search');
        Route::get('/hrdCuti/cutiBersama', [HrdCutiController::class, 'cutiBersama'])->name('hrdCuti.cutiBersama');
        Route::post('/hrdCuti/cutiBersama/store', [HrdCutiController::class, 'storeCutiBersama'])->name('hrdCuti.storeCutiBersama');
        Route::resource('hrdCuti', HrdCutiController::class);
        Route::get('/hrdCuti/destroy/{data}', [HrdCutiController::class, 'destroy'])->name('hrdCuti.destroy');


        //Pengajuan Cuti
        Route::resource('hrdPengajuanCuti', HrdPengajuanCutiController::class);
        Route::put('/hrdPengajuanCuti/keputusan/{data}', [HrdPengajuanCutiController::class, 'keputusan'])->name('hrdPengajuanCuti.keputusan');
    });
    /**  End Menu HRD**/




    // !!!!!DI SINI ADALAH ROUTES UNTUK MENU STAFF!!!!! //
    Route::group(['middleware' => ['cek_login:staff']], function () {
        /*
        Route Khusus untuk role Staff
    	*/
        Route::get('/staff', function () {
            return view('staff.dashboard');
        });

        //Cuti
        Route::resource('staffCuti', StaffCutiController::class);
        Route::post('/staffCuti/tahun/', [StaffCutiController::class, 'tahunCuti'])->name('staffCuti.search');



        //Pengajuan Cuti
        Route::resource('staffPengajuanCuti', StaffPengajuanCutiController::class);
        Route::put('/staffPengajuanCuti/keputusan/{data}', [StaffPengajuanCutiController::class, 'keputusan'])->name('staffPengajuanCuti.keputusan');
    });
    /**  End Menu Staff**/
});















    // Route::get('send-mail', function () {

    //     $details = [
    //         'title' => 'Mail from ItSolutionStuff.com',
    //         'body' => 'This is for testing email using smtp'
    //     ];

    //     Mail::to('mr.expendables25@gmail.com')->send(new \App\Mail\MyTestMail($details));

    //     dd("Email is Sent.");
    // });
