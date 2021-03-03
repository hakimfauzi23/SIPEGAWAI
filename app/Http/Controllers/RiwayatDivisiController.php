<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Divisi;
use App\Models\Riwayat_divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;


class RiwayatDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $pegawai = Pegawai::find($id);
        $riwayat_divisi = Riwayat_divisi::where('id_pegawai', $id)->orderBy('tgl_mulai')->paginate(5);

        return view('admin.riwayatDivisi.detail', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayat_divisi' => $riwayat_divisi
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
        $riwayat_divisi = Riwayat_divisi::find($id);
        $divisi = Divisi::pluck('nm_divisi', 'id');

        return view('admin.riwayatDivisi.edit', [
            'id' => $data,
            'riwayat_divisi' => $riwayat_divisi,
            'divisi' => $divisi
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
            'id_divisi' => 'required',
            'tgl_mulai' => 'required',
        ]);
        $encrypt = Crypt::encryptString($request->id_pegawai);

        $riwayat_divisi = Riwayat_divisi::find($id);

        $riwayat_divisi->id_pegawai = $request->id_pegawai;
        $riwayat_divisi->id_divisi = $request->id_divisi;
        $riwayat_divisi->tgl_mulai = $request->tgl_mulai;
        $riwayat_divisi->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('riwayatDivisi.show', $encrypt));
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
