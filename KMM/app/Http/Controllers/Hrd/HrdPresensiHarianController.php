<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Imports\PresensiCsvImport;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class HrdPresensiHarianController extends Controller
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

        $presensi = Presensi_harian::where('tanggal', date("Y-m-d"))->get();
        // dd($presensi);
        return view('hrd.presensi.index', [
            'presensi' => $presensi,
            'dari' => $dari,
            'ke' => $ke,

        ]);
    }

    public function tglPresensi(Request $request)
    {
        $dari = $request->dari;
        $ke = $request->ke;
        // dd($ke);
        $presensi = Presensi_harian::whereBetween('tanggal', [$dari, $ke])->get();
        return view('hrd.presensi.index', [
            'presensi' => $presensi,
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
        return view('hrd.presensi.create', [
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
            'tanggal' => 'required',
            'ket' => 'required',
            'jam_dtg' => 'required',
            'jam_plg' => 'required',
        ]);

        Presensi_harian::create([
            'id_pegawai' => $request->id_pegawai,
            'tanggal' => $request->tanggal,
            'ket' => $request->ket,
            'jam_dtg' => $request->jam_dtg,
            'jam_plg' => $request->jam_plg,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('hrdPresensiHarian');
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
    public function edit($data)
    {
        //
        $id = Crypt::decryptString($data);
        $presensi = Presensi_harian::find($id);
        $pegawai = Pegawai::pluck('nama', 'id');

        return view('hrd.presensi.edit', [
            'id' => $data,
            'presensi' => $presensi,
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
            'tanggal' => 'required',
            'ket' => 'required',
            'jam_dtg' => 'required',
            'jam_plg' => 'required',
        ]);

        $presensi = Presensi_harian::find($id);

        $presensi->id_pegawai = $request->id_pegawai;
        $presensi->tanggal = $request->tanggal;
        $presensi->ket = $request->ket;
        $presensi->jam_dtg = $request->jam_dtg;
        $presensi->jam_plg = $request->jam_plg;
        $presensi->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect('hrdPresensiHarian');
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
        $presensi = Presensi_harian::find($id);
        $presensi->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('hrdPresensiHarian');
    }

    public function import()
    {
        Excel::import(new PresensiCsvImport, request()->file('file'));
        Alert::success('success', ' Berhasil Import Data !!');
        return redirect('hrdPresensiHarian');
    }

    public function download()
    {
        $filePath = public_path("/storage/template/TemplatePresensi.csv");
        $headers = ['Content-Type: application/pdf'];
        $fileName = 'TemplatePresensi.csv';

        return response()->download($filePath, $fileName, $headers);
    }
}
