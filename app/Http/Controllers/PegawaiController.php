<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\PegawaiPotongan;
use App\Models\PegawaiTunjangan;
use App\Models\Potongan;
use App\Models\Presensi_harian;
use App\Models\Riwayat_divisi;
use App\Models\Riwayat_jabatan;
use App\Models\Role;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-pegawai', ['all']);
    }

    public function index()
    {
        //
        $pegawai = Pegawai::paginate(20);
        return view('admin.pegawai.index', [
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
        $role = Role::pluck('name', 'id');
        $tunjangan = Tunjangan::get();
        $potongan = Potongan::where('is_active', true)->get();
        return view('admin.pegawai.create', [
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'pegawai' => $pegawai,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,

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
        $user = Pegawai::create([
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

        $int = (int)$request->id_role;

        // Asign Role
        $user->assignRole($int);

        //Asign Tunjangan
        $tunjangan = $request->tunjangan;
        $user->tunjangan()->attach($tunjangan);

        //Asign Potongan
        $potongan = $request->potongan;
        $user->potongan()->attach($potongan);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('pegawai');
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
        return view('admin.pegawai.details', [
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
        $role = Role::pluck('name', 'id');
        $atasan = Pegawai::pluck('nama', 'id');
        $tunjangan = Tunjangan::get();
        $potongan = Potongan::where('is_active', true)->get();

        $pegawaiTunjangan = PegawaiTunjangan::where('pegawai_id', $id)
            ->pluck('tunjangan_id', 'tunjangan_id')->all();
        $pegawaiPotongan = PegawaiPotongan::where('pegawai_id', $id)
            ->pluck('potongan_id', 'potongan_id')->all();

        return view('admin.pegawai.edit', [
            'id' => $data,
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'atasan' => $atasan,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'pegawaiTunjangan' => $pegawaiTunjangan,
            'pegawaiPotongan' => $pegawaiPotongan,
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

            $input = $request->all();
            $pegawai = Pegawai::find($id);
            $pegawai->update($input);

            //Sync Potongan & Tunjangan Pivot Table
            $pegawai->tunjangan()->sync($request->tunjangan);
            $pegawai->potongan()->sync($request->potongan);

            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $int = (int)$request->id_role;
            $pegawai->assignRole($int);

            // $pegawai->id_role = $request->id_role;
            // $pegawai->nik = $request->nik;
            // $pegawai->nama = $request->nama;
            // $pegawai->jk = $request->jk;
            // $pegawai->agama = $request->agama;
            // $pegawai->tempat_lahir = $request->tempat_lahir;
            // $pegawai->tgl_lahir = $request->tgl_lahir;
            // $pegawai->alamat_ktp = $request->alamat_ktp;
            // $pegawai->alamat_dom = $request->alamat_dom;
            // $pegawai->status = $request->status;
            // $pegawai->jml_anak = $request->jml_anak;
            // $pegawai->no_hp = $request->no_hp;
            // $pegawai->email = $request->email;
            // $pegawai->id_atasan = $request->id_atasan;
            // $pegawai->id_jabatan = $request->id_jabatan;
            // $pegawai->id_divisi = $request->id_divisi;
            // $pegawai->tgl_masuk = $request->tgl_masuk;
            // $pegawai->path = $imgname;
            // $pegawai->save();

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

            $input = $request->all();
            $pegawai = Pegawai::find($id);
            $pegawai->update($input);

            //Sync Potongan & Tunjangan Pivot Table
            $pegawai->tunjangan()->sync($request->tunjangan);
            $pegawai->potongan()->sync($request->potongan);

            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $int = (int)$request->id_role;
            $pegawai->assignRole($int);

            // $pegawai->id_role = $request->id_role;
            // $pegawai->nik = $request->nik;
            // $pegawai->nama = $request->nama;
            // $pegawai->jk = $request->jk;
            // $pegawai->agama = $request->agama;
            // $pegawai->tempat_lahir = $request->tempat_lahir;
            // $pegawai->tgl_lahir = $request->tgl_lahir;
            // $pegawai->alamat_ktp = $request->alamat_ktp;
            // $pegawai->alamat_dom = $request->alamat_dom;
            // $pegawai->status = $request->status;
            // $pegawai->jml_anak = $request->jml_anak;
            // $pegawai->no_hp = $request->no_hp;
            // $pegawai->email = $request->email;
            // $pegawai->id_atasan = $request->id_atasan;
            // $pegawai->id_jabatan = $request->id_jabatan;
            // $pegawai->id_divisi = $request->id_divisi;
            // $pegawai->tgl_masuk = $request->tgl_masuk;
            // $pegawai->save();


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
            return redirect(route('pegawai.index'));
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
        return redirect(route('pegawai.index'));
    }


    public function trash()
    {
        $pegawai = Pegawai::onlyTrashed()->get();
        return view('admin.pegawai.resigned', [
            'pegawai' => $pegawai,
        ]);
    }

    public function restore($data)
    {
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->restore();


        Alert::success('success', ' Berhasil Restore Data Pegawai !');
        return redirect('/pegawai/trash');
    }

    public function destroyPermanent($data)
    {
        $id = Crypt::decryptString($data);
        $pegawai = Pegawai::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();

        Alert::success('success', ' Berhasil Menghapus Permanen Data !');
        return redirect('/pegawai/trash');
    }
}
