<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Peraturan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class StaffCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $thisYear = date('Y');

        $cuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->orderBy('tgl_pengajuan', 'desc')
            ->get();
        return view('staff.cuti.index', [
            'cuti' => $cuti,

            'thisYear' => $thisYear,

        ]);
    }


    public function tahunCuti(Request $request)
    {
        //
        $user = Auth::user();
        $thisYear = $request->tahun;

        $cuti = Cuti::where('id_pegawai', $user->id)
            ->whereYear('tgl_mulai', $thisYear)
            ->orderBy('tgl_pengajuan', 'desc')
            ->get();
        return view('staff.cuti.index', [
            'cuti' => $cuti,

            'thisYear' => $thisYear,

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
        $id_peraturan = Peraturan::latest('id')->pluck('id')->first();

        $peraturan = Peraturan::find($id_peraturan);

        $tgl_masuk = Auth::user()->tgl_masuk;
        $tgl_now = date("Y-m-d");
        
        $ts1 = strtotime($tgl_masuk);
        $ts2 = strtotime($tgl_now);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $months = (($year2 - $year1) * 12) + ($month2 - $month1);

        // $date1 = new DateTime($tgl_masuk);
        // $date2 = new DateTime($tgl_now);

        // $interval = $date1->diff($date2);

        // $months = $interval->m;
        // $years = $interval->y;

        $syarat_bulan_cuti_tahunan = $peraturan->syarat_bulan_cuti_tahunan;

        $syarat_bulan_cuti_besar = $peraturan->syarat_bulan_cuti_besar;

        return view('staff.cuti.create', [
            'months' => $months,

            'syarat_bulan_cuti_tahunan' => $syarat_bulan_cuti_tahunan,

            'syarat_bulan_cuti_besar' => $syarat_bulan_cuti_besar,
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
        $id_atasan = Auth::user()->id_atasan;
        $id_pegawai = Auth::user()->id;
        $nama_pegawai = Auth::user()->nama;


        if ($id_atasan == null) {

            $hrd = Pegawai::where('id_role', 2)->get();
            $this->validate($request, [
                'tipe_cuti' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'ket' => 'required',
            ]);

            Cuti::create([
                'id_pegawai' => $id_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
                'status' => "Diproses",
                'tgl_disetujui_atasan' => date("Y-m-d"),
                'tgl_disetujui_hrd' => NULL,
                'tgl_ditolak_atasan' => NULL,
                'tgl_ditolak_hrd' => NULL,
            ]);

            $details = [
                'id_pegawai' => $id_pegawai,
                'nama_pegawai' => $nama_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
            ];

            foreach ($hrd as $key => $p) {

                Mail::to($p->email)->send(new \App\Mail\PengajuanCutiMail($details));
            }


            Alert::success('success', ' Pengajuan Kamu Sedang Diproses!!');
            return redirect('staffCuti');
        } else {

            $email_atasan = Auth::user()->bawahan->email;
            $this->validate($request, [
                'tipe_cuti' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'ket' => 'required',
            ]);

            Cuti::create([
                'id_pegawai' => $id_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
                'status' => "Diproses",
                'tgl_disetujui_atasan' => NULL,
                'tgl_disetujui_hrd' => NULL,
                'tgl_ditolak_atasan' => NULL,
                'tgl_ditolak_hrd' => NULL,
            ]);

            $details = [
                'id_pegawai' => $id_pegawai,
                'nama_pegawai' => $nama_pegawai,
                'tipe_cuti' => $request->tipe_cuti,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'ket' => $request->ket,
            ];


            Mail::to($email_atasan)->send(new \App\Mail\PengajuanCuti2Atasan($details));


            Alert::success('success', ' Pengajuan Kamu Sedang Diproses!!');
            return redirect('staffCuti');
        }
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
        $cuti = Cuti::find($id);

        return view('staff.cuti.details', [
            'cuti' => $cuti,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
