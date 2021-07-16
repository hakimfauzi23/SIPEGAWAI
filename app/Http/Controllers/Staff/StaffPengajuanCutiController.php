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

class StaffPengajuanCutiController extends Controller
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
        $bawahan = Pegawai::where('id_atasan', Auth::user()->id)->get();
        $id_bawahan = $bawahan->pluck('id');
        $pengajuan = Cuti::whereIn('id_pegawai', $id_bawahan)
            ->where('status', 'Diproses')
            ->get();

        return view('staff.pengajuanCuti.index', [
            'pengajuan' => $pengajuan,
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

        $id = Crypt::decryptString($data);
        $cuti = Cuti::find($id);
        $tgl_masuk = $cuti->pegawai->tgl_masuk;
        $tgl_now = date("Y-m-d");
        $date1 = new DateTime($tgl_masuk);
        $date2 = new DateTime($tgl_now);
        $interval = $date1->diff($date2);
        $id_peg = $cuti->id_pegawai;
        $pegawai = Pegawai::find($id_peg);

        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();
        $peraturan = Peraturan::find($id_peraturan);
        $batasTahunan = $peraturan->jml_cuti_tahunan;
        $batasBersama = $peraturan->jml_cuti_bersama;
        $batasPenting = $peraturan->jml_cuti_penting;
        $batasBesar = $peraturan->jml_cuti_besar;
        $batasSakit = $peraturan->jml_cuti_sakit;
        $batasHamil = $peraturan->jml_cuti_hamil;

        /* Lama Kerja */
        $tgl_masuk = $pegawai->tgl_masuk;
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

        // Detail Data Cuti Bersama
        $cutiBersama = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Bersama')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();
        // Detail Data Cuti Tahunan
        $cutiTahunan = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Tahunan')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();
        // Detail Data Cuti Penting
        $cutiPenting = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Penting')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();
        // Detail Data Cuti Besar
        $cutiBesar = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Besar')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();
        // Detail Data Cuti Sakit
        $cutiSakit = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Sakit')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();
        // Detail Data Cuti Hamil
        $cutiHamil = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->where('tipe_cuti', 'Hamil')
            ->whereYear('tgl_mulai', date("Y"))
            ->count();


        // Riwayat Cuti Terakhir
        $riwayatCuti = Cuti::where('id_pegawai', $id_peg)
            ->where('status', 'Disetujui HRD')
            ->whereYear('tgl_mulai', date("Y"))
            ->paginate(3);

        // End Riwayat Cuti Terakhir

        return view('staff.pengajuanCuti.details', [
            'id' => $data,
            'cuti' => $cuti,
            'riwayatCuti' => $riwayatCuti,
            'interval' => $interval,

            'batasTahunan' => $batasTahunan,
            'batasBersama' => $batasBersama,
            'batasPenting' => $batasPenting,
            'batasBesar' => $batasBesar,
            'batasSakit' => $batasSakit,
            'batasHamil' => $batasHamil,

            'cutiTahunan' => $cutiTahunan,
            'cutiBersama' => $cutiBersama,
            'cutiPenting' => $cutiPenting,
            'cutiBesar' => $cutiBesar,
            'cutiSakit' => $cutiSakit,
            'cutiHamil' => $cutiHamil,

            'lamaKerja' => $lamaKerja,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,

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

    public function keputusan(Request $request, $data)
    {
        $hrd = Pegawai::where('id_role', 2)->get();
        $id = Crypt::decryptString($data);

        $cuti = Cuti::find($id);
        $pegawai = Pegawai::find($cuti->id_pegawai);


        $nama = $pegawai->nama;

        if ($request->keputusan == 'Disetujui Atasan') {
            $cuti->status = $request->keputusan;
            $cuti->tgl_disetujui_atasan = date("Y-m-d");
            $cuti->save();

            $details = [
                'id_pegawai' => $cuti->id_pegawai,
                'nama_pegawai' => $cuti->pegawai->nama,
                'tipe_cuti' => $cuti->tipe_cuti,
                'tgl_pengajuan' => $cuti->tgl_pengajuan,
                'tgl_mulai' => $cuti->tgl_mulai,
                'tgl_selesai' => $cuti->tgl_selesai,
                'ket' => $cuti->ket,
                'atasan' => Auth::user()->nama,
                'keputusan' => 'Disetujui',

            ];

            try {
                //code...
                Mail::to($pegawai->email)->send(new \App\Mail\KeputusanAtasanMail($details));

                foreach ($hrd as $key => $p) {

                    Mail::to($p->email)->send(new \App\Mail\PengajuanCutiMail($details));
                }
            } catch (\Exception $ex) {
                Alert::error('Email Sistem Error', 'terdapat kesalahan pada email sistem informasi, hubungi admin/hrd segera!');
                $cuti->status = 'Diproses';
                $cuti->tgl_disetujui_atasan = NULL;
                $cuti->save();
                return redirect(route('staffPengajuanCuti.show', $data));
            }


            Alert::success('success', ' Berhasil Menyetujui Pengajuan Cuti !');
            return redirect(route('staffPengajuanCuti.index'));
        } else {
            $cuti->status = $request->keputusan;
            $cuti->tgl_ditolak_atasan = date("Y-m-d");
            $cuti->save();


            $details = [
                'id_pegawai' => $cuti->id_pegawai,
                'nama_pegawai' => $cuti->pegawai->nama,
                'tipe_cuti' => $cuti->tipe_cuti,
                'tgl_pengajuan' => $cuti->tgl_pengajuan,
                'tgl_mulai' => $cuti->tgl_mulai,
                'tgl_selesai' => $cuti->tgl_selesai,
                'ket' => $cuti->ket,
                'atasan' => Auth::user()->nama,
                'keputusan' => 'Ditolak',
            ];

            try {
                //code...
                Mail::to($pegawai->email)->send(new \App\Mail\KeputusanAtasanMail($details));
                Alert::success('success', ' Berhasil Menolak Pengajuan Cuti !');
                return redirect(route('staffPengajuanCuti.index'));
            } catch (\Exception $ex) {
                Alert::error('Email Sistem Error', 'terdapat kesalahan pada email sistem informasi, hubungi admin/hrd segera!');
                $cuti->status = 'Diproses';
                $cuti->tgl_ditolak_atasan = NULL;
                $cuti->save();
                return redirect(route('staffPengajuanCuti.show', $data));
            }
        }
    }
}
