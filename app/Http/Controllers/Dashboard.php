<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Perusahaan;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dashboard-admin', ['all']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $bulanIni = date('m');

        $pegawai = Pegawai::all();
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $cuti = Cuti::all();
        $presensi = Presensi_harian::all();

        $pegawai_bulan = Pegawai::whereMonth('created_at', $bulanIni)->get();
        $cuti_bulan = Cuti::whereMonth('created_at', $bulanIni)->get();
        $presensi_bulan = Presensi_harian::whereMonth('created_at', $bulanIni)->get();
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $perusahaan = Perusahaan::all()->count();

        return view('admin.dashboard', [
            'jml_pegawai' => $pegawai->count(),
            'jml_divisi' => $divisi->count(),
            'jml_jabatan' => $jabatan->count(),
            'jml_cuti' => $cuti->count(),
            'jml_presensi' => $presensi->count(),

            'pegawai_bulan' => $pegawai_bulan->count(),
            'cuti_bulan' => $cuti_bulan->count(),
            'presensi_bulan' => $presensi_bulan->count(),


            'peraturan' => $peraturan,
            'months' => $months,


            'bulanIni' => $bulanIni,
            'perusahaan' => $perusahaan,
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

        $bulanIni = $request->month;

        $pegawai = Pegawai::all();
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $cuti = Cuti::all();
        $presensi = Presensi_harian::all();

        $pegawai_bulan = Pegawai::whereMonth('created_at', $bulanIni)->get();
        $cuti_bulan = Cuti::whereMonth('created_at', $bulanIni)->get();
        $presensi_bulan = Presensi_harian::whereMonth('created_at', $bulanIni)->get();

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $perusahaan = Perusahaan::all()->count();

        return view('admin.dashboard', [
            'jml_pegawai' => $pegawai->count(),
            'jml_divisi' => $divisi->count(),
            'jml_jabatan' => $jabatan->count(),
            'jml_cuti' => $cuti->count(),
            'jml_presensi' => $presensi->count(),

            'pegawai_bulan' => $pegawai_bulan->count(),
            'cuti_bulan' => $cuti_bulan->count(),
            'presensi_bulan' => $presensi_bulan->count(),


            'peraturan' => $peraturan,
            'months' => $months,


            'bulanIni' => $bulanIni,
            'perusahaan' => $perusahaan,

        ]);
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
