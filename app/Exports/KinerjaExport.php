<?php

namespace App\Exports;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use App\Models\SuratPeringatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KinerjaExport implements FromView, ShouldAutoSize, WithEvents
{

    protected $id_peg, $year;

    function __construct($id_peg, $year)
    {
        $this->id_peg = $id_peg;
        $this->year = $year;
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $tahun = $this->year;
                $pegawai = Pegawai::find($this->id_peg);

                /* GET DATA RIWAYAT SURAT PERINGATAN  */
                $suratPeringatan = SuratPeringatan::where('id_pegawai', $pegawai->id)
                    ->whereYear('tanggal', $tahun)
                    ->orderBy('id', 'desc')->count();
                $lastCell = 71 + $suratPeringatan;
                /* END GET DATA RIWAYAT SURAT PERINGATAN  */

                if ($lastCell <= 71) {
                    $event->sheet->getStyle("A7:F72")->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ]);
                } elseif ($lastCell > 72) {
                    $event->sheet->getStyle("A7:F$lastCell")->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ]);
                }

                $event->sheet->getStyle("E11:E58")->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('A1:E1')->getFont()->setSize(14);
            },
        ];
    }

    public function view(): View
    {
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();
        $peraturan = Peraturan::find($id_peraturan);
        $tahun = $this->year;

        $pegawai = Pegawai::find($this->id_peg);
        $months = [
            'January' => 1, 'Febuary' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        /* MENGHITUNG JUMLAH KETERLAMBATAN PEGAWAI */

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
            $JanTelat, $FebTelat, $MarTelat, $AprTelat,
            $MayTelat, $JunTelat, $JulTelat, $AugTelat,
            $SepTelat, $OctTelat, $NovTelat, $DecTelat,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Telat[$i] = Presensi_harian::where('id_pegawai', $pegawai->id)
                ->whereYear('tanggal', $tahun)
                ->where('id_pegawai', $pegawai->id)
                ->whereMonth('tanggal', $i)
                ->where('jam_dtg', '>', $peraturan->jam_masuk)
                ->count();
        }

        /* END MENGHITUNG JUMLAH KETERLAMBATAN PEGAWAI */


        /* MENGHITUNG JUMLAH PULANG AWAL PEGAWAI */
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
            $JanAwal, $FebAwal, $MarAwal, $AprAwal,
            $MayAwal, $JunAwal, $JulAwal, $AugAwal,
            $SepAwal, $OctAwal, $NovAwal, $DecAwal,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Awal[$i] = Presensi_harian::where('id_pegawai', $pegawai->id)
                ->whereYear('tanggal', $tahun)
                ->where('id_pegawai', $pegawai->id)
                ->whereMonth('tanggal', $i)
                ->where('jam_plg', '<', $peraturan->jam_plg)
                ->count();
        }
        /* END MENGHITUNG JUMLAH PULANG AWAL PEGAWAI */

        /* MENGHITUNG JUMLAH HADIR PEGAWAI */

        $JanHadir = 0;
        $FebHadir = 0;
        $MarHadir = 0;
        $AprHadir = 0;
        $MayHadir = 0;
        $JunHadir = 0;
        $JulHadir = 0;
        $AugHadir = 0;
        $SepHadir = 0;
        $OctHadir = 0;
        $NovHadir = 0;
        $DecHadir = 0;

        $Hadir = [
            $JanHadir, $FebHadir, $MarHadir, $AprHadir,
            $MayHadir, $JunHadir, $JulHadir, $AugHadir,
            $SepHadir, $OctHadir, $NovHadir, $DecHadir,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Hadir[$i] = Presensi_harian::where('id_pegawai', $pegawai->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->where('ket', 'Hadir')
                ->count();
        }
        /* END MENGHITUNG JUMLAH HADIR PEGAWAI */


        /* MENGHITUNG JUMLAH ALPHA PEGAWAI */

        $JanAlpha = 0;
        $FebAlpha = 0;
        $MarAlpha = 0;
        $AprAlpha = 0;
        $MayAlpha = 0;
        $JunAlpha = 0;
        $JulAlpha = 0;
        $AugAlpha = 0;
        $SepAlpha = 0;
        $OctAlpha = 0;
        $NovAlpha = 0;
        $DecAlpha = 0;

        $Alpha = [
            $JanAlpha, $FebAlpha, $MarAlpha, $AprAlpha,
            $MayAlpha, $JunAlpha, $JulAlpha, $AugAlpha,
            $SepAlpha, $OctAlpha, $NovAlpha, $DecAlpha,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Alpha[$i] = Presensi_harian::where('id_pegawai', $pegawai->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->where('ket', 'Alpha')
                ->count();
        }
        /* END MENGHITUNG ALPHA PEGAWAI */


        /* MENGHITUNG JUMLAH CUTI PEGAWAI */

        $JanCuti = 0;
        $FebCuti = 0;
        $MarCuti = 0;
        $AprCuti = 0;
        $MayCuti = 0;
        $JunCuti = 0;
        $JulCuti = 0;
        $AugCuti = 0;
        $SepCuti = 0;
        $OctCuti = 0;
        $NovCuti = 0;
        $DecCuti = 0;

        $Cuti = [
            $JanCuti, $FebCuti, $MarCuti, $AprCuti,
            $MayCuti, $JunCuti, $JulCuti, $AugCuti,
            $SepCuti, $OctCuti, $NovCuti, $DecCuti,
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Cuti[$i] = Presensi_harian::where('id_pegawai', $pegawai->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->where('ket', 'Cuti')
                ->count();
        }
        /* END MENGHITUNG CUTI PEGAWAI */

        /* MENGHITUNG JUMLAH CUTI TERPAKAI */


        /* MENGHITUNG JUMLAH CUTI TERPAKAI */


        $Tahunan = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();

        $Tahunan = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui HRD')
            ->count();
        $Bersama = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui HRD')
            ->count();

        $Penting = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui HRD')
            ->count();

        $Besar = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui HRD')
            ->count();

        $Sakit = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui HRD')
            ->count();

        $Hamil = Cuti::where('id_pegawai', $pegawai->id)
            ->whereYear('tgl_mulai', $tahun)
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui HRD')
            ->count();

        /* END MENGHITUNG JUMLAH CUTI TERPAKAI */


        /* GET DATA RIWAYAT SURAT PERINGATAN  */
        $suratPeringatan = SuratPeringatan::where('id_pegawai', $pegawai->id)
            ->whereYear('tanggal', $tahun)
            ->orderBy('id', 'desc')->get();
        /* END GET DATA RIWAYAT SURAT PERINGATAN  */


        return view('admin.report.export', [
            'pegawai' => $pegawai,
            'months' => $months,
            'tahun' => $tahun,

            'Telat' => $Telat,
            'Awal' => $Awal,
            'Hadir' => $Hadir,
            'Alpha' => $Alpha,
            'Cuti' => $Cuti,

            'Tahunan' => $Tahunan,
            'Bersama' => $Bersama,
            'Penting' => $Penting,
            'Besar' => $Besar,
            'Sakit' => $Sakit,
            'Hamil' => $Hamil,

            'batasTahunan' => $batasTahunan,
            'batasBersama' => $batasBersama,
            'batasPenting' => $batasPenting,
            'batasBesar' => $batasBesar,
            'batasSakit' => $batasSakit,
            'batasHamil' => $batasHamil,

            'suratPeringatan' => $suratPeringatan,
        ]);
    }
}
