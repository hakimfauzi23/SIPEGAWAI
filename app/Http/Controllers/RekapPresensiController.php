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

    function __construct()
    {
        $this->middleware('permission:menu-presensi', ['all']);
    }

    public function index()
    {
        //
        $pegawai = Pegawai::paginate(20);
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
        $intMonth = date('m');
        $year = date('Y');
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, date('Y'));
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $jam_masuk = $peraturan->jam_masuk;
        $jam_plg = $peraturan->jam_plg;


        $telat = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_dtg', '>', $jam_masuk)
            ->count();

        $tepatWaktu = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_dtg', '<', $jam_masuk)
            ->where('jam_plg', '>', $jam_plg)
            ->count();

        $pulangAwal = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_plg', '<', $jam_plg)
            ->count();

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

        $riwayatTdkHadir = Presensi_harian::where('id_pegawai', $id)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->orderBy('tanggal', 'desc')
            ->get();

        $riwayatTdkDisiplin = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where(function ($query) use ($jam_masuk, $jam_plg) {
                $query->where('jam_dtg', '>', $jam_masuk)
                    ->orWhere('jam_plg', '<', $jam_plg);
            })->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $bulanIni = $intMonth;

        return view('admin.rekapPresensi.detail', [
            'pegawai' => $pegawai,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'riwayatTdkHadir' => $riwayatTdkHadir,


            'checkData' => $checkData,

            'telat' => $telat,
            'tepatWaktu' => $tepatWaktu,
            'pulangAwal' => $pulangAwal,
            'riwayatTdkDisiplin' => $riwayatTdkDisiplin,


            'jam_masuk' => $jam_masuk,
            'jam_plg' => $jam_plg,


            'months' => $months,
            'bulanIni' => $bulanIni,
            'tahunIni' => $year,

        ]);
    }

    public function search(Request $request, $data)
    {
        //
        $id = Crypt::decryptString($data);
        $intMonth = $request->month;
        $year = $request->year;
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, $year);

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $jam_masuk = $peraturan->jam_masuk;
        $jam_plg = $peraturan->jam_plg;


        $telat = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_dtg', '>', $jam_masuk)
            ->count();

        $tepatWaktu = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_dtg', '<', $jam_masuk)
            ->where('jam_plg', '>', $jam_plg)
            ->count();

        $pulangAwal = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('jam_plg', '<', $jam_plg)
            ->count();

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

        $riwayatTdkHadir = Presensi_harian::where('id_pegawai', $id)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->orderBy('tanggal', 'desc')
            ->get();

        $riwayatTdkDisiplin = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where(function ($query) use ($jam_masuk, $jam_plg) {
                $query->where('jam_dtg', '>', $jam_masuk)
                    ->orWhere('jam_plg', '<', $jam_plg);
            })->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $bulanIni = $intMonth;

        return view('admin.rekapPresensi.detail', [
            'pegawai' => $pegawai,

            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'riwayatTdkHadir' => $riwayatTdkHadir,


            'checkData' => $checkData,

            'telat' => $telat,
            'tepatWaktu' => $tepatWaktu,
            'pulangAwal' => $pulangAwal,
            'riwayatTdkDisiplin' => $riwayatTdkDisiplin,


            'jam_masuk' => $jam_masuk,
            'jam_plg' => $jam_plg,


            'months' => $months,
            'bulanIni' => $bulanIni,
            'tahunIni' => $year,

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
