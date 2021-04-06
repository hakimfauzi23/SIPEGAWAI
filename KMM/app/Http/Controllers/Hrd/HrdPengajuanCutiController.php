<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class HrdPengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* CARI ID PEGAWAI YANG BELUM ADA ATASAN */
        $id_pegawai = Pegawai::where('id_atasan', null)->pluck('id');

        $pengajuan = Cuti::where('status', 'Disetujui Atasan')
            ->orWhere(function ($query) use ($id_pegawai) {
                $query->whereIn('id_pegawai', $id_pegawai);
            })->get();

        // dd($jml_pengajuan);

        return view('hrd.pengajuanCuti.index', [
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

        return view('hrd.pengajuanCuti.details', [
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
        // $keputusan = $request->keputusan;

        $id = Crypt::decryptString($data);

        $cuti = Cuti::find($id);
        $pegawai = Pegawai::find($cuti->id_pegawai);


        if ($request->keputusan == 'Disetujui HRD') {
            $cuti->status = $request->keputusan;
            $cuti->tgl_disetujui_hrd = date("Y-m-d");
            $cuti->save();


            $date1 = new DateTime($request->tgl_mulai);
            $date2 = new DateTime($request->tgl_selesai);

            $interval = $date1->diff($date2);
            $dt = $request->tgl_mulai;
            // $gg = date("Y-m-d", strtotime($dt . ' + 40 days'));
            // dd($request->id_pegawai);
            for ($i = 0; $i < $interval->d; $i++) {
                Presensi_harian::create([
                    'id_pegawai' => $request->id_pegawai,
                    'tanggal' => date("Y-m-d", strtotime($dt . ' + ' . $i . 'days')),
                    'ket' => 'Cuti',
                    'jam_dtg' => NULL,
                    'jam_plg' => NULL,
                ]);
            }


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

            Mail::to($pegawai->email)->send(new \App\Mail\KeputusanHrdMail($details));

            Alert::success('success', ' Berhasil Menyetujui Pengajuan Cuti !');
            return redirect(route('hrdPengajuanCuti.index'));
        } else {
            $cuti->status = $request->keputusan;
            $cuti->tgl_ditolak_hrd = date("Y-m-d");
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

            Mail::to($pegawai->email)->send(new \App\Mail\KeputusanHrdMail($details));

            Alert::success('success', ' Berhasil Menolak Pengajuan Cuti !');
            return redirect(route('hrdPengajuanCuti.index'));
        }
    }
}
