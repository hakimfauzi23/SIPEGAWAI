<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class StaffPengajuanCutiController extends Controller
{
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
        //
        $id = Crypt::decryptString($data);
        $cuti = Cuti::find($id);

        $tgl_masuk = $cuti->pegawai->tgl_masuk;
        $tgl_now = date("Y-m-d");

        $date1 = new DateTime($tgl_masuk);
        $date2 = new DateTime($tgl_now);

        $interval = $date1->diff($date2);

        return view('staff.pengajuanCuti.details', [
            'id' => $data,
            'cuti' => $cuti,
            'interval' => $interval
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
                'title' => 'Notifikasi Konfirmasi Pengajuan Cuti',
                'body' => "Selamat $nama Pengajuan Cuti Anda telah disetujui oleh Atasan anda!!",
                'data' => " Data Cuti : ID :$cuti->id , Tipe :$cuti->tipe_cuti , TGL MULAI : $cuti->tgl_mulai, TGL SELESAI : $cuti->tgl_selesai "
            ];

            Mail::to($pegawai->email)->send(new \App\Mail\MyTestMail($details));


            $details2 = [
                'title' => 'Pengajuan Cuti Baru',
                'body' => "Hallo!! Pengajuan Cuti Baru dari $pegawai->nama sudah ada di SIPEGAWAI Nih!!",
                'data' => " Apabila Bapak/Ibu HRD Berkenan, silakan di cek lalu bisa ditolak atau disetujui ya!!"

            ];

            foreach ($hrd as $key => $p) {

                Mail::to($p->email)->send(new \App\Mail\PengajuanCutiMail($details2));
            }


            Alert::success('success', ' Berhasil Menyetujui Pengajuan Cuti !');
            return redirect(route('staffPengajuanCuti.index'));
        } else {
            $cuti->status = $request->keputusan;
            $cuti->tgl_ditolak_atasan = date("Y-m-d");
            $cuti->save();


            $details = [
                'title' => 'Notifikasi Konfirmasi Pengajuan Cuti',
                'body' => "Sayang Sekali $nama Pengajuan Cuti Anda telah ditolak oleh Atasan anda!!",
                'data' => " Data Cuti : ID :$cuti->id , Tipe :$cuti->tipe_cuti , TGL MULAI : $cuti->tgl_mulai, TGL SELESAI : $cuti->tgl_selesai "

            ];

            Mail::to($pegawai->email)->send(new \App\Mail\MyTestMail($details));

            Alert::success('success', ' Berhasil Menolak Pengajuan Cuti !');
            return redirect(route('staffPengajuanCuti.index'));
        }
    }
}
