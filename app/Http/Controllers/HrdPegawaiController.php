<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Cuti;
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
        //
        $currentPage = 'HRD';
        $pegawai = Pegawai::sortable()->paginate(15);
        return view('user.hrd.pegawai.index', [
            'pegawai' => $pegawai,
            'currentPage' => $currentPage,
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
        $currentPage = 'HRD';
        $jabatan = Jabatan::pluck('nm_jabatan', 'id');
        $divisi = Divisi::pluck('nm_divisi', 'id');
        $role = Role::pluck('nm_role', 'id');
        return view('user.hrd.pegawai.create', [
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'currentPage' => $currentPage,
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
        $password = Str::random(12);
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

        $currentPage = 'HRD';

        // dd([$pegawai,$riwayat_jabatan]);
        return view('user.hrd.pegawai.details', [
            'id' => $id,
            'pegawai' => $pegawai,
            'riwayat_jabatan' => $riwayat_jabatan,
            'riwayat_divisi' => $riwayat_divisi,
            'hadir' => $hadir,
            'cuti' => $cuti,
            'alpha' => $alpha,
            'currentPage' => $currentPage,

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
        $currentPage = 'HRD';
        return view('user.hrd.pegawai.edit', [
            'id' => $data,
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'divisi' => $divisi,
            'role' => $role,
            'currentPage' => $currentPage,

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
            $pegawai->id_jabatan = $request->id_jabatan;
            $pegawai->id_divisi = $request->id_divisi;
            $pegawai->tgl_masuk = $request->tgl_masuk;
            $pegawai->password = $request->password;
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
            return redirect(route('hrdPegawai.show', $data));
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
            $pegawai->id_jabatan = $request->id_jabatan;
            $pegawai->id_divisi = $request->id_divisi;
            $pegawai->tgl_masuk = $request->tgl_masuk;
            $pegawai->password = $request->password;
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
            return redirect(route('hrdPegawai.show', $data));
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
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('hrdPegawai.index'));
    }

    public function rekapKinerja($data)
    {
        $id_pegawai = Crypt::decryptString($data);
        $pegawai = Pegawai::find($id_pegawai);
        $hari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $kehadiran = Presensi_harian::where('id_pegawai', $id_pegawai)
            ->whereMonth('tanggal', date("m"))
            ->where('ket', '==', 'Alpha')
            ->count();

        $presensiTdkHadir = Presensi_harian::sortable()
            ->where('id_pegawai', $id_pegawai)
            ->where('ket', '!=', 'Hadir')
            ->whereMonth('tanggal', date('m'))
            ->orderBy('tanggal', 'desc')
            ->paginate(3, ['*'], 'presensi');

        $hadir = ($hari - $kehadiran) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $TdkHadir = 100 - $persentaseHadir;
        $persentaseTdkHadir = number_format($TdkHadir, 2);
        // dd($hadir);

        //Cuti
        $tahunan = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Tahunan')
            ->where('status', 'Disetujui')
            ->count();

        $besar = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Besar')
            ->where('status', 'Disetujui')
            ->count();

        $bersama = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Bersama')
            ->where('status', 'Disetujui')
            ->count();

        $hamil = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Hamil')
            ->where('status', 'Disetujui')
            ->count();

        $sakit = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Sakit')
            ->where('status', 'Disetujui')
            ->count();

        $penting = Cuti::where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('tipe_cuti', 'Penting')
            ->where('status', 'Disetujui')
            ->count();

        $cuti = Cuti::sortable()
            ->where('id_pegawai', $id_pegawai)
            ->whereMonth('tgl_mulai', date("m"))
            ->where('status', 'Disetujui')
            ->orderBy('tgl_mulai', 'desc')
            ->paginate(3, ['*'], 'cuti');




        // dd($tahunan);

        $currentPage = 'HRD';

        return view('user.hrd.pegawai.rekapKinerja', [
            'presensiTdkHadir' => $presensiTdkHadir,
            'id_pegawai' => $data,
            'pegawai' => $pegawai,
            'persentaseHadir' => $persentaseHadir,
            'persentaseTdkHadir' => $persentaseTdkHadir,
            'currentPage' => $currentPage,

            //Cuti
            'tahunan' => $tahunan,
            'besar' => $besar,
            'bersama' => $bersama,
            'hamil' => $hamil,
            'sakit' => $sakit,
            'penting' => $penting,
            'cuti' => $cuti,
        ]);
    }

    public function search(Request $request)
    {
        $cari = $request->cari;
        $currentPage = 'HRD';

        $pegawai = Pegawai::where('nama', 'like', "%" . $cari . "%")
            ->paginate(10);

        return view('user.hrd.pegawai.search', [
            'pegawai' => $pegawai,
            'currentPage' => $currentPage,
        ]);
    }
}
