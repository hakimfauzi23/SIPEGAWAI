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

    function __construct()
    {
        $this->middleware('permission:menu-divisi', ['all']);
    }

    public function index()
    {
        //
        $pegawai = Pegawai::paginate(20);
        return view('admin.riwayatDivisi.index', [
            'pegawai' => $pegawai,
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


    public function createData($data)
    {
        $id = Crypt::decryptString($data);
        $divisi = Divisi::pluck('nm_divisi', 'id');
        $pegawai = Pegawai::find($id);
        return view('admin.riwayatDivisi.create', [
            'id' => $data,
            'pegawai' => $pegawai,
            'divisi' => $divisi,
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
            'id_divisi' => 'required',
            'tgl_mulai' => 'required',
        ]);

        Riwayat_divisi::create([
            'id_pegawai' => $request->id_pegawai,
            'id_divisi' => $request->id_divisi,
            'tgl_mulai' => $request->tgl_mulai,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect(route('riwayatDivisi.show', $request->token));
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
        $riwayatDivisi = Riwayat_divisi::where('id_pegawai', $id)->orderBy('tgl_mulai')->paginate(5);

        return view('admin.riwayatDivisi.detail', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayatDivisi' => $riwayatDivisi
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
        $riwayatDivisi = Riwayat_divisi::find($id);
        $divisi = Divisi::pluck('nm_divisi', 'id');

        $id_pegawai = Crypt::encryptString($riwayatDivisi->id_pegawai);

        return view('admin.riwayatDivisi.edit', [
            'id' => $data,
            'riwayatDivisi' => $riwayatDivisi,
            'divisi' => $divisi,
            'id_pegawai' => $id_pegawai
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

        $riwayatDivisi = Riwayat_divisi::find($id);

        $riwayatDivisi->id_pegawai = $request->id_pegawai;
        $riwayatDivisi->id_divisi = $request->id_divisi;
        $riwayatDivisi->tgl_mulai = $request->tgl_mulai;
        $riwayatDivisi->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('riwayatDivisi.show', $encrypt));
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
        $riwayatDivisi = Riwayat_divisi::find($id);
        $riwayatDivisi->delete();

        $encrypt = Crypt::encryptString($riwayatDivisi->id_pegawai);

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('riwayatDivisi.show', $encrypt));
    }
}
