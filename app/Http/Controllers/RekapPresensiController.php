<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RekapPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pegawai = Pegawai::all();
        return view('admin.rekapPresensi.index', [
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
        $hari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $peraturan = Peraturan::find(1);
        $jam_masuk = $peraturan->jam_masuk;
        $jam_plg = $peraturan->jam_plg;



        $telat = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date("m"))
            ->where('jam_dtg', '>', $jam_masuk)
            ->count();

        $tepatWaktu = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date("m"))
            ->where('jam_dtg', '<', $jam_masuk)
            ->where('jam_plg', '>', $jam_plg)
            ->count();

        $pulangAwal = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date("m"))
            ->where('jam_plg', '<', $jam_plg)
            ->count();

        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date("m"))
            ->where('ket', "Alpha")
            ->count();


        $pegawai = Pegawai::find($id);
        $hadir = ($hari - $alpha) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);

        $riwayatTdkHadir = Presensi_harian::where('id_pegawai', $id)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', date('m'))
            ->orderBy('tanggal', 'desc')
            ->get();

        $riwayatTdkDisiplin = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m'))
            ->where(function ($query) use ($jam_masuk, $jam_plg) {
                $query->where('jam_dtg', '>', $jam_masuk)
                    ->orWhere('jam_plg', '<', $jam_plg);
            })->get();

        $months = [
            'January', 'Febuary', 'March',
            'April', 'May', 'June',
            'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        $bulanIni = date("F");

        return view('admin.rekapPresensi.detail', [
            'pegawai' => $pegawai,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'riwayatTdkHadir' => $riwayatTdkHadir,


            'telat' => $telat,
            'tepatWaktu' => $tepatWaktu,
            'pulangAwal' => $pulangAwal,
            'riwayatTdkDisiplin' => $riwayatTdkDisiplin,


            'jam_masuk' => $jam_masuk,
            'jam_plg' => $jam_plg,


            'months' => $months,
            'bulanIni' => $bulanIni,

        ]);
    }

    public function showMonth($data, $thisMonth, $intMonth)
    {
        //
        $id = Crypt::decryptString($data);
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, date('Y'));
        $peraturan = Peraturan::find(1);
        $jam_masuk = $peraturan->jam_masuk;
        $jam_plg = $peraturan->jam_plg;


        $telat = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->where('jam_dtg', '>', $jam_masuk)
            ->count();

        $tepatWaktu = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->where('jam_dtg', '<', $jam_masuk)
            ->where('jam_plg', '>', $jam_plg)
            ->count();

        $pulangAwal = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->where('jam_plg', '<', $jam_plg)
            ->count();

        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->where('ket', "Alpha")
            ->count();


        $pegawai = Pegawai::find($id);
        $hadir = ($hari - $alpha) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);

        $riwayatTdkHadir = Presensi_harian::where('id_pegawai', $id)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', $intMonth)
            ->orderBy('tanggal', 'desc')
            ->get();

        $riwayatTdkDisiplin = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->where(function ($query) use ($jam_masuk, $jam_plg) {
                $query->where('jam_dtg', '>', $jam_masuk)
                    ->orWhere('jam_plg', '<', $jam_plg);
            })->get();

        $months = [
            'January', 'Febuary', 'March',
            'April', 'May', 'June',
            'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        $bulanIni = $thisMonth;

        return view('admin.rekapPresensi.detail', [
            'pegawai' => $pegawai,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'riwayatTdkHadir' => $riwayatTdkHadir,


            'telat' => $telat,
            'tepatWaktu' => $tepatWaktu,
            'pulangAwal' => $pulangAwal,
            'riwayatTdkDisiplin' => $riwayatTdkDisiplin,


            'jam_masuk' => $jam_masuk,
            'jam_plg' => $jam_plg,


            'months' => $months,
            'bulanIni' => $bulanIni,

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
