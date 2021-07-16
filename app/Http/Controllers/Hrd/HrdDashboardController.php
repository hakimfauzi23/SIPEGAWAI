<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\PenilaianPegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use App\Models\SuratPeringatan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class HrdDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:dashboard-hrd', ['all']);
    }

    public function index()
    {
        //
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $bulanIni = date('m');

        /*  Get ID PEGAWAI YANG SERING CUTI   */

        $pegawaiSrgCuti = DB::table('cuti')
            ->whereYear('tgl_mulai', date("Y"))
            ->where('status', 'Disetujui HRD')
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


        /*  PEGAWAI YANG SEDANG DALAM PENGAWASAN   */
        $date = date("Y-m-d");
        $myDate = date_create($date);
        date_sub($myDate, date_interval_create_from_date_string('3 month'));
        $selisihBulan = date_format($myDate, 'Y-m-d');

        $pegawaiDlmPengawasan = SuratPeringatan::whereIn('id', function ($query) use ($selisihBulan) {
            $query->select('*')
                ->from('surat_peringatan')
                ->where('tanggal', '>', $selisihBulan)
                ->where('tingkat', '!=', 'III')
                ->select(DB::raw('MAX(id)'))
                ->groupBy('id_pegawai');
        })->get();
        /* END PEGAWAI YG SEDANG DALAM PENGAWASAN */

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

        /* Jml data Presensi bulan ini */
        for ($i = 1; $i <= 12; $i++) {
            $JmlData[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->count();
        }

        $JmlDataBulanIni = Presensi_harian::whereYear('tanggal', date('Y'))
            ->whereMonth('tanggal', $bulanIni)
            ->count();
        /* End Jml data Presensi bulan ini */


        /* Get Pegawai WFH hari ini */

        $pegWfh = Presensi_harian::where('tanggal', date('Y-m-d'))
            ->where('ket', 'Hadir')
            ->where('is_wfh', 1)->get();

        /* End Get Pegawai WFH hari ini */

        /* Get top 10 Pegawai */
        $top10 = PenilaianPegawai::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'))
            ->orderBy('final_value', 'DESC')
            ->paginate(10);
        /* End Get top 10 Pegawai */

        return view('hrd.dashboard', [
            'cuti' => $cuti,
            'pegawaiCuti' => $pegawaiCuti,
            'pegawaiTelat' => $pegawaiTelat,
            'pegawaiDlmPengawasan' => $pegawaiDlmPengawasan,
            'pegWfh' => $pegWfh,
            'top10' => $top10,

            'JmlCuti' => number_format(($JmlDataBulanIni != 0 ? (($JmlCuti / $JmlDataBulanIni) * 100) : 0), 2),
            'JmlAlpha' => number_format(($JmlDataBulanIni != 0 ? (($JmlAlpha / $JmlDataBulanIni) * 100) : 0), 2),
            'JmlHadir' => number_format(($JmlDataBulanIni != 0 ? (($JmlHadir / $JmlDataBulanIni) * 100) : 0), 2),

            'months' => $months,
            'bulanIni' => $bulanIni,


            'JanTelat' => number_format(($JmlData[1] != 0 ? ($Telat[1] / $JmlData[1] * 100) : 0), 2),
            'FebTelat' =>  number_format(($JmlData[2] != 0 ? ($Telat[2] / $JmlData[2] * 100) : 0), 2),
            'MarTelat' =>  number_format(($JmlData[3] != 0 ? ($Telat[3] / $JmlData[3] * 100) : 0), 2),
            'AprTelat' =>  number_format(($JmlData[4] != 0 ? ($Telat[4] / $JmlData[4] * 100) : 0), 2),
            'MayTelat' =>  number_format(($JmlData[5] != 0 ? ($Telat[5] / $JmlData[5] * 100) : 0), 2),
            'JunTelat' =>  number_format(($JmlData[6] != 0 ? ($Telat[6] / $JmlData[6] * 100) : 0), 2),
            'JulTelat' =>  number_format(($JmlData[7] != 0 ? ($Telat[7] / $JmlData[7] * 100) : 0), 2),
            'AugTelat' =>  number_format(($JmlData[8] != 0 ? ($Telat[8] / $JmlData[8] * 100) : 0), 2),
            'SepTelat' =>  number_format(($JmlData[9] != 0 ? ($Telat[9] / $JmlData[9] * 100) : 0), 2),
            'OctTelat' =>  number_format(($JmlData[10] != 0 ? ($Telat[10] / $JmlData[10] * 100) : 0), 2),
            'NovTelat' =>  number_format(($JmlData[11] != 0 ? ($Telat[11] / $JmlData[11] * 100) : 0), 2),
            'DecTelat' =>  number_format(($JmlData[12] != 0 ? ($Telat[12] / $JmlData[12] * 100) : 0), 2),

            'JanTepat' => number_format(($JmlData[1] != 0 ? ($Tepat[1] / $JmlData[1]) * 100 : 0), 2),
            'FebTepat' =>  number_format(($JmlData[2] != 0 ? ($Tepat[2] / $JmlData[2] * 100) : 0), 2),
            'MarTepat' =>  number_format(($JmlData[3] != 0 ? ($Tepat[3] / $JmlData[3] * 100) : 0), 2),
            'AprTepat' =>  number_format(($JmlData[4] != 0 ? ($Tepat[4] / $JmlData[4] * 100) : 0), 2),
            'MayTepat' =>  number_format(($JmlData[5] != 0 ? ($Tepat[5] / $JmlData[5] * 100) : 0), 2),
            'JunTepat' =>  number_format(($JmlData[6] != 0 ? ($Tepat[6] / $JmlData[6] * 100) : 0), 2),
            'JulTepat' =>  number_format(($JmlData[7] != 0 ? ($Tepat[7] / $JmlData[7] * 100) : 0), 2),
            'AugTepat' =>  number_format(($JmlData[8] != 0 ? ($Tepat[8] / $JmlData[8] * 100) : 0), 2),
            'SepTepat' =>  number_format(($JmlData[9] != 0 ? ($Tepat[9] / $JmlData[9] * 100) : 0), 2),
            'OctTepat' =>  number_format(($JmlData[10] != 0 ? ($Tepat[10] / $JmlData[10] * 100) : 0), 2),
            'NovTepat' =>  number_format(($JmlData[11] != 0 ? ($Tepat[11] / $JmlData[11] * 100) : 0), 2),
            'DecTepat' =>  number_format(($JmlData[12] != 0 ? ($Tepat[12] / $JmlData[12] * 100) : 0), 2),

            'JanAwal' => number_format(($JmlData[1] != 0 ? ($Awal[1] / $JmlData[1] * 100) : 0), 2),
            'FebAwal' =>  number_format(($JmlData[2] != 0 ? ($Awal[2] / $JmlData[2] * 100) : 0), 2),
            'MarAwal' =>  number_format(($JmlData[3] != 0 ? ($Awal[3] / $JmlData[3] * 100) : 0), 2),
            'AprAwal' =>  number_format(($JmlData[4] != 0 ? ($Awal[4] / $JmlData[4] * 100) : 0), 2),
            'MayAwal' =>  number_format(($JmlData[5] != 0 ? ($Awal[5] / $JmlData[5] * 100) : 0), 2),
            'JunAwal' =>  number_format(($JmlData[6] != 0 ? ($Awal[6] / $JmlData[6] * 100) : 0), 2),
            'JulAwal' =>  number_format(($JmlData[7] != 0 ? ($Awal[7] / $JmlData[7] * 100) : 0), 2),
            'AugAwal' =>  number_format(($JmlData[8] != 0 ? ($Awal[8] / $JmlData[8] * 100) : 0), 2),
            'SepAwal' =>  number_format(($JmlData[9] != 0 ? ($Awal[9] / $JmlData[9] * 100) : 0), 2),
            'OctAwal' =>  number_format(($JmlData[10] != 0 ? ($Awal[10] / $JmlData[10] * 100) : 0), 2),
            'NovAwal' =>  number_format(($JmlData[11] != 0 ? ($Awal[11] / $JmlData[11] * 100) : 0), 2),
            'DecAwal' =>  number_format(($JmlData[12] != 0 ? ($Awal[12] / $JmlData[12] * 100) : 0), 2),


        ]);
    }

    public function kehadiran(Request $request)
    {
        //
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);
        $bulanIni = $request->month;

        /*  PEGAWAI YANG SEDANG DALAM PENGAWASAN   */
        $date = date("Y-m-d");
        $myDate = date_create($date);
        date_sub($myDate, date_interval_create_from_date_string('3 month'));
        $selisihBulan = date_format($myDate, 'Y-m-d');

        $pegawaiDlmPengawasan = SuratPeringatan::whereIn('id', function ($query) use ($selisihBulan) {
            $query->select('*')
                ->from('surat_peringatan')
                ->where('tanggal', '>', $selisihBulan)
                ->where('tingkat', '!=', 'III')
                ->select(DB::raw('MAX(id)'))
                ->groupBy('id_pegawai');
        })->get();
        /* END PEGAWAI YG SEDANG DALAM PENGAWASAN */


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

        for ($i = 1; $i <= 12; $i++) {
            $JmlData[$i] = Presensi_harian::whereYear('tanggal', date('Y'))
                ->whereMonth('tanggal', $i)
                ->count();
        }
        $JmlDataBulanIni = Presensi_harian::whereYear('tanggal', date('Y'))
            ->whereMonth('tanggal', $bulanIni)
            ->count();



        /* Get Pegawai WFH hari ini */

        $pegWfh = Presensi_harian::where('tanggal', date('Y-m-d'))
            ->where('ket', 'Hadir')
            ->where('is_wfh', 1)->get();

        /* End Get Pegawai WFH hari ini */


        return view('hrd.dashboard', [
            'cuti' => $cuti,
            'pegawaiCuti' => $pegawaiCuti,
            'pegawaiTelat' => $pegawaiTelat,

            'JmlCuti' => number_format(($JmlDataBulanIni != 0 ? (($JmlCuti / $JmlDataBulanIni) * 100) : 0), 2),
            'JmlAlpha' => number_format(($JmlDataBulanIni != 0 ? (($JmlAlpha / $JmlDataBulanIni) * 100) : 0), 2),
            'JmlHadir' => number_format(($JmlDataBulanIni != 0 ? (($JmlHadir / $JmlDataBulanIni) * 100) : 0), 2),

            'months' => $months,
            'bulanIni' => $bulanIni,

            'pegawaiDlmPengawasan' => $pegawaiDlmPengawasan,
            'pegWfh' => $pegWfh,



            'JanTelat' => number_format(($JmlData[1] != 0 ? ($Telat[1] / $JmlData[1] * 100) : 0), 2),
            'FebTelat' =>  number_format(($JmlData[2] != 0 ? ($Telat[2] / $JmlData[2] * 100) : 0), 2),
            'MarTelat' =>  number_format(($JmlData[3] != 0 ? ($Telat[3] / $JmlData[3] * 100) : 0), 2),
            'AprTelat' =>  number_format(($JmlData[4] != 0 ? ($Telat[4] / $JmlData[4] * 100) : 0), 2),
            'MayTelat' =>  number_format(($JmlData[5] != 0 ? ($Telat[5] / $JmlData[5] * 100) : 0), 2),
            'JunTelat' =>  number_format(($JmlData[6] != 0 ? ($Telat[6] / $JmlData[6] * 100) : 0), 2),
            'JulTelat' =>  number_format(($JmlData[7] != 0 ? ($Telat[7] / $JmlData[7] * 100) : 0), 2),
            'AugTelat' =>  number_format(($JmlData[8] != 0 ? ($Telat[8] / $JmlData[8] * 100) : 0), 2),
            'SepTelat' =>  number_format(($JmlData[9] != 0 ? ($Telat[9] / $JmlData[9] * 100) : 0), 2),
            'OctTelat' =>  number_format(($JmlData[10] != 0 ? ($Telat[10] / $JmlData[10] * 100) : 0), 2),
            'NovTelat' =>  number_format(($JmlData[11] != 0 ? ($Telat[11] / $JmlData[11] * 100) : 0), 2),
            'DecTelat' =>  number_format(($JmlData[12] != 0 ? ($Telat[12] / $JmlData[12] * 100) : 0), 2),

            'JanTepat' => number_format(($JmlData[1] != 0 ? ($Tepat[1] / $JmlData[1] * 100) : 0), 2),
            'FebTepat' =>  number_format(($JmlData[2] != 0 ? ($Tepat[2] / $JmlData[2] * 100) : 0), 2),
            'MarTepat' =>  number_format(($JmlData[3] != 0 ? ($Tepat[3] / $JmlData[3] * 100) : 0), 2),
            'AprTepat' =>  number_format(($JmlData[4] != 0 ? ($Tepat[4] / $JmlData[4] * 100) : 0), 2),
            'MayTepat' =>  number_format(($JmlData[5] != 0 ? ($Tepat[5] / $JmlData[5] * 100) : 0), 2),
            'JunTepat' =>  number_format(($JmlData[6] != 0 ? ($Tepat[6] / $JmlData[6] * 100) : 0), 2),
            'JulTepat' =>  number_format(($JmlData[7] != 0 ? ($Tepat[7] / $JmlData[7] * 100) : 0), 2),
            'AugTepat' =>  number_format(($JmlData[8] != 0 ? ($Tepat[8] / $JmlData[8] * 100) : 0), 2),
            'SepTepat' =>  number_format(($JmlData[9] != 0 ? ($Tepat[9] / $JmlData[9] * 100) : 0), 2),
            'OctTepat' =>  number_format(($JmlData[10] != 0 ? ($Tepat[10] / $JmlData[10] * 100) : 0), 2),
            'NovTepat' =>  number_format(($JmlData[11] != 0 ? ($Tepat[11] / $JmlData[11] * 100) : 0), 2),
            'DecTepat' =>  number_format(($JmlData[12] != 0 ? ($Tepat[12] / $JmlData[12] * 100) : 0), 2),

            'JanAwal' => number_format(($JmlData[1] != 0 ? ($Awal[1] / $JmlData[1] * 100) : 0), 2),
            'FebAwal' =>  number_format(($JmlData[2] != 0 ? ($Awal[2] / $JmlData[2] * 100) : 0), 2),
            'MarAwal' =>  number_format(($JmlData[3] != 0 ? ($Awal[3] / $JmlData[3] * 100) : 0), 2),
            'AprAwal' =>  number_format(($JmlData[4] != 0 ? ($Awal[4] / $JmlData[4] * 100) : 0), 2),
            'MayAwal' =>  number_format(($JmlData[5] != 0 ? ($Awal[5] / $JmlData[5] * 100) : 0), 2),
            'JunAwal' =>  number_format(($JmlData[6] != 0 ? ($Awal[6] / $JmlData[6] * 100) : 0), 2),
            'JulAwal' =>  number_format(($JmlData[7] != 0 ? ($Awal[7] / $JmlData[7] * 100) : 0), 2),
            'AugAwal' =>  number_format(($JmlData[8] != 0 ? ($Awal[8] / $JmlData[8] * 100) : 0), 2),
            'SepAwal' =>  number_format(($JmlData[9] != 0 ? ($Awal[9] / $JmlData[9] * 100) : 0), 2),
            'OctAwal' =>  number_format(($JmlData[10] != 0 ? ($Awal[10] / $JmlData[10] * 100) : 0), 2),
            'NovAwal' =>  number_format(($JmlData[11] != 0 ? ($Awal[11] / $JmlData[11] * 100) : 0), 2),
            'DecAwal' =>  number_format(($JmlData[12] != 0 ? ($Awal[12] / $JmlData[12] * 100) : 0), 2),

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
