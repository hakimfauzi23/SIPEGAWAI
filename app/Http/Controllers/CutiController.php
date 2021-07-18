<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;


class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-cuti', ['all']);
    }

    public function index()
    {
        //
        $dari = date("Y-m-d");
        $ke = date("Y-m-d");
        $cuti = Cuti::where('tgl_pengajuan', date("Y-m-d"))->paginate(20);
        return view('admin.cuti.index', [
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
        $cuti = Cuti::whereBetween('tgl_pengajuan', [$dari, $ke])->paginate(20);
        $cuti->appends($request->all());
        return view('admin.cuti.index', [
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
        return view('admin.cuti.create', [
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
        return redirect('cuti');
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

        return view('admin.cuti.details', [
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

        return view('admin.cuti.edit', [
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
        return redirect(route('cuti.index'));

        // if ($request->status == "Disetujui") {

        //     $cuti->id_pegawai = $request->id_pegawai;
        //     $cuti->tipe_cuti = $request->tipe_cuti;
        //     $cuti->tgl_pengajuan = $request->tgl_pengajuan;
        //     $cuti->tgl_mulai = $request->tgl_mulai;
        //     $cuti->tgl_selesai = $request->tgl_selesai;
        //     $cuti->ket = $request->ket;
        //     $cuti->status = $request->status;
        //     $cuti->tgl_disetujui = date("Y-m-d");
        //     $cuti->tgl_ditolak = NULL;
        //     $cuti->save();

        //     $date1 = new DateTime($request->tgl_mulai);
        //     $date2 = new DateTime($request->tgl_selesai);

        //     $interval = $date1->diff($date2);
        //     $dt = $request->tgl_mulai;
        //     // $gg = date("Y-m-d", strtotime($dt . ' + 40 days'));
        //     // dd($gg);
        //     for ($i = 0; $i < $interval->d; $i++) {
        //         Presensi_harian::create([
        //             'id_pegawai' => $request->id_pegawai,
        //             'tanggal' => date("Y-m-d", strtotime($dt . ' + ' . $i . 'days')),
        //             'ket' => 'Cuti',
        //             'jam_dtg' => NULL,
        //             'jam_plg' => NULL,
        //         ]);
        //     }
        // } else if ($request->status == "Ditolak") {
        //     $cuti->id_pegawai = $request->id_pegawai;
        //     $cuti->tipe_cuti = $request->tipe_cuti;
        //     $cuti->tgl_pengajuan = $request->tgl_pengajuan;
        //     $cuti->tgl_mulai = $request->tgl_mulai;
        //     $cuti->tgl_selesai = $request->tgl_selesai;
        //     $cuti->ket = $request->ket;
        //     $cuti->status = $request->status;
        //     $cuti->tgl_disetujui = NULL;
        //     $cuti->tgl_ditolak = date("Y-m-d");
        //     $cuti->save();
        // } else if ($request->status == "Diproses") {
        //     $cuti->id_pegawai = $request->id_pegawai;
        //     $cuti->tipe_cuti = $request->tipe_cuti;
        //     $cuti->tgl_pengajuan = $request->tgl_pengajuan;
        //     $cuti->tgl_mulai = $request->tgl_mulai;
        //     $cuti->tgl_selesai = $request->tgl_selesai;
        //     $cuti->ket = $request->ket;
        //     $cuti->status = $request->status;
        //     $cuti->tgl_disetujui = NULL;
        //     $cuti->tgl_ditolak = NULL;
        //     $cuti->save();
        // }

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
        return redirect('cuti');
    }

    public function cutiBersama()
    {
        $pegawai = Pegawai::pluck('nama', 'id');
        return view('admin.cuti.cutiBersama', [
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
        return redirect('cuti');
    }
}
