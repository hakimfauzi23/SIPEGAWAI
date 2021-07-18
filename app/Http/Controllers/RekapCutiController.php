<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RekapCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-cuti', ['all']);
    }


    public function index()
    {
        //
        $pegawai = Pegawai::paginate(20);
        return view('admin.rekapCuti.index', [
            'pegawai' => $pegawai,
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
    public function show($data)
    {
        //
        $id = Crypt::decryptString($data);
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $pegawai = Pegawai::find($id);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;

        $thisYear = date("Y");


        //January//
        $JanTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();

        //End Of January//

        //Febuary//
        $FebTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $FebHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of Febuary//



        //March//
        $MarTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MarHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of March//


        //April//
        $AprTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AprHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of April//



        //May//
        $MayTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MaySakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MayHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of May//



        //June//
        $JunTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JunHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of June//



        //July//
        $JulTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JulHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of July//




        //August//
        $AugTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AugHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of August//


        //September//
        $SepTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $SepHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of September//




        //October//
        $OctTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $OctHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of October//



        //November//
        $NovTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $NovHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of November//



        //December//
        $DecTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $DecHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of December//

        $riwayatCuti = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', date("Y"))
            ->where('status', 'Disetujui HRD')
            ->get();


        $sisaTahunan = $batasTahunan - ($JanTahunan + $FebTahunan + $MarTahunan + $AprTahunan + $MayTahunan + $JunTahunan + $JulTahunan + $AugTahunan + $SepTahunan + $OctTahunan + $NovTahunan + $DecTahunan);
        $sisaBersama = $batasBersama - ($JanBersama + $FebBersama + $MarBersama + $AprBersama + $MayBersama + $JunBersama + $JulBersama + $AugBersama + $SepBersama + $OctBersama + $NovBersama + $DecBersama);
        $sisaPenting = $batasPenting - ($JanPenting + $FebPenting + $MarPenting + $AprPenting + $MayPenting + $JunPenting + $JulPenting + $AugPenting + $SepPenting + $OctPenting + $NovPenting + $DecPenting);
        $sisaBesar = $batasBesar - ($JanBesar + $FebBesar + $MarBesar + $AprBesar + $MayBesar + $JunBesar + $JulBesar + $AugBesar + $SepBesar + $OctBesar + $NovBesar + $DecBesar);
        $sisaSakit = $batasSakit - ($JanSakit + $FebSakit + $MarSakit + $AprSakit + $MaySakit + $JunSakit + $JulSakit + $AugSakit + $SepSakit + $OctSakit + $NovSakit + $DecSakit);
        $sisaHamil = $batasHamil - ($JanHamil + $FebHamil + $MarHamil + $AprHamil + $MayHamil + $JunHamil + $JulHamil + $AugHamil + $SepHamil + $OctHamil + $NovHamil + $DecHamil);


        $id_pegawai = $data;
        return view('admin.rekapCuti.detail', [
            'id_pegawai' => $id_pegawai,
            'pegawai' => $pegawai,
            'riwayatCuti' => $riwayatCuti,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,

            'thisYear' => $thisYear,


            //Jan
            'JanTahunan' => $JanTahunan,
            'JanBersama' => $JanBersama,
            'JanPenting' => $JanPenting,
            'JanBesar' => $JanBesar,
            'JanSakit' => $JanSakit,
            'JanHamil' => $JanHamil,

            //Feb
            'FebTahunan' => $FebTahunan,
            'FebBersama' => $FebBersama,
            'FebPenting' => $FebPenting,
            'FebBesar' => $FebBesar,
            'FebSakit' => $FebSakit,
            'FebHamil' => $FebHamil,

            //March
            'MarTahunan' => $MarTahunan,
            'MarBersama' => $MarBersama,
            'MarPenting' => $MarPenting,
            'MarBesar' => $MarBesar,
            'MarSakit' => $MarSakit,
            'MarHamil' => $MarHamil,


            //April
            'AprTahunan' => $AprTahunan,
            'AprBersama' => $AprBersama,
            'AprPenting' => $AprPenting,
            'AprBesar' => $AprBesar,
            'AprSakit' => $AprSakit,
            'AprHamil' => $AprHamil,


            //May
            'MayTahunan' => $MayTahunan,
            'MayBersama' => $MayBersama,
            'MayPenting' => $MayPenting,
            'MayBesar' => $MayBesar,
            'MaySakit' => $MaySakit,
            'MayHamil' => $MayHamil,


            //June
            'JunTahunan' => $JunTahunan,
            'JunBersama' => $JunBersama,
            'JunPenting' => $JunPenting,
            'JunBesar' => $JunBesar,
            'JunSakit' => $JunSakit,
            'JunHamil' => $JunHamil,

            //July
            'JulTahunan' => $JulTahunan,
            'JulBersama' => $JulBersama,
            'JulPenting' => $JulPenting,
            'JulBesar' => $JulBesar,
            'JulSakit' => $JulSakit,
            'JulHamil' => $JulHamil,


            //August
            'AugTahunan' => $AugTahunan,
            'AugBersama' => $AugBersama,
            'AugPenting' => $AugPenting,
            'AugBesar' => $AugBesar,
            'AugSakit' => $AugSakit,
            'AugHamil' => $AugHamil,


            //September
            'SepTahunan' => $SepTahunan,
            'SepBersama' => $SepBersama,
            'SepPenting' => $SepPenting,
            'SepBesar' => $SepBesar,
            'SepSakit' => $SepSakit,
            'SepHamil' => $SepHamil,


            //October
            'OctTahunan' => $OctTahunan,
            'OctBersama' => $OctBersama,
            'OctPenting' => $OctPenting,
            'OctBesar' => $OctBesar,
            'OctSakit' => $OctSakit,
            'OctHamil' => $OctHamil,


            //November
            'NovTahunan' => $NovTahunan,
            'NovBersama' => $NovBersama,
            'NovPenting' => $NovPenting,
            'NovBesar' => $NovBesar,
            'NovSakit' => $NovSakit,
            'NovHamil' => $NovHamil,


            //December
            'DecTahunan' => $DecTahunan,
            'DecBersama' => $DecBersama,
            'DecPenting' => $DecPenting,
            'DecBesar' => $DecBesar,
            'DecSakit' => $DecSakit,
            'DecHamil' => $DecHamil,

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





    public function showYear(Request $request, $data)
    {
        //
        $id = Crypt::decryptString($data);

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $pegawai = Pegawai::find($id);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;

        $thisYear = $request->year;



        //January//
        $JanTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JanHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 1)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();

        //End Of January//

        //Febuary//
        $FebTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $FebSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $FebHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 2)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of Febuary//



        //March//
        $MarTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MarSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MarHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 3)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of March//


        //April//
        $AprTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AprSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AprHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 4)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of April//



        //May//
        $MayTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MayBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $MaySakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $MayHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 5)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of May//



        //June//
        $JunTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JunSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JunHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 6)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of June//



        //July//
        $JulTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $JulSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $JulHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 7)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of July//




        //August//
        $AugTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $AugSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $AugHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 8)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of August//


        //September//
        $SepTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $SepSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $SepHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 9)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of September//




        //October//
        $OctTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $OctSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $OctHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 10)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of October//



        //November//
        $NovTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $NovSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $NovHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 11)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of November//



        //December//
        $DecTahunan = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBersama = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecPenting = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecBesar = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $DecSakit = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();


        $DecHamil = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->whereMonth('tgl_mulai', 12)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();
        //End Of December//

        $riwayatCuti = Cuti::where('id_pegawai', $id)
            ->whereYear('tgl_mulai', $thisYear)
            ->where('status', 'Disetujui HRD')
            ->get();


        $sisaTahunan = $batasTahunan - ($JanTahunan + $FebTahunan + $MarTahunan + $AprTahunan + $MayTahunan + $JunTahunan + $JulTahunan + $AugTahunan + $SepTahunan + $OctTahunan + $NovTahunan + $DecTahunan);
        $sisaBersama = $batasBersama - ($JanBersama + $FebBersama + $MarBersama + $AprBersama + $MayBersama + $JunBersama + $JulBersama + $AugBersama + $SepBersama + $OctBersama + $NovBersama + $DecBersama);
        $sisaPenting = $batasPenting - ($JanPenting + $FebPenting + $MarPenting + $AprPenting + $MayPenting + $JunPenting + $JulPenting + $AugPenting + $SepPenting + $OctPenting + $NovPenting + $DecPenting);
        $sisaBesar = $batasBesar - ($JanBesar + $FebBesar + $MarBesar + $AprBesar + $MayBesar + $JunBesar + $JulBesar + $AugBesar + $SepBesar + $OctBesar + $NovBesar + $DecBesar);
        $sisaSakit = $batasSakit - ($JanSakit + $FebSakit + $MarSakit + $AprSakit + $MaySakit + $JunSakit + $JulSakit + $AugSakit + $SepSakit + $OctSakit + $NovSakit + $DecSakit);
        $sisaHamil = $batasHamil - ($JanHamil + $FebHamil + $MarHamil + $AprHamil + $MayHamil + $JunHamil + $JulHamil + $AugHamil + $SepHamil + $OctHamil + $NovHamil + $DecHamil);


        $id_pegawai = $data;

        return view('admin.rekapCuti.detail', [
            'id_pegawai' => $id_pegawai,
            'pegawai' => $pegawai,
            'riwayatCuti' => $riwayatCuti,

            'sisaTahunan' => $sisaTahunan,
            'sisaBersama' => $sisaBersama,
            'sisaPenting' => $sisaPenting,
            'sisaBesar' => $sisaBesar,
            'sisaSakit' => $sisaSakit,
            'sisaHamil' => $sisaHamil,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,


            'thisYear' => $thisYear,



            //Jan
            'JanTahunan' => $JanTahunan,
            'JanBersama' => $JanBersama,
            'JanPenting' => $JanPenting,
            'JanBesar' => $JanBesar,
            'JanSakit' => $JanSakit,
            'JanHamil' => $JanHamil,

            //Feb
            'FebTahunan' => $FebTahunan,
            'FebBersama' => $FebBersama,
            'FebPenting' => $FebPenting,
            'FebBesar' => $FebBesar,
            'FebSakit' => $FebSakit,
            'FebHamil' => $FebHamil,

            //March
            'MarTahunan' => $MarTahunan,
            'MarBersama' => $MarBersama,
            'MarPenting' => $MarPenting,
            'MarBesar' => $MarBesar,
            'MarSakit' => $MarSakit,
            'MarHamil' => $MarHamil,


            //April
            'AprTahunan' => $AprTahunan,
            'AprBersama' => $AprBersama,
            'AprPenting' => $AprPenting,
            'AprBesar' => $AprBesar,
            'AprSakit' => $AprSakit,
            'AprHamil' => $AprHamil,


            //May
            'MayTahunan' => $MayTahunan,
            'MayBersama' => $MayBersama,
            'MayPenting' => $MayPenting,
            'MayBesar' => $MayBesar,
            'MaySakit' => $MaySakit,
            'MayHamil' => $MayHamil,


            //June
            'JunTahunan' => $JunTahunan,
            'JunBersama' => $JunBersama,
            'JunPenting' => $JunPenting,
            'JunBesar' => $JunBesar,
            'JunSakit' => $JunSakit,
            'JunHamil' => $JunHamil,

            //July
            'JulTahunan' => $JulTahunan,
            'JulBersama' => $JulBersama,
            'JulPenting' => $JulPenting,
            'JulBesar' => $JulBesar,
            'JulSakit' => $JulSakit,
            'JulHamil' => $JulHamil,


            //August
            'AugTahunan' => $AugTahunan,
            'AugBersama' => $AugBersama,
            'AugPenting' => $AugPenting,
            'AugBesar' => $AugBesar,
            'AugSakit' => $AugSakit,
            'AugHamil' => $AugHamil,


            //September
            'SepTahunan' => $SepTahunan,
            'SepBersama' => $SepBersama,
            'SepPenting' => $SepPenting,
            'SepBesar' => $SepBesar,
            'SepSakit' => $SepSakit,
            'SepHamil' => $SepHamil,


            //October
            'OctTahunan' => $OctTahunan,
            'OctBersama' => $OctBersama,
            'OctPenting' => $OctPenting,
            'OctBesar' => $OctBesar,
            'OctSakit' => $OctSakit,
            'OctHamil' => $OctHamil,


            //November
            'NovTahunan' => $NovTahunan,
            'NovBersama' => $NovBersama,
            'NovPenting' => $NovPenting,
            'NovBesar' => $NovBesar,
            'NovSakit' => $NovSakit,
            'NovHamil' => $NovHamil,


            //December
            'DecTahunan' => $DecTahunan,
            'DecBersama' => $DecBersama,
            'DecPenting' => $DecPenting,
            'DecBesar' => $DecBesar,
            'DecSakit' => $DecSakit,
            'DecHamil' => $DecHamil,

        ]);
    }
}
