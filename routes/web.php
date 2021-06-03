<?php

use App\Http\Controllers\AdminHrdDashboardController;
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
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\Hrd\HrdDashboardController;
use App\Http\Controllers\ManajemenRoleMenuController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReportKinerjaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Staff\StaffCutiController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffPengajuanCutiController;
use App\Http\Controllers\SuratPeringatanController;
use App\Http\Controllers\TunjanganController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('landingPage.index');
});


// !!!!!DI SINI ADALAH ROUTES UNTUK MENU LOGIN!!!!! //
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Reset Password
Route::get('/forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password.getEmail');
Route::post('/forget-password/postEmail', [ForgotPasswordController::class, 'postEmail'])->name('forget-password.postEmail');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset-password.getPassword');
Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset-password.updatePassword');


Route::group(['middleware' => ['auth']], function () {


    //Rekap Presensi Pegawai
    Route::resource('rekapPresensi', RekapPresensiController::class);
    Route::get('/rekapPresensi/tahun/{data}', [RekapPresensiController::class, 'search'])->name('rekapPresensi.search');


    //Rekap Cuti Pegawai
    Route::resource('rekapCuti', RekapCutiController::class);
    Route::get('/rekapCuti/tahun/{data}', [RekapCutiController::class, 'showYear'])->name('rekapCuti.showYear');


    //Profil
    Route::resource('/profil', ProfilController::class);


    // Ganti Password
    Route::resource('/pass', PasswordController::class);


    //Cuti
    Route::resource('staffCuti', StaffCutiController::class);
    Route::post('/staffCuti/tahun/', [StaffCutiController::class, 'tahunCuti'])->name('staffCuti.search');


    //Pengajuan Cuti
    Route::resource('staffPengajuanCuti', StaffPengajuanCutiController::class);
    Route::put('/staffPengajuanCuti/keputusan/{data}', [StaffPengajuanCutiController::class, 'keputusan'])->name('staffPengajuanCuti.keputusan');


    // Dashboard Admin
    Route::resource('superAdmin', Dashboard::class);


    // Dashboard HRD
    Route::resource('hrd', HrdDashboardController::class);
    Route::post('/hrd/grafKehadiran/', [HrdDashboardController::class, 'kehadiran'])->name('hrd.grafKehadiran');


    //Pegawai
    Route::get('/pegawai/restore/{data}', [PegawaiController::class, 'restore'])->name('pegawai.restore');
    Route::get('/pegawai/trash/', [PegawaiController::class, 'trash'])->name('pegawai.trash');
    Route::resource('pegawai', PegawaiController::class);
    Route::get('/pegawai/destroy/{data}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::get('/pegawai/destroyPermanent/{data}', [PegawaiController::class, 'destroyPermanent'])->name('pegawai.destroyPermanent');


    //Jabatan
    Route::resource('jabatan', JabatanController::class);
    Route::get('/jabatan/destroy/{data}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');


    //Divisi
    Route::resource('divisi', DivisiController::class);
    Route::get('/divisi/destroy/{data}', [DivisiController::class, 'destroy'])->name('divisi.destroy');


    //Presensi
    Route::get('/presensi/tanggal/', [PresensiHarianController::class, 'tglPresensi'])->name('presensi.search');
    Route::get('/presensi/template_download', [PresensiHarianController::class, 'download'])->name('presensi.template');
    Route::resource('/presensi', PresensiHarianController::class);
    Route::get('/presensi/destroy/{data}', [PresensiHarianController::class, 'destroy'])->name('presensi.destroy');
    Route::post('/presensi/import_excel', [PresensiHarianController::class, 'import'])->name('presensi.import');


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


    //Menu Staff 
    Route::resource('staff', StaffDashboardController::class);
    Route::post('/staff/pres/', [StaffDashboardController::class, 'presensi'])->name('staff.presensi');


    //Menu Manajemen Role & Menu Dinamis
    Route::resource('role', RoleController::class);
    Route::get('/role/destroy/{data}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::patch('/role/update/{data}', [RoleController::class, 'update'])->name('role.update');

    Route::get('/manajemen', [ManajemenRoleMenuController::class, 'index'])->name('manajemen.index');

    Route::get('/manajemen/createMenu', [ManajemenRoleMenuController::class, 'createMenu'])->name('manajemen.createMenu');
    Route::post('/manajemen/storeMenu', [ManajemenRoleMenuController::class, 'storeMenu'])->name('manajemen.storeMenu');
    Route::get('/manajemen/{data}/editMenu', [ManajemenRoleMenuController::class, 'editMenu'])->name('manajemen.editMenu');
    Route::patch('/manajemen/{data}/updateMenu', [ManajemenRoleMenuController::class, 'updateMenu'])->name('manajemen.updateMenu');
    Route::get('/manajemen/{data}/destroyMenu', [ManajemenRoleMenuController::class, 'destroyMenu'])->name('manajemen.destroyMenu');

    Route::get('/manajemen/createHakAkses', [ManajemenRoleMenuController::class, 'createHakAkses'])->name('manajemen.createHakAkses');
    Route::post('/manajemen/storeHakAkses', [ManajemenRoleMenuController::class, 'storeHakAkses'])->name('manajemen.storeHakAkses');


    // Menu Gaji
    Route::resource('tunjangan', TunjanganController::class);
    Route::get('/tunjangan/destroy/{data}', [TunjanganController::class, 'destroy'])->name('tunjangan.destroy');


    Route::resource('potongan', PotonganController::class);
    Route::get('/potongan/destroy/{data}', [PotonganController::class, 'destroy'])->name('potongan.destroy');


    Route::resource('gaji', GajiController::class);
    Route::get('/gaji/createData/{data}', [GajiController::class, 'createData'])->name('gaji.createData');
    Route::get('/gaji/download/{data}', [GajiController::class, 'downloadSlipGaji'])->name('gaji.download');
    Route::get('/gaji/destroy/{data}', [GajiController::class, 'destroy'])->name('gaji.destroy');
    Route::get('/gaji/send/{id_pegawai}/{id_gaji}', [GajiController::class, 'sendEmail'])->name('gaji.send');


    //Menu Surat Peringatan
    Route::resource('suratPeringatan', SuratPeringatanController::class);
    Route::get('/suratPeringatan/search/', [SuratPeringatanController::class, 'searchSurat'])->name('suratPeringatan.search');
    Route::get('/suratPeringatan/destroy/{data}', [SuratPeringatanController::class, 'destroy'])->name('suratPeringatan.destroy');


    //Menu Report Kinerja
    Route::get('report/export/getYear',[ReportKinerjaController::class,'getList'])->name('report.getYear');
    Route::resource('report', ReportKinerjaController::class);
    Route::get('/report/export/{id_pegawai}/{year}', [ReportKinerjaController::class, 'exportKinerja'])->name('report.exportKinerja');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // // !!!!!DI SINI ADALAH ROUTES UNTUK MENU HRD!!!!! //
    // Route::resource('hrd', HrdDashboardController::class);
    // Route::post('/hrd/grafKehadiran/', [HrdDashboardController::class, 'kehadiran'])->name('hrd.grafKehadiran');

    // // Peraturan 
    // Route::resource('hrdPeraturan', HrdPeraturanController::class);

    // //Pegawai
    // Route::get('/hrdPegawai/restore/{data}', [HrdPegawaiController::class, 'restore'])->name('hrdPegawai.restore');
    // Route::get('/hrdPegawai/trash/', [HrdPegawaiController::class, 'trash'])->name('hrdPegawai.trash');

    // Route::resource('hrdPegawai', HrdPegawaiController::class);
    // Route::get('/hrdPegawai/destroy/{data}', [HrdPegawaiController::class, 'destroy'])->name('hrdPegawai.destroy');
    // Route::get('/hrdPegawai/destroyPermanent/{data}', [HrdPegawaiController::class, 'destroyPermanent'])->name('hrdPegawai.destroyPermanent');

    // Route::get('/hrdPegawai/showJabatan/{data}', [HrdPegawaiController::class, 'showJabatan'])->name('hrdPegawai.showJabatan');
    // Route::get('/hrdPegawai/editRiwayatJabatan/{data}', [HrdPegawaiController::class, 'editRiwayatJabatan'])->name('hrdPegawai.editRiwayatJabatan');
    // Route::put('/hrdPegawai/updateRiwayatJabatan/{data}', [HrdPegawaiController::class, 'updateRiwayatJabatan'])->name('hrdPegawai.updateRiwayatJabatan');

    // Route::get('/hrdPegawai/showDivisi/{data}', [HrdPegawaiController::class, 'showDivisi'])->name('hrdPegawai.showDivisi');
    // Route::get('/hrdPegawai/editRiwayatDivisi/{data}', [HrdPegawaiController::class, 'editRiwayatDivisi'])->name('hrdPegawai.editRiwayatDivisi');
    // Route::put('/hrdPegawai/updateRiwayatDivisi/{data}', [HrdPegawaiController::class, 'updateRiwayatDivisi'])->name('hrdPegawai.updateRiwayatDivisi');


    // //Presensi Harian//
    // Route::get('/hrdPresensiHarian/template_download', [HrdPresensiHarianController::class, 'download'])->name('hrdPresensiHarian.template');
    // Route::get('/hrdPresensiHarian/tanggal/', [HrdPresensiHarianController::class, 'tglPresensi'])->name('hrdPresensiHarian.search');
    // Route::resource('hrdPresensiHarian', HrdPresensiHarianController::class);
    // Route::get('/hrdPresensiHarian/destroy/{data}', [HrdPresensiHarianController::class, 'destroy'])->name('hrdPresensiHarian.destroy');
    // Route::post('/hrdPresensiHarian/import_excel', [HrdPresensiHarianController::class, 'import'])->name('hrdPresensiHarian.import');

    // //Cuti 
    // Route::get('/hrdCuti/tanggal/', [HrdCutiController::class, 'tglPresensi'])->name('hrdCuti.search');
    // Route::get('/hrdCuti/cutiBersama', [HrdCutiController::class, 'cutiBersama'])->name('hrdCuti.cutiBersama');
    // Route::post('/hrdCuti/cutiBersama/store', [HrdCutiController::class, 'storeCutiBersama'])->name('hrdCuti.storeCutiBersama');
    // Route::resource('hrdCuti', HrdCutiController::class);
    // Route::get('/hrdCuti/destroy/{data}', [HrdCutiController::class, 'destroy'])->name('hrdCuti.destroy');


    // //Pengajuan Cuti
    // Route::resource('hrdPengajuanCuti', HrdPengajuanCutiController::class);
    // Route::put('/hrdPengajuanCuti/keputusan/{data}', [HrdPengajuanCutiController::class, 'keputusan'])->name('hrdPengajuanCuti.keputusan');
    // /**  End Menu HRD**/
