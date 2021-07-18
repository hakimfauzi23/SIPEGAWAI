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


use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\Hrd\HrdPengajuanCutiController;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Chart\Layout;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\Hrd\HrdDashboardController;
use App\Http\Controllers\ManajemenPerusahaanController;
use App\Http\Controllers\ManajemenRoleMenuController;
use App\Http\Controllers\PenilaianKinerjaController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReportKinerjaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
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

    //Search
    Route::get('/pegawai/search/', [SearchController::class, 'pegawai'])->name('pegawai.search');
    Route::get('/penilaian/search/', [SearchController::class, 'penilaian'])->name('penilaian.search');
    Route::get('/riwayatJabatan/search/', [SearchController::class, 'riwayatJabatan'])->name('riwayatJabatan.search');
    Route::get('/riwayatDivisi/search/', [SearchController::class, 'riwayatDivisi'])->name('riwayatDivisi.search');
    Route::get('/rekapPresensi/search/', [SearchController::class, 'rekapPresensi'])->name('rekapPresensi.search.pegawai');
    Route::get('/rekapCuti/search/', [SearchController::class, 'rekapCuti'])->name('rekapCuti.search.pegawai');
    Route::get('/gaji/search/', [SearchController::class, 'gaji'])->name('gaji.search.pegawai');
    Route::get('/report/search/', [SearchController::class, 'report'])->name('report.search.pegawai');
    Route::get('/presensi/search/', [SearchController::class, 'presensi'])->name('presensi.search.data');
    Route::get('/cuti/search/', [SearchController::class, 'cuti'])->name('cuti.search.data');


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


    //Cuti Staff
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
    Route::resource('hrdPengajuanCuti', HrdPengajuanCutiController::class); // pengajuan cuti tingkat HRD
    Route::put('/hrdPengajuanCuti/keputusan/{data}', [HrdPengajuanCutiController::class, 'keputusan'])->name('hrdPengajuanCuti.keputusan');


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
    Route::get('/staff/openFile/{data}', [StaffDashboardController::class, 'openFile'])->name('staff.openFile');


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
    Route::put('/tunjangan/isActive/{data}', [TunjanganController::class, 'isActive'])->name('tunjangan.isActive');
    Route::put('/tunjangan/isShown/{data}', [TunjanganController::class, 'isShown'])->name('tunjangan.isShown');

    Route::resource('potongan', PotonganController::class);
    Route::get('/potongan/destroy/{data}', [PotonganController::class, 'destroy'])->name('potongan.destroy');
    Route::put('/potongan/isActive/{data}', [PotonganController::class, 'isActive'])->name('potongan.isActive');
    Route::put('/potongan/isShown/{data}', [PotonganController::class, 'isShown'])->name('potongan.isShown');

    Route::resource('gaji', GajiController::class);
    Route::get('/gaji/createData/{data}', [GajiController::class, 'createData'])->name('gaji.createData');
    Route::get('/gaji/download/{data}', [GajiController::class, 'downloadSlipGaji'])->name('gaji.download');
    Route::get('/gaji/destroy/{data}', [GajiController::class, 'destroy'])->name('gaji.destroy');
    Route::get('/gaji/send/{id_pegawai}/{id_gaji}', [GajiController::class, 'sendEmail'])->name('gaji.send');


    //Menu Surat Peringatan
    Route::get('/suratPeringatan/search/', [SuratPeringatanController::class, 'searchSurat'])->name('suratPeringatan.search');
    Route::resource('suratPeringatan', SuratPeringatanController::class);
    Route::get('/suratPeringatan/destroy/{data}', [SuratPeringatanController::class, 'destroy'])->name('suratPeringatan.destroy');


    //Menu Report Kinerja
    Route::get('report/export/getYear', [ReportKinerjaController::class, 'getList'])->name('report.getYear');
    Route::resource('report', ReportKinerjaController::class);
    Route::get('/report/export/{id_pegawai}/{year}', [ReportKinerjaController::class, 'exportKinerja'])->name('report.exportKinerja');


    //Menu Manajemen Perusahaan
    Route::resource('perusahaan', ManajemenPerusahaanController::class);


    //Penilaian Kinerja Karyawan
    Route::get('/penilaian/showAll', [PenilaianKinerjaController::class, 'showAll'])->name('penilaian.showAll');
    Route::resource('penilaian', PenilaianKinerjaController::class);
    Route::get('/penilaian/createData/{data}', [PenilaianKinerjaController::class, 'createData'])->name('penilaian.createData');
});

Auth::routes();
