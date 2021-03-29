<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class StaffCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $peraturan = Peraturan::find(1);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        $thisYear = date("Y");


        //January//
        $JanTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();

        //End Of January//

        //Febuary//
        $FebTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $FebHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of Febuary//



        //March//
        $MarTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MarHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of March//


        //April//
        $AprTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AprHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of April//



        //May//
        $MayTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MaySakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MayHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of May//



        //June//
        $JunTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JunHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of June//



        //July//
        $JulTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JulHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of July//




        //August//
        $AugTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AugHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of August//


        //September//
        $SepTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $SepHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of September//




        //October//
        $OctTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $OctHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of October//



        //November//
        $NovTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $NovHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of November//



        //December//
        $DecTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $DecHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of December//

        $riwayatCuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', date("Y"))
            ->where('status', 'Disetujui HRD')
            ->get();


        $sisaTahunan = $batasTahunan - ($JanTahunan + $FebTahunan + $MarTahunan + $AprTahunan + $MayTahunan + $JunTahunan + $JulTahunan + $AugTahunan + $SepTahunan + $OctTahunan + $NovTahunan + $DecTahunan);
        $sisaBersama = $batasBersama - ($JanBersama + $FebBersama + $MarBersama + $AprBersama + $MayBersama + $JunBersama + $JulBersama + $AugBersama + $SepBersama + $OctBersama + $NovBersama + $DecBersama);
        $sisaPenting = $batasPenting - ($JanPenting + $FebPenting + $MarPenting + $AprPenting + $MayPenting + $JunPenting + $JulPenting + $AugPenting + $SepPenting + $OctPenting + $NovPenting + $DecPenting);
        $sisaBesar = $batasBesar - ($JanBesar + $FebBesar + $MarBesar + $AprBesar + $MayBesar + $JunBesar + $JulBesar + $AugBesar + $SepBesar + $OctBesar + $NovBesar + $DecBesar);
        $sisaSakit = $batasSakit - ($JanSakit + $FebSakit + $MarSakit + $AprSakit + $MaySakit + $JunSakit + $JulSakit + $AugSakit + $SepSakit + $OctSakit + $NovSakit + $DecSakit);
        $sisaHamil = $batasHamil - ($JanHamil + $FebHamil + $MarHamil + $AprHamil + $MayHamil + $JunHamil + $JulHamil + $AugHamil + $SepHamil + $OctHamil + $NovHamil + $DecHamil);


        $cuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->orderBy('tgl_pengajuan', 'desc')
            ->get();
        return view('staff.cuti.index', [
            'cuti' => $cuti,

            'thisYear' => $thisYear,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,

        ]);
    }


    public function tahunCuti(Request $request)
    {
        //
        $user = Auth::user();
        $peraturan = Peraturan::find(1);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        $thisYear = $request->tahun;


        //January//
        $JanTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();

        //End Of January//

        //Febuary//
        $FebTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $FebHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of Febuary//



        //March//
        $MarTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MarHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of March//


        //April//
        $AprTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AprHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of April//



        //May//
        $MayTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MaySakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MayHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of May//



        //June//
        $JunTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JunHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of June//



        //July//
        $JulTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JulHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of July//




        //August//
        $AugTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AugHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of August//


        //September//
        $SepTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $SepHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of September//




        //October//
        $OctTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $OctHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of October//



        //November//
        $NovTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $NovHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of November//



        //December//
        $DecTahunan = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBersama = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecPenting = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBesar = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecSakit = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $DecHamil = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of December//

        $riwayatCuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->where('status', 'Disetujui HRD')
            ->get();


        $sisaTahunan = $batasTahunan - ($JanTahunan + $FebTahunan + $MarTahunan + $AprTahunan + $MayTahunan + $JunTahunan + $JulTahunan + $AugTahunan + $SepTahunan + $OctTahunan + $NovTahunan + $DecTahunan);
        $sisaBersama = $batasBersama - ($JanBersama + $FebBersama + $MarBersama + $AprBersama + $MayBersama + $JunBersama + $JulBersama + $AugBersama + $SepBersama + $OctBersama + $NovBersama + $DecBersama);
        $sisaPenting = $batasPenting - ($JanPenting + $FebPenting + $MarPenting + $AprPenting + $MayPenting + $JunPenting + $JulPenting + $AugPenting + $SepPenting + $OctPenting + $NovPenting + $DecPenting);
        $sisaBesar = $batasBesar - ($JanBesar + $FebBesar + $MarBesar + $AprBesar + $MayBesar + $JunBesar + $JulBesar + $AugBesar + $SepBesar + $OctBesar + $NovBesar + $DecBesar);
        $sisaSakit = $batasSakit - ($JanSakit + $FebSakit + $MarSakit + $AprSakit + $MaySakit + $JunSakit + $JulSakit + $AugSakit + $SepSakit + $OctSakit + $NovSakit + $DecSakit);
        $sisaHamil = $batasHamil - ($JanHamil + $FebHamil + $MarHamil + $AprHamil + $MayHamil + $JunHamil + $JulHamil + $AugHamil + $SepHamil + $OctHamil + $NovHamil + $DecHamil);


        $cuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->orderBy('tgl_pengajuan', 'desc')
            ->get();
        return view('staff.cuti.index', [
            'cuti' => $cuti,

            'thisYear' => $thisYear,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,

        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $peraturan = Peraturan::find(1);

        $tgl_masuk = Auth::user()->tgl_masuk;
        $tgl_now = date("Y-m-d");

        $ts1 = strtotime($tgl_masuk);
        $ts2 = strtotime($tgl_now);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $months = (($year2 - $year1) * 12) + ($month2 - $month1);

        // $date1 = new DateTime($tgl_masuk);
        // $date2 = new DateTime($tgl_now);

        // $interval = $date1->diff($date2);

        // $months = $interval->m;
        // $years = $interval->y;

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;

        return view('staff.cuti.create', [
            'months' => $months,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_atasan = Auth::user()->id_atasan;
        $id_pegawai = Auth::user()->id;
        $nama_pegawai = Auth::user()->nama;


        if ($id_atasan == null) {

            $hrd = Pegawai::where('id_role', 2)->get();
            $this->validate($request, [
                'tipe_cuti' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'ket' => 'required',
            ]);

            Cuti::create([
                'id_pegawai' => $id_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
                'status' => "Disetujui Atasan",
                'tgl_disetujui_atasan' => date("Y-m-d"),
                'tgl_disetujui_hrd' => NULL,
                'tgl_ditolak_atasan' => NULL,
                'tgl_ditolak_hrd' => NULL,
            ]);

            $details = [
                'title' => 'Pengajuan Cuti Baru',
                'body' => "Hallo!! Pengajuan Cuti Baru dari $nama_pegawai sudah ada di SIPEGAWAI Nih!!",
                'data' => " Apabila Bapak/Ibu HRD Berkenan, silakan di cek lalu bisa ditolak atau disetujui ya!!"

            ];

            foreach ($hrd as $key => $p) {

                Mail::to($p->email)->send(new \App\Mail\PengajuanCutiMail($details));
            }


            Alert::success('success', ' Pengajuan Kamu Sedang Diproses!!');
            return redirect('staffCuti');
        } else {

            $email_atasan = Auth::user()->bawahan->email;
            $this->validate($request, [
                'tipe_cuti' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'ket' => 'required',
            ]);

            Cuti::create([
                'id_pegawai' => $id_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
                'status' => "Diproses",
                'tgl_disetujui_atasan' => NULL,
                'tgl_disetujui_hrd' => NULL,
                'tgl_ditolak_atasan' => NULL,
                'tgl_ditolak_hrd' => NULL,
            ]);

            $details = [
                'title' => 'Pengajuan Cuti Baru',
                'body' => "Hallo!! Pengajuan Cuti Baru dari $nama_pegawai yang merupakan subordinate anda sudah ada di SIPEGAWAI Nih!!",
                'data' => " Apabila Bapak/Ibu Berkenan, silakan di cek lalu bisa ditolak atau disetujui ya!!"

            ];


            Mail::to($email_atasan)->send(new \App\Mail\PengajuanCutiMail($details));


            Alert::success('success', ' Pengajuan Kamu Sedang Diproses!!');
            return redirect('staffCuti');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        //
        $id = Crypt::decryptString($data);
        $cuti = Cuti::find($id);

        return view('staff.cuti.details', [
            'cuti' => $cuti,
        ]);
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
