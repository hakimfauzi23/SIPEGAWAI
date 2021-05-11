<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use App\Models\Riwayat_divisi;
use App\Models\Riwayat_jabatan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
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

        $id = Crypt::decrypt($data);
        $pegawai = Pegawai::find($id);
        $riwayat_jabatan = Riwayat_jabatan::where('id_pegawai', $id)
            ->orderBy('id')
            ->get();
        $riwayat_divisi = Riwayat_divisi::where('id_pegawai', $id)
            ->orderBy('id')
            ->get();

        // dd([$pegawai,$riwayat_jabatan]);
        return view('profil.show', [
            'data' => $data,
            'id' => $id,
            'pegawai' => $pegawai,
            'riwayat_jabatan' => $riwayat_jabatan,
            'riwayat_divisi' => $riwayat_divisi,

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
        $id = Crypt::decrypt($data);
        // dd($id);
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');
        $divisi = Divisi::pluck('nm_divisi', 'id');
        $role = Role::pluck('name', 'id');
        $atasan = Pegawai::pluck('nama', 'id');
        return view('profil.edit', [
            'id' => $data,
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'atasan' => $atasan,
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
        $id = Crypt::decrypt($data);

        if ($request->hasFile('imgupload')) {



            $extension = $request->file('imgupload')->extension();
            $imgname = $request->nik . '_' . date('dmyHi') . '.' . $extension;
            // dd($imgname);
            $this->validate($request, [
                'nik' => 'required',
                'nama' => 'required',
                'jk' => 'required',
                'agama' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'alamat_ktp' => 'required',
                'alamat_dom' => 'required',
                'status' => 'required',
                'jml_anak' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
                'imgupload' => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
            ]);



            $pegawai = Pegawai::find($id);
            $path = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);


            $pegawai->nik = $request->nik;
            $pegawai->nama = $request->nama;
            $pegawai->jk = $request->jk;
            $pegawai->agama = $request->agama;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tgl_lahir = $request->tgl_lahir;
            $pegawai->alamat_ktp = $request->alamat_ktp;
            $pegawai->alamat_dom = $request->alamat_dom;
            $pegawai->status = $request->status;
            $pegawai->jml_anak = $request->jml_anak;
            $pegawai->no_hp = $request->no_hp;
            $pegawai->email = $request->email;
            $pegawai->path = $imgname;
            $pegawai->save();

            Alert::success('success', ' Berhasil Update Profile !');
            return redirect(route('profil.show', $data));
        } else {

            $this->validate($request, [
                'nik' => 'required',
                'nama' => 'required',
                'jk' => 'required',
                'agama' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'alamat_ktp' => 'required',
                'alamat_dom' => 'required',
                'status' => 'required',
                'jml_anak' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
            ]);

            $pegawai = Pegawai::find($id);

            $pegawai->nik = $request->nik;
            $pegawai->nama = $request->nama;
            $pegawai->jk = $request->jk;
            $pegawai->agama = $request->agama;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tgl_lahir = $request->tgl_lahir;
            $pegawai->alamat_ktp = $request->alamat_ktp;
            $pegawai->alamat_dom = $request->alamat_dom;
            $pegawai->status = $request->status;
            $pegawai->jml_anak = $request->jml_anak;
            $pegawai->no_hp = $request->no_hp;
            $pegawai->email = $request->email;
            $pegawai->save();



            Alert::success('success', ' Berhasil Update Profile !');
            return redirect(route('profil.show', $data));
        }
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
