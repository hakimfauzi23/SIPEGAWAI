<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PenilaianPegawai;
use App\Models\Peraturan;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class PenilaianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_role == 2) {
            $pegawai = Pegawai::where('id_atasan', Auth::user()->id)
                ->orWhere('id_atasan', null)->paginate(20);
        } elseif (Auth::user()->id_role == 1) {
            $pegawai = Pegawai::paginate(20);
        } else {
            $pegawai = Pegawai::where('id_atasan', Auth::user()->id)->paginate(20);
        }
        return view('admin.penilaian.index', [
            'pegawai' => $pegawai,
        ]);
    }

    public function showAll()
    {
        $penilaian = PenilaianPegawai::whereYear('tanggal', date('Y'))
            ->whereMonth('tanggal', date('m'))
            ->orderBy('final_value', 'DESC')
            ->paginate(20);

        return view('admin.penilaian.showAll', [
            'penilaian' => $penilaian,
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
        $pegawai = Pegawai::find($id);


        //Penilaian Kedisiplinan

        $intMonth = date('m');
        $year = date('Y');
        $hari = cal_days_in_month(CAL_GREGORIAN, $intMonth, date('Y'));
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();
        $peraturan = Peraturan::find($id_peraturan);
        $jam_masuk = $peraturan->jam_masuk;
        $jam_plg = $peraturan->jam_plg;

        $alpha = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where('ket', "Alpha")
            ->count();

        $checkData = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->count();

        $jml_nl_kedisiplinan = 0;
        $hadir = ($hari - $alpha) / $hari * 100;
        $persentaseHadir = number_format($hadir, 2);
        $lateAndEarly = Presensi_harian::where('id_pegawai', $id)
            ->whereMonth('tanggal', $intMonth)
            ->whereYear('tanggal', $year)
            ->where(function ($query) use ($jam_masuk, $jam_plg) {
                $query->where('jam_dtg', '>', $jam_masuk)
                    ->orWhere('jam_plg', '<', $jam_plg);
            })->count();

        if ($persentaseHadir >= 95) {
            $jml_nl_kedisiplinan += 100;
        } elseif ($persentaseHadir < 94 && $persentaseHadir > 75) {
            $jml_nl_kedisiplinan += 85;
        } else {
            $jml_nl_kedisiplinan += 60;
        }

        if (($lateAndEarly / 2) == 0) {
            $jml_nl_kedisiplinan += 100;
        } elseif (($lateAndEarly / 2) < 3) {
            $jml_nl_kedisiplinan += 85;
        } else {
            $jml_nl_kedisiplinan += 60;
        }
        $nl_kedisiplinan = $jml_nl_kedisiplinan / 2;


        return view('admin.penilaian.create', [
            'id' => $data,
            'pegawai' => $pegawai,
            'nl_kedisiplinan' => $nl_kedisiplinan,
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
        $id = Crypt::decryptString($request->data);
        $pegawai = Pegawai::find($id);

        $this->validate($request, [
            'responsible' => 'required',
            'initiate' => 'required',
            'teamwork' => 'required',
            'work_performance' => 'required',
            'discipline' => 'required',
        ]);

        $final_value = ($request->responsible + $request->initiate + $request->teamwork + $request->work_performance + $request->discipline) / 5;
        PenilaianPegawai::create([
            'id_pegawai' => $pegawai->id,
            'tanggal' => date('Y-m-d'),
            'responsible' => $request->responsible,
            'initiate' => $request->initiate,
            'teamwork' => $request->teamwork,
            'work_performance' => $request->work_performance,
            'discipline' => $request->discipline,
            'final_value' => $final_value,
        ]);

        Alert::success('success', ' Berhasil Membuat Penilaian Pegawai !');
        return redirect(route('penilaian.show', $request->data));
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
        $penilaian = PenilaianPegawai::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'))
            ->orderBy('tanggal', 'desc')->get();

        return view('admin.penilaian.listPenilaian', [
            'id' => $data,
            'pegawai' => $pegawai,
            'penilaian' => $penilaian,
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
        $penilaian = PenilaianPegawai::find($id);
        $pegawai = Pegawai::find($penilaian->id_pegawai);

        return view('admin.penilaian.edit', [
            'id' => $data,
            'penilaian' => $penilaian,
            'pegawai' => $pegawai,
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
        $penilaian = PenilaianPegawai::find($id);

        $this->validate($request, [
            'responsible' => 'required',
            'initiate' => 'required',
            'teamwork' => 'required',
            'work_performance' => 'required',
            'discipline' => 'required',
        ]);

        $final_value = ($request->responsible + $request->initiate + $request->teamwork + $request->work_performance + $request->discipline) / 5;

        $penilaian->responsible = $request->responsible;
        $penilaian->initiate = $request->initiate;
        $penilaian->teamwork = $request->teamwork;
        $penilaian->work_performance = $request->work_performance;
        $penilaian->discipline = $request->discipline;
        $penilaian->final_value = $final_value;
        $penilaian->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('penilaian.show', Crypt::encryptString($penilaian->id_pegawai)));
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
