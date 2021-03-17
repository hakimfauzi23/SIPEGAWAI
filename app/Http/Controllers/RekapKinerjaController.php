<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RekapKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        $id_pegawai = Crypt::decryptString($data);
        $pegawai = Pegawai::find($id_pegawai);
        $hari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $kehadiran = Presensi_harian::where('id_pegawai', $id_pegawai)
            ->whereMonth('tanggal', date("m"))
            ->where('ket', '==', 'Alpha')
            ->count();


        $presensiTdkHadir = Presensi_harian::where('id_pegawai', $id_pegawai)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', date('m'))
            ->orderBy('tanggal', 'desc')
            ->paginate(3, ['*'], 'presensi');

        $hadir = ($hari - $kehadiran) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);

        //Cuti
        $tahunan = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui')
            ->count();

        $besar = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui')
            ->count();

        $bersama = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui')
            ->count();

        $hamil = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui')
            ->count();

        $sakit = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui')
            ->count();

        $penting = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui')
            ->count();

        $cuti = Cuti::sortable()
            ->where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('status', 'Disetujui')
            ->orderBy('tgl_mulai', 'desc')
            ->paginate(3, ['*'], 'cuti');




        // dd($tahunan);


        return view('admin.rekapKinerja.details', [
            'presensiTdkHadir' => $presensiTdkHadir,
            'id_pegawai' => $data,
            'pegawai' => $pegawai,
            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,

            //Cuti
            'tahunan' => $tahunan,
            'besar' => $besar,
            'bersama' => $bersama,
            'hamil' => $hamil,
            'sakit' => $sakit,
            'penting' => $penting,
            'cuti' => $cuti,
        ]);

        // dd($persentaseHadir);
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
