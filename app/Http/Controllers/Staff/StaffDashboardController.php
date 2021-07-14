<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class StaffDashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu-staff', ['all']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $id = $user->id;
        $intMonth = date('m');
        $year = date('Y');
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, date('Y'));

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;


        /*  Cuti Tahunan Pegawai  */

        $JanTahunan = 0;
        $FebTahunan = 0;
        $MarTahunan = 0;
        $AprTahunan = 0;
        $MayTahunan = 0;
        $JunTahunan = 0;
        $JulTahunan = 0;
        $AugTahunan = 0;
        $SepTahunan = 0;
        $OctTahunan = 0;
        $NovTahunan = 0;
        $DecTahunan = 0;

        $Tahunan = [
            '',
            $JanTahunan, $FebTahunan, $MarTahunan, $AprTahunan,
            $MayTahunan, $JunTahunan, $JulTahunan, $AugTahunan,
            $SepTahunan, $OctTahunan, $NovTahunan, $DecTahunan
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Tahunan[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Tahunan')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Tahunan Pegawai*/


        /*  Cuti Bersama Pegawai  */

        $JanBersama = 0;
        $FebBersama = 0;
        $MarBersama = 0;
        $AprBersama = 0;
        $MayBersama = 0;
        $JunBersama = 0;
        $JulBersama = 0;
        $AugBersama = 0;
        $SepBersama = 0;
        $OctBersama = 0;
        $NovBersama = 0;
        $DecBersama = 0;

        $Bersama = [
            '',
            $JanBersama, $FebBersama, $MarBersama, $AprBersama,
            $MayBersama, $JunBersama, $JulBersama, $AugBersama,
            $SepBersama, $OctBersama, $NovBersama, $DecBersama
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Bersama[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Bersama')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Bersama Pegawai*/

        /*  Cuti Penting Pegawai  */

        $JanPenting = 0;
        $FebPenting = 0;
        $MarPenting = 0;
        $AprPenting = 0;
        $MayPenting = 0;
        $JunPenting = 0;
        $JulPenting = 0;
        $AugPenting = 0;
        $SepPenting = 0;
        $OctPenting = 0;
        $NovPenting = 0;
        $DecPenting = 0;

        $Penting = [
            '',
            $JanPenting, $FebPenting, $MarPenting, $AprPenting,
            $MayPenting, $JunPenting, $JulPenting, $AugPenting,
            $SepPenting, $OctPenting, $NovPenting, $DecPenting
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Penting[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Penting')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Penting Pegawai*/


        /*  Cuti Besar Pegawai  */

        $JanBesar = 0;
        $FebBesar = 0;
        $MarBesar = 0;
        $AprBesar = 0;
        $MayBesar = 0;
        $JunBesar = 0;
        $JulBesar = 0;
        $AugBesar = 0;
        $SepBesar = 0;
        $OctBesar = 0;
        $NovBesar = 0;
        $DecBesar = 0;

        $Besar = [
            '',
            $JanBesar, $FebBesar, $MarBesar, $AprBesar,
            $MayBesar, $JunBesar, $JulBesar, $AugBesar,
            $SepBesar, $OctBesar, $NovBesar, $DecBesar
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Besar[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Besar')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Besar Pegawai*/

        /*  Cuti Sakit Pegawai  */

        $JanSakit = 0;
        $FebSakit = 0;
        $MarSakit = 0;
        $AprSakit = 0;
        $MaySakit = 0;
        $JunSakit = 0;
        $JulSakit = 0;
        $AugSakit = 0;
        $SepSakit = 0;
        $OctSakit = 0;
        $NovSakit = 0;
        $DecSakit = 0;

        $Sakit = [
            '',
            $JanSakit, $FebSakit, $MarSakit, $AprSakit,
            $MaySakit, $JunSakit, $JulSakit, $AugSakit,
            $SepSakit, $OctSakit, $NovSakit, $DecSakit
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Sakit[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Sakit')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Sakit Pegawai*/

        /*  Cuti Hamil Pegawai  */

        $JanHamil = 0;
        $FebHamil = 0;
        $MarHamil = 0;
        $AprHamil = 0;
        $MayHamil = 0;
        $JunHamil = 0;
        $JulHamil = 0;
        $AugHamil = 0;
        $SepHamil = 0;
        $OctHamil = 0;
        $NovHamil = 0;
        $DecHamil = 0;

        $Hamil = [
            '',
            $JanHamil, $FebHamil, $MarHamil, $AprHamil,
            $MayHamil, $JunHamil, $JulHamil, $AugHamil,
            $SepHamil, $OctHamil, $NovHamil, $DecHamil
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Hamil[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Hamil')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Hamil Pegawai*/

        /*Hitung Sisa Cuti*/

        $sisaTahunan = $batasTahunan - ($Tahunan[1] + $Tahunan[2] + $Tahunan[3] + $Tahunan[4] + $Tahunan[5] + $Tahunan[6] + $Tahunan[7] + $Tahunan[8] + $Tahunan[9] + $Tahunan[10] + $Tahunan[11] + $Tahunan[12]);
        $sisaBersama = $batasBersama - ($Bersama[1] + $Bersama[2] + $Bersama[3] + $Bersama[4] + $Bersama[5] + $Bersama[6] + $Bersama[7] + $Bersama[8] + $Bersama[9] + $Bersama[10] + $Bersama[11] + $Bersama[12]);
        $sisaPenting = $batasPenting - ($Penting[1] + $Penting[2] + $Penting[3] + $Penting[4] + $Penting[5] + $Penting[6] + $Penting[7] + $Penting[8] + $Penting[9] + $Penting[10] + $Penting[11] + $Penting[12]);
        $sisaBesar = $batasBesar - ($Besar[1] + $Besar[2] + $Besar[3] + $Besar[4] + $Besar[5] + $Besar[6] + $Besar[7] + $Besar[8] + $Besar[9] + $Besar[10] + $Besar[11] + $Besar[12]);
        $sisaSakit = $batasSakit - ($Sakit[1] + $Sakit[2] + $Sakit[3] + $Sakit[4] + $Sakit[5] + $Sakit[6] + $Sakit[7] + $Sakit[8] + $Sakit[9] + $Sakit[10] + $Sakit[11] + $Sakit[12]);
        $sisaHamil = $batasHamil - ($Hamil[1] + $Hamil[2] + $Hamil[3] + $Hamil[4] + $Hamil[5] + $Hamil[6] + $Hamil[7] + $Hamil[8] + $Hamil[9] + $Hamil[10] + $Hamil[11] + $Hamil[12]);

        /*End Hitung Sisa Cuti*/

        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('ket', "Alpha")
            ->count();

        $checkData = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->count();

        $pegawai = Pegawai::find($id);
        $hadir = ($hari - $alpha) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);
        $kehadiran = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->orderBy('tanggal', 'desc')
            ->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $cuti = Cuti::where('id_pegawai', $id)->orderBy('id', 'desc')->first();
        // dd($cuti);
        $bulanIni = $intMonth;

        /* Lama Kerja */
        $tgl_masuk = Auth::user()->tgl_masuk;
        $tgl_now = date("Y-m-d");

        $ts1 = strtotime($tgl_masuk);
        $ts2 = strtotime($tgl_now);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $lamaKerja = (($year2 - $year1) * 12) + ($month2 - $month1);

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;
        /* End Lama Kerja */




        /* Slip Gaji */

        $JanJun = ['Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06'];
        $JulDec = ['Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12'];

        /* End Slip Gaji */

        return view('staff.dashboard', [
            'pegawai' => $pegawai,
            'JanJun' => $JanJun,
            'JulDec' => $JulDec,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'kehadiran' => $kehadiran,
            'checkData' => $checkData,

            'cuti' => $cuti,

            'months' => $months,
            'bulanIni' => $bulanIni,
            'tahunIni' => $year,

            'peraturan' => $peraturan,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,


            'lamaKerja' => $lamaKerja,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,



        ]);
    }


    public function presensi(Request $request)
    {
        //
        $user = Auth::user();
        $id = $user->id;
        $intMonth = $request->month;
        $year = date('Y');
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, date('Y'));

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;


        /*  Cuti Tahunan Pegawai  */

        $JanTahunan = 0;
        $FebTahunan = 0;
        $MarTahunan = 0;
        $AprTahunan = 0;
        $MayTahunan = 0;
        $JunTahunan = 0;
        $JulTahunan = 0;
        $AugTahunan = 0;
        $SepTahunan = 0;
        $OctTahunan = 0;
        $NovTahunan = 0;
        $DecTahunan = 0;

        $Tahunan = [
            '',
            $JanTahunan, $FebTahunan, $MarTahunan, $AprTahunan,
            $MayTahunan, $JunTahunan, $JulTahunan, $AugTahunan,
            $SepTahunan, $OctTahunan, $NovTahunan, $DecTahunan
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Tahunan[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Tahunan')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Tahunan Pegawai*/


        /*  Cuti Bersama Pegawai  */

        $JanBersama = 0;
        $FebBersama = 0;
        $MarBersama = 0;
        $AprBersama = 0;
        $MayBersama = 0;
        $JunBersama = 0;
        $JulBersama = 0;
        $AugBersama = 0;
        $SepBersama = 0;
        $OctBersama = 0;
        $NovBersama = 0;
        $DecBersama = 0;

        $Bersama = [
            '',
            $JanBersama, $FebBersama, $MarBersama, $AprBersama,
            $MayBersama, $JunBersama, $JulBersama, $AugBersama,
            $SepBersama, $OctBersama, $NovBersama, $DecBersama
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Bersama[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Bersama')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Bersama Pegawai*/

        /*  Cuti Penting Pegawai  */

        $JanPenting = 0;
        $FebPenting = 0;
        $MarPenting = 0;
        $AprPenting = 0;
        $MayPenting = 0;
        $JunPenting = 0;
        $JulPenting = 0;
        $AugPenting = 0;
        $SepPenting = 0;
        $OctPenting = 0;
        $NovPenting = 0;
        $DecPenting = 0;

        $Penting = [
            '',
            $JanPenting, $FebPenting, $MarPenting, $AprPenting,
            $MayPenting, $JunPenting, $JulPenting, $AugPenting,
            $SepPenting, $OctPenting, $NovPenting, $DecPenting
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Penting[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Penting')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Penting Pegawai*/


        /*  Cuti Besar Pegawai  */

        $JanBesar = 0;
        $FebBesar = 0;
        $MarBesar = 0;
        $AprBesar = 0;
        $MayBesar = 0;
        $JunBesar = 0;
        $JulBesar = 0;
        $AugBesar = 0;
        $SepBesar = 0;
        $OctBesar = 0;
        $NovBesar = 0;
        $DecBesar = 0;

        $Besar = [
            '',
            $JanBesar, $FebBesar, $MarBesar, $AprBesar,
            $MayBesar, $JunBesar, $JulBesar, $AugBesar,
            $SepBesar, $OctBesar, $NovBesar, $DecBesar
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Besar[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Besar')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Besar Pegawai*/

        /*  Cuti Sakit Pegawai  */

        $JanSakit = 0;
        $FebSakit = 0;
        $MarSakit = 0;
        $AprSakit = 0;
        $MaySakit = 0;
        $JunSakit = 0;
        $JulSakit = 0;
        $AugSakit = 0;
        $SepSakit = 0;
        $OctSakit = 0;
        $NovSakit = 0;
        $DecSakit = 0;

        $Sakit = [
            '',
            $JanSakit, $FebSakit, $MarSakit, $AprSakit,
            $MaySakit, $JunSakit, $JulSakit, $AugSakit,
            $SepSakit, $OctSakit, $NovSakit, $DecSakit
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Sakit[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Sakit')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Sakit Pegawai*/

        /*  Cuti Hamil Pegawai  */

        $JanHamil = 0;
        $FebHamil = 0;
        $MarHamil = 0;
        $AprHamil = 0;
        $MayHamil = 0;
        $JunHamil = 0;
        $JulHamil = 0;
        $AugHamil = 0;
        $SepHamil = 0;
        $OctHamil = 0;
        $NovHamil = 0;
        $DecHamil = 0;

        $Hamil = [
            '',
            $JanHamil, $FebHamil, $MarHamil, $AprHamil,
            $MayHamil, $JunHamil, $JulHamil, $AugHamil,
            $SepHamil, $OctHamil, $NovHamil, $DecHamil
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Hamil[$i] = Cuti::where('id_pegawai', $user->id)
                ->whereYear('tgl_mulai', date("Y"))
                ->whereMonth('tgl_mulai', $i)
                ->where('tipe_cuti', 'Hamil')
                ->where('status', 'Disetujui HRD')
                ->count();
        }

        /*End Cuti Hamil Pegawai*/

        /*Hitung Sisa Cuti*/

        $sisaTahunan = $batasTahunan - ($Tahunan[1] + $Tahunan[2] + $Tahunan[3] + $Tahunan[4] + $Tahunan[5] + $Tahunan[6] + $Tahunan[7] + $Tahunan[8] + $Tahunan[9] + $Tahunan[10] + $Tahunan[11] + $Tahunan[12]);
        $sisaBersama = $batasBersama - ($Bersama[1] + $Bersama[2] + $Bersama[3] + $Bersama[4] + $Bersama[5] + $Bersama[6] + $Bersama[7] + $Bersama[8] + $Bersama[9] + $Bersama[10] + $Bersama[11] + $Bersama[12]);
        $sisaPenting = $batasPenting - ($Penting[1] + $Penting[2] + $Penting[3] + $Penting[4] + $Penting[5] + $Penting[6] + $Penting[7] + $Penting[8] + $Penting[9] + $Penting[10] + $Penting[11] + $Penting[12]);
        $sisaBesar = $batasBesar - ($Besar[1] + $Besar[2] + $Besar[3] + $Besar[4] + $Besar[5] + $Besar[6] + $Besar[7] + $Besar[8] + $Besar[9] + $Besar[10] + $Besar[11] + $Besar[12]);
        $sisaSakit = $batasSakit - ($Sakit[1] + $Sakit[2] + $Sakit[3] + $Sakit[4] + $Sakit[5] + $Sakit[6] + $Sakit[7] + $Sakit[8] + $Sakit[9] + $Sakit[10] + $Sakit[11] + $Sakit[12]);
        $sisaHamil = $batasHamil - ($Hamil[1] + $Hamil[2] + $Hamil[3] + $Hamil[4] + $Hamil[5] + $Hamil[6] + $Hamil[7] + $Hamil[8] + $Hamil[9] + $Hamil[10] + $Hamil[11] + $Hamil[12]);

        /*End Hitung Sisa Cuti*/

        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('ket', "Alpha")
            ->count();

        $checkData = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->count();


        $pegawai = Pegawai::find($id);
        $hadir = ($hari - $alpha) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);
        $kehadiran = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->orderBy('tanggal', 'desc')
            ->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $cuti = Cuti::where('id_pegawai', $id)->orderBy('created_at', 'desc')->first();
        // dd($cuti);
        $bulanIni = $intMonth;

        /* Lama Kerja */
        $tgl_masuk = Auth::user()->tgl_masuk;
        $tgl_now = date("Y-m-d");

        $ts1 = strtotime($tgl_masuk);
        $ts2 = strtotime($tgl_now);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $lamaKerja = (($year2 - $year1) * 12) + ($month2 - $month1);

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;
        /* End Lama Kerja */

        return view('staff.dashboard', [
            'pegawai' => $pegawai,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'kehadiran' => $kehadiran,
            'cuti' => $cuti,
            'checkData' => $checkData,

            'months' => $months,
            'bulanIni' => $bulanIni,
            'tahunIni' => $year,

            'peraturan' => $peraturan,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,

            'lamaKerja' => $lamaKerja,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,

        ]);
    }

    public function openFile($data)
    {

        $month = Crypt::decryptString($data);
        $path = public_path() . '\slip_gaji';
        $fileName = '\\' . Auth::user()->id . '_' . $month . '-' . date('Y') . '.pdf';
        $pathToFile = $path . $fileName;
        return response()->file($pathToFile);
        // dd($path . $fileName);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
