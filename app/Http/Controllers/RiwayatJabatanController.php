<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Riwayat_jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatJabatanController extends Controller
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
        $riwayat_jabatan = Riwayat_jabatan::where('id_pegawai', $id)->orderBy('tgl_mulai')->paginate(5);

        return view('admin.riwayatJabatan.detail', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayat_jabatan' => $riwayat_jabatan
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
        $riwayat_jabatan = Riwayat_jabatan::find($id);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');


        return view('admin.riwayatJabatan.edit', [
            'id' => $data,
            'riwayat_jabatan' => $riwayat_jabatan,
            'jabatan' => $jabatan
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
            'id_jabatan' => 'required',
            'tgl_mulai' => 'required',
        ]);
        $encrypt = Crypt::encryptString($request->id_pegawai);

        $riwayat_jabatan = Riwayat_jabatan::find($id);

        $riwayat_jabatan->id_pegawai = $request->id_pegawai;
        $riwayat_jabatan->id_jabatan = $request->id_jabatan;
        $riwayat_jabatan->tgl_mulai = $request->tgl_mulai;
        $riwayat_jabatan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('riwayatJabatan.show', $encrypt));
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
        $riwayat_jabatan = Riwayat_jabatan::find($id);
        $riwayat_jabatan->delete();

        $encrypt = Crypt::encryptString($riwayat_jabatan->id_pegawai);

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('riwayatJabatan.show', $encrypt));
    }
}
