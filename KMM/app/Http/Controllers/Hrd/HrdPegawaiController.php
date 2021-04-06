<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use App\Models\Riwayat_divisi;
use App\Models\Riwayat_jabatan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HrdPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('hrd.pegawai.index', [
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
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');
        $divisi = Divisi::pluck('nm_divisi', 'id');
        $pegawai = Pegawai::pluck('nama', 'id');
        $role = Role::pluck('nm_role', 'id');
        return view('hrd.pegawai.create', [
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'pegawai' => $pegawai,
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
            'id_role' => 'required',
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
            'id_jabatan' => 'required',
            'id_divisi' => 'required',
            'tgl_masuk' => 'required',
            'imgupload' => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
        ]);

        $extension = $request->file('imgupload')->extension();
        $imgname = $request->nik . '_' . date('dmyHi') . '.' . $extension;
        $path = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);
        $id = IdGenerator::generate(['table' => 'pegawai', 'length' => 8, 'prefix' => date('ym')]);
        $password = bcrypt("$request->nik");
        $riwayat_jabatan = Riwayat_jabatan::where('id_pegawai', $id)
            ->where('id_jabatan', $request->id_jabatan)
            ->count();

        $riwayat_divisi = Riwayat_divisi::where('id_pegawai', $id)
            ->where('id_divisi', $request->id_divisi)
            ->count();

        Pegawai::create([
            'id' => $id,
            'id_role' => $request->id_role,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_dom' => $request->alamat_dom,
            'status' => $request->status,
            'jml_anak' => $request->jml_anak,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => $password,
            'tgl_masuk' => $request->tgl_masuk,
            'id_atasan' => $request->id_atasan,
            'id_jabatan' => $request->id_jabatan,
            'id_divisi' => $request->id_divisi,
            'path' => $imgname
        ]);


        if ($riwayat_jabatan == 0) {

            Riwayat_jabatan::create([
                'id_pegawai' => $id,
                'id_jabatan' => $request->id_jabatan,
                'tgl_mulai' => $request->tgl_masuk,
            ]);
        }
        if ($riwayat_divisi == 0) {
            Riwayat_divisi::create([
                'id_pegawai' => $id,
                'id_divisi' => $request->id_divisi,
                'tgl_mulai' => $request->tgl_masuk,
            ]);
        }

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('hrdPegawai');
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
        $riwayat_jabatan = Riwayat_jabatan::where('id_pegawai', $id)
            ->orderBy('id')
            ->get();
        $riwayat_divisi = Riwayat_divisi::where('id_pegawai', $id)
            ->orderBy('id')
            ->get();
        $hadir = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m'))
            ->where('ket', "Hadir")
            ->count();
        $cuti = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m'))
            ->where('ket', "Cuti")
            ->count();
        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m'))
            ->where('ket', "Alpha")
            ->count();


        // dd([$pegawai,$riwayat_jabatan]);
        return view('hrd.pegawai.details', [
            'id' => $id,
            'pegawai' => $pegawai,
            'riwayat_jabatan' => $riwayat_jabatan,
            'riwayat_divisi' => $riwayat_divisi,
            'hadir' => $hadir,
            'cuti' => $cuti,
            'alpha' => $alpha,

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
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');
        $divisi = Divisi::pluck('nm_divisi', 'id');
        $role = Role::pluck('nm_role', 'id');
        $atasan = Pegawai::pluck('nama', 'id');
        return view('hrd.pegawai.edit', [
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
        $id = Crypt::decryptString($data);

        $riwayat_jabatan = Riwayat_jabatan::where('id_pegawai', $id)
            ->where('id_jabatan', $request->id_jabatan)
            ->count();

        $riwayat_divisi = Riwayat_divisi::where('id_pegawai', $id)
            ->where('id_divisi', $request->id_divisi)
            ->count();


        if ($request->hasFile('imgupload')) {



            $extension = $request->file('imgupload')->extension();
            $imgname = $request->nik . '_' . date('dmyHi') . '.' . $extension;
            // dd($imgname);
            $this->validate($request, [
                'id_role' => 'required',
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
                'id_jabatan' => 'required',
                'id_divisi' => 'required',
                'tgl_masuk' => 'required',
                'imgupload' => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
            ]);



            $pegawai = Pegawai::find($id);
            $path = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);


            $pegawai->id_role = $request->id_role;
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
            $pegawai->id_atasan = $request->id_atasan;
            $pegawai->id_jabatan = $request->id_jabatan;
            $pegawai->id_divisi = $request->id_divisi;
            $pegawai->tgl_masuk = $request->tgl_masuk;
            $pegawai->path = $imgname;
            $pegawai->save();

            if ($riwayat_jabatan == 0) {

                Riwayat_jabatan::create([
                    'id_pegawai' => $id,
                    'id_jabatan' => $request->id_jabatan,
                    'tgl_mulai' => date("Y-m-d"),
                ]);
            }
            if ($riwayat_divisi == 0) {
                Riwayat_divisi::create([
                    'id_pegawai' => $id,
                    'id_divisi' => $request->id_divisi,
                    'tgl_mulai' => date("Y-m-d"),
                ]);
            }

            Alert::success('success', ' Berhasil Update Data !');
            return redirect(route('pegawai.show', $data));
        } else {

            $this->validate($request, [
                'id_role' => 'required',
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
                'id_jabatan' => 'required',
                'id_divisi' => 'required',
                'tgl_masuk' => 'required',
            ]);

            $pegawai = Pegawai::find($id);

            $pegawai->id_role = $request->id_role;
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
            $pegawai->id_atasan = $request->id_atasan;
            $pegawai->id_jabatan = $request->id_jabatan;
            $pegawai->id_divisi = $request->id_divisi;
            $pegawai->tgl_masuk = $request->tgl_masuk;
            $pegawai->save();


            if ($riwayat_jabatan == 0) {

                Riwayat_jabatan::create([
                    'id_pegawai' => $id,
                    'id_jabatan' => $request->id_jabatan,
                    'tgl_mulai' => date("Y-m-d"),
                ]);
            }
            if ($riwayat_divisi == 0) {
                Riwayat_divisi::create([
                    'id_pegawai' => $id,
                    'id_divisi' => $request->id_divisi,
                    'tgl_mulai' => date("Y-m-d"),
                ]);
            }


            Alert::success('success', ' Berhasil Update Data !');
            return redirect(route('hrdPegawai.index'));
        }
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
        Pegawai::where('id', $id)->delete();
        // dd($pegawai);

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('hrdPegawai.index'));
    }

    public function showJabatan($data)
    {
        //
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::find($id);
        $riwayatJabatan = Riwayat_jabatan::where('id_pegawai', $id)->orderBy('tgl_mulai')->get();
        return view('hrd.pegawai.showJabatan', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayatJabatan' => $riwayatJabatan
        ]);
    }

    public function editRiwayatJabatan($data)
    {
        $id = Crypt::decryptString($data);
        $riwayatJabatan = Riwayat_jabatan::find($id);
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');

        $id_pegawai = Crypt::encryptString($riwayatJabatan->id_pegawai);

        return view('hrd.pegawai.editRiwayatJabatan', [
            'id' => $data,
            'riwayatJabatan' => $riwayatJabatan,
            'jabatan' => $jabatan,
            'id_pegawai' => $id_pegawai
        ]);
    }

    public function updateRiwayatJabatan(Request $request, $data)
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
        return redirect(route('hrdPegawai.showJabatan', $encrypt));
    }



    public function showDivisi($data)
    {
        //
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::find($id);
        $riwayatDivisi = Riwayat_divisi::where('id_pegawai', $id)->orderBy('tgl_mulai')->paginate(5);

        return view('hrd.pegawai.showDivisi', [
            'id' => $data,
            'pegawai' => $pegawai,
            'riwayatDivisi' => $riwayatDivisi
        ]);
    }


    public function editRiwayatDivisi($data)
    {
        //
        $id = Crypt::decryptString($data);
        $riwayatDivisi = Riwayat_divisi::find($id);
        $divisi = Divisi::pluck('nm_divisi', 'id');

        $id_pegawai = Crypt::encryptString($riwayatDivisi->id_pegawai);

        return view('hrd.pegawai.editRiwayatDivisi', [
            'id' => $data,
            'riwayatDivisi' => $riwayatDivisi,
            'divisi' => $divisi,
            'id_pegawai' => $id_pegawai
        ]);
    }

    public function updateRiwayatDivisi(Request $request, $data)
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
        return redirect(route('hrdPegawai.showDivisi', $encrypt));
    }

    public function trash()
    {
        $pegawai = Pegawai::onlyTrashed()->get();
        return view('hrd.pegawai.resigned', [
            'pegawai' => $pegawai,
        ]);
    }

    public function restore($data)
    {
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->restore();


        Alert::success('success', ' Berhasil Restore Data Pegawai !');
        return redirect('/hrdPegawai/trash');
    }

    public function destroyPermanent($data)
    {
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();

        Alert::success('success', ' Berhasil Menghapus Permanen Data !');
        return redirect('/hrdPegawai/trash');
    }
}
