<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class HrdCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dari = date("Y-m-d");
        $ke = date("Y-m-d");
        $cuti = Cuti::where('tgl_pengajuan', date("Y-m-d"))->get();
        return view('hrd.cuti.index', [
            'cuti' => $cuti,
            'dari' => $dari,
            'ke' => $ke,

        ]);
    }

    public function tglPresensi(Request $request)
    {
        $dari = $request->dari;
        $ke = $request->ke;
        // dd($ke);
        $cuti = Cuti::whereBetween('tgl_pengajuan', [$dari, $ke])->get();
        return view('hrd.cuti.index', [
            'cuti' => $cuti,
            'dari' => $dari,
            'ke' => $ke,

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
        $pegawai = Pegawai::pluck('nama', 'id');
        return view('hrd.cuti.create', [
            'pegawai' => $pegawai
        ]);
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
        $this->validate($request, [
            'id_pegawai' => 'required',
            'tipe_cuti' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'ket' => 'required',
        ]);

        Cuti::create([
            'id_pegawai' => $request->id_pegawai,
            'tipe_cuti' => $request->tipe_cuti,
            'tgl_pengajuan' => date("Y-m-d"),
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'ket' => $request->ket,
            'status' => "Diproses",
            'tgl_disetujui_atasan' => NULL,
            'tgl_disetujui_hrd' => NULL,
            'tgl_ditolak_atasan' => NULL,
            'tgl_ditolak_hrd' => NULL,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('hrdCuti');
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

        return view('hrd.cuti.details', [
            'id' => $id,
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
    public function edit($data)
    {
        //

        $id = Crypt::decryptString($data);
        $cuti = Cuti::find($id);
        $pegawai = Pegawai::pluck('nama', 'id');

        return view('hrd.cuti.edit', [
            'id' => $data,
            'cuti' => $cuti,
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        //
        $id = Crypt::decryptString($data);

        $this->validate($request, [
            'id_pegawai' => 'required',
            'tipe_cuti' => 'required',
            'tgl_pengajuan' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'ket' => 'required',
            'status' => 'required',
        ]);

        $cuti = Cuti::find($id);

        $cuti->id_pegawai = $request->id_pegawai;
        $cuti->tipe_cuti = $request->tipe_cuti;
        $cuti->tgl_pengajuan = $request->tgl_pengajuan;
        $cuti->tgl_mulai = $request->tgl_mulai;
        $cuti->tgl_selesai = $request->tgl_selesai;
        $cuti->ket = $request->ket;
        $cuti->status = $request->status;
        $cuti->tgl_disetujui_atasan = $request->tgl_disetujui_atasan;
        $cuti->tgl_disetujui_hrd = $request->tgl_disetujui_hrd;
        $cuti->tgl_ditolak_atasan = $request->tgl_ditolak_atasan;
        $cuti->tgl_ditolak_hrd = $request->tgl_ditolak_hrd;
        $cuti->save();
        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('hrdCuti.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        //

        $id = Crypt::decryptString($data);
        $cuti = Cuti::find($id);
        $cuti->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('hrdCuti');
    }


    public function cutiBersama()
    {
        $pegawai = Pegawai::pluck('nama', 'id');
        return view('hrd.cuti.cutiBersama', [
            'pegawai' => $pegawai
        ]);
    }

    public function storeCutiBersama(Request $request)
    {
        $this->validate($request, [
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'ket' => 'required',
        ]);

        $pegawai = Pegawai::all();

        foreach ($pegawai as $key => $p) {
            // dd($p->id);
            Cuti::create([
                'id_pegawai' => $p->id,
                'tipe_cuti' => "Bersama",
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
                'status' => "Diproses",
                'tgl_disetujui_atasan' => NULL,
                'tgl_disetujui_hrd' => NULL,
                'tgl_ditolak_atasan' => NULL,
                'tgl_ditolak_hrd' => NULL,

            ]);
        }

        Alert::success('success', ' Berhasil Atur  Cuti Bersama !');
        return redirect('hrdCuti');
    }
}
