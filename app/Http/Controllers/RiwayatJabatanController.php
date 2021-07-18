<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Divisi;
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

    function __construct()
    {
        $this->middleware('permission:menu-jabatan', ['all']);
    }

    public function index()
    {
        //
        $pegawai = Pegawai::paginate(20);
        return view('admin.riwayatJabatan.index', [
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        //
    }

    public function createData($data)
    {

        $id = Crypt::decryptString($data);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');
        $pegawai = Pegawai::find($id);
        return view('admin.riwayatJabatan.create', [
            'id' => $data,
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
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
            'id_jabatan' => 'required',
            'tgl_mulai' => 'required',
        ]);

        Riwayat_jabatan::create([
            'id_pegawai' => $request->id_pegawai,
            'id_jabatan' => $request->id_jabatan,
            'tgl_mulai' => $request->tgl_mulai,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect(route('riwayatJabatan.show', $request->token));
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
        $riwayatJabatan = Riwayat_jabatan::where('id_pegawai', $id)->orderBy('tgl_mulai')->paginate(5);

        return view('admin.riwayatJabatan.detail', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayatJabatan' => $riwayatJabatan
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
        $riwayatJabatan = Riwayat_jabatan::find($id);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');

        $id_pegawai = Crypt::encryptString($riwayatJabatan->id_pegawai);

        return view('admin.riwayatJabatan.edit', [
            'id' => $data,
            'riwayatJabatan' => $riwayatJabatan,
            'jabatan' => $jabatan,
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
            'id_jabatan' => 'required',
            'tgl_mulai' => 'required',
        ]);

        $encrypt = Crypt::encryptString($request->id_pegawai);
        $riwayatJabatan = Riwayat_jabatan::find($id);

        $riwayatJabatan->id_pegawai = $request->id_pegawai;
        $riwayatJabatan->id_jabatan = $request->id_jabatan;
        $riwayatJabatan->tgl_mulai = $request->tgl_mulai;
        $riwayatJabatan->save();

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
        $riwayatJabatan = Riwayat_jabatan::find($id);
        $encrypt = Crypt::encryptString($riwayatJabatan->id_pegawai);
        dd($encrypt);
        $riwayatJabatan->delete();


        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('riwayatJabatan.show', $encrypt));
    }
}
