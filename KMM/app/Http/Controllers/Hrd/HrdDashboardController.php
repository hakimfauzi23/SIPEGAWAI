<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HrdDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $peraturan = Peraturan::find(1);
        $bulanIni = date('m');

        /*  Get ID PEGAWAI YANG SERING CUTI   */

        $pegawaiSrgCuti = DB::table('cuti')
            ->whereYear('tgl_mulai', date("Y"))
            ->where('status', 'Disetujui HRD')
            ->groupBy('id_pegawai')
            ->orderByRaw('count(*) DESC')
            ->pluck('id_pegawai');

        // dd($pegawaiSrgCuti);
        /*  Get ID PEGAWAI YANG SERING TERLAMBAT   */
        $pegawaiSrgTelat = DB::table('presensi_harian')
            ->whereYear('tanggal', date("Y"))
            ->where('jam_dtg', '>', $peraturan->jam_masuk)
            ->groupBy('id_pegawai')
            ->orderByRaw('count(*) DESC')
            ->pluck('id_pegawai');

        $JmlHadir = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Hadir')->count();
        $JmlCuti = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Cuti')->count();
        $JmlAlpha = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Alpha')->count();

        $pegawaiCuti = Pegawai::whereIn('id', $pegawaiSrgCuti)->paginate(3);
        $pegawaiTelat = Pegawai::whereIn('id', $pegawaiSrgTelat)->paginate(3);
        $cuti = Presensi_harian::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('ket', '=', 'Cuti')->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];


        /*  Jml Telat Semua Pegawai   */
        $JanTelat = 0;
        $FebTelat = 0;
        $MarTelat = 0;
        $AprTelat = 0;
        $MayTelat = 0;
        $JunTelat = 0;
        $JulTelat = 0;
        $AugTelat = 0;
        $SepTelat = 0;
        $OctTelat = 0;
        $NovTelat = 0;
        $DecTelat = 0;

        $Telat = [
            '',
            $JanTelat, $FebTelat, $MarTelat, $AprTelat,
            $MayTelat, $JunTelat, $JulTelat, $AugTelat,
            $SepTelat, $OctTelat, $NovTelat, $DecTelat,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Telat[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_dtg', '>', $peraturan->jam_masuk)
                ->count();
        }
        /*End Jml Telat Semua Pegawai*/


        /*  Jml Tepat Semua Pegawai   */
        $JanTepat = 0;
        $FebTepat = 0;
        $MarTepat = 0;
        $AprTepat = 0;
        $MayTepat = 0;
        $JunTepat = 0;
        $JulTepat = 0;
        $AugTepat = 0;
        $SepTepat = 0;
        $OctTepat = 0;
        $NovTepat = 0;
        $DecTepat = 0;

        $Tepat = [
            '',
            $JanTepat, $FebTepat, $MarTepat, $AprTepat,
            $MayTepat, $JunTepat, $JulTepat, $AugTepat,
            $SepTepat, $OctTepat, $NovTepat, $DecTepat,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Tepat[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_dtg', '<', $peraturan->jam_masuk)
                ->count();
        }
        /*End Jml Tepat Semua Pegawai*/

        /*  Jml Awal Semua Pegawai   */
        $JanAwal = 0;
        $FebAwal = 0;
        $MarAwal = 0;
        $AprAwal = 0;
        $MayAwal = 0;
        $JunAwal = 0;
        $JulAwal = 0;
        $AugAwal = 0;
        $SepAwal = 0;
        $OctAwal = 0;
        $NovAwal = 0;
        $DecAwal = 0;

        $Awal = [
            '',
            $JanAwal, $FebAwal, $MarAwal, $AprAwal,
            $MayAwal, $JunAwal, $JulAwal, $AugAwal,
            $SepAwal, $OctAwal, $NovAwal, $DecAwal,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Awal[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_plg', '<', $peraturan->jam_plg)
                ->count();
        }
        /*End Jml Awal Semua Pegawai*/

        return view('hrd.dashboard', [
            'cuti' => $cuti,
            'pegawaiCuti' => $pegawaiCuti,
            'pegawaiTelat' => $pegawaiTelat,

            'JmlCuti' => $JmlCuti,
            'JmlAlpha' => $JmlAlpha,
            'JmlHadir' => $JmlHadir,

            'months' => $months,
            'bulanIni' => $bulanIni,


            'JanTelat' => $Telat[1],
            'FebTelat' => $Telat[2],
            'MarTelat' => $Telat[3],
            'AprTelat' => $Telat[4],
            'MayTelat' => $Telat[5],
            'JunTelat' => $Telat[6],
            'JulTelat' => $Telat[7],
            'AugTelat' => $Telat[8],
            'SepTelat' => $Telat[9],
            'OctTelat' => $Telat[10],
            'NovTelat' => $Telat[11],
            'DecTelat' => $Telat[12],

            'JanTepat' => $Tepat[1],
            'FebTepat' => $Tepat[2],
            'MarTepat' => $Tepat[3],
            'AprTepat' => $Tepat[4],
            'MayTepat' => $Tepat[5],
            'JunTepat' => $Tepat[6],
            'JulTepat' => $Tepat[7],
            'AugTepat' => $Tepat[8],
            'SepTepat' => $Tepat[9],
            'OctTepat' => $Tepat[10],
            'NovTepat' => $Tepat[11],
            'DecTepat' => $Tepat[12],

            'JanAwal' => $Awal[1],
            'FebAwal' => $Awal[2],
            'MarAwal' => $Awal[3],
            'AprAwal' => $Awal[4],
            'MayAwal' => $Awal[5],
            'JunAwal' => $Awal[6],
            'JulAwal' => $Awal[7],
            'AugAwal' => $Awal[8],
            'SepAwal' => $Awal[9],
            'OctAwal' => $Awal[10],
            'NovAwal' => $Awal[11],
            'DecAwal' => $Awal[12],


        ]);
    }

    public function kehadiran(Request $request)
    {
        //
        $peraturan = Peraturan::find(1);
        $bulanIni = $request->month;

        /*  Get ID PEGAWAI YANG SERING CUTI   */

        $pegawaiSrgCuti = DB::table('cuti')
            ->whereYear('tgl_mulai', date("Y"))
            ->groupBy('id_pegawai')
            ->orderByRaw('count(*) DESC')
            ->pluck('id_pegawai');


        /*  Get ID PEGAWAI YANG SERING TERLAMBAT   */
        $pegawaiSrgTelat = DB::table('presensi_harian')
            ->whereYear('tanggal', date("Y"))
            ->where('jam_dtg', '>', $peraturan->jam_masuk)
            ->groupBy('id_pegawai')
            ->orderByRaw('count(*) DESC')
            ->pluck('id_pegawai');

        $JmlHadir = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Hadir')->count();
        $JmlCuti = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Cuti')->count();
        $JmlAlpha = Presensi_harian::whereMonth('tanggal', $bulanIni)
            ->where('ket', 'Alpha')->count();

        $pegawaiCuti = Pegawai::whereIn('id', $pegawaiSrgCuti)->paginate(3);
        $pegawaiTelat = Pegawai::whereIn('id', $pegawaiSrgTelat)->paginate(3);
        $cuti = Presensi_harian::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('ket', '=', 'Cuti')->get();

        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];


        /*  Jml Telat Semua Pegawai   */
        $JanTelat = 0;
        $FebTelat = 0;
        $MarTelat = 0;
        $AprTelat = 0;
        $MayTelat = 0;
        $JunTelat = 0;
        $JulTelat = 0;
        $AugTelat = 0;
        $SepTelat = 0;
        $OctTelat = 0;
        $NovTelat = 0;
        $DecTelat = 0;

        $Telat = [
            '',
            $JanTelat, $FebTelat, $MarTelat, $AprTelat,
            $MayTelat, $JunTelat, $JulTelat, $AugTelat,
            $SepTelat, $OctTelat, $NovTelat, $DecTelat,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Telat[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_dtg', '>', $peraturan->jam_masuk)
                ->count();
        }
        /*End Jml Telat Semua Pegawai*/


        /*  Jml Tepat Semua Pegawai   */
        $JanTepat = 0;
        $FebTepat = 0;
        $MarTepat = 0;
        $AprTepat = 0;
        $MayTepat = 0;
        $JunTepat = 0;
        $JulTepat = 0;
        $AugTepat = 0;
        $SepTepat = 0;
        $OctTepat = 0;
        $NovTepat = 0;
        $DecTepat = 0;

        $Tepat = [
            '',
            $JanTepat, $FebTepat, $MarTepat, $AprTepat,
            $MayTepat, $JunTepat, $JulTepat, $AugTepat,
            $SepTepat, $OctTepat, $NovTepat, $DecTepat,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Tepat[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_dtg', '<', $peraturan->jam_masuk)
                ->count();
        }
        /*End Jml Tepat Semua Pegawai*/

        /*  Jml Awal Semua Pegawai   */
        $JanAwal = 0;
        $FebAwal = 0;
        $MarAwal = 0;
        $AprAwal = 0;
        $MayAwal = 0;
        $JunAwal = 0;
        $JulAwal = 0;
        $AugAwal = 0;
        $SepAwal = 0;
        $OctAwal = 0;
        $NovAwal = 0;
        $DecAwal = 0;

        $Awal = [
            '',
            $JanAwal, $FebAwal, $MarAwal, $AprAwal,
            $MayAwal, $JunAwal, $JulAwal, $AugAwal,
            $SepAwal, $OctAwal, $NovAwal, $DecAwal,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Awal[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->where('jam_plg', '<', $peraturan->jam_plg)
                ->count();
        }
        /*End Jml Awal Semua Pegawai*/

        return view('hrd.dashboard', [
            'cuti' => $cuti,
            'pegawaiCuti' => $pegawaiCuti,
            'pegawaiTelat' => $pegawaiTelat,

            'JmlCuti' => $JmlCuti,
            'JmlAlpha' => $JmlAlpha,
            'JmlHadir' => $JmlHadir,

            'months' => $months,
            'bulanIni' => $bulanIni,


            'JanTelat' => $Telat[1],
            'FebTelat' => $Telat[2],
            'MarTelat' => $Telat[3],
            'AprTelat' => $Telat[4],
            'MayTelat' => $Telat[5],
            'JunTelat' => $Telat[6],
            'JulTelat' => $Telat[7],
            'AugTelat' => $Telat[8],
            'SepTelat' => $Telat[9],
            'OctTelat' => $Telat[10],
            'NovTelat' => $Telat[11],
            'DecTelat' => $Telat[12],

            'JanTepat' => $Tepat[1],
            'FebTepat' => $Tepat[2],
            'MarTepat' => $Tepat[3],
            'AprTepat' => $Tepat[4],
            'MayTepat' => $Tepat[5],
            'JunTepat' => $Tepat[6],
            'JulTepat' => $Tepat[7],
            'AugTepat' => $Tepat[8],
            'SepTepat' => $Tepat[9],
            'OctTepat' => $Tepat[10],
            'NovTepat' => $Tepat[11],
            'DecTepat' => $Tepat[12],

            'JanAwal' => $Awal[1],
            'FebAwal' => $Awal[2],
            'MarAwal' => $Awal[3],
            'AprAwal' => $Awal[4],
            'MayAwal' => $Awal[5],
            'JunAwal' => $Awal[6],
            'JulAwal' => $Awal[7],
            'AugAwal' => $Awal[8],
            'SepAwal' => $Awal[9],
            'OctAwal' => $Awal[10],
            'NovAwal' => $Awal[11],
            'DecAwal' => $Awal[12],


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
