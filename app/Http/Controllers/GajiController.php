<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use App\Models\PenilaianPegawai;
use App\Models\Peraturan;
use App\Models\Perusahaan;
use App\Models\Potongan;
use App\Models\Presensi_harian;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Echo_;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $pegawai = Pegawai::paginate(20);

        return view('admin.gaji.listPegawai', [
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
        $pegawai = Pegawai::find($id);

        // Get Tunjangan
        $tunjangan = $pegawai->tunjangan;

        // Get Potongan
        $potongan = $pegawai->potongan;

        // Get Tunjangan Status
        $tunj_status = Tunjangan::where('nama', 'LIKE', '%keluarga%')->first();

        // Get Tunjangan Anak
        $tunj_anak = Tunjangan::where('nama', 'LIKE', '%anak%')->first();

        // Get Status
        $status = $pegawai->status;

        // Get Jumlah Anak
        $jml_anak = $pegawai->jml_anak;
        if ($jml_anak > 2) {
            $jml_anak = 2;
        }

        // Process tunjangan kinerja
        $haystackPeg = PenilaianPegawai::whereYear('tanggal', date('Y'))
            ->whereMonth('tanggal', date('m'))
            ->orderBy('final_value', 'desc')
            ->paginate(10)->pluck('id_pegawai');

        $tunj_kinerja = 0;

        if (in_array($id, json_decode($haystackPeg)) === true) {
            $tunj_kinerja = Tunjangan::where('nama', 'LIKE', '%kinerja%')->first();
        }

        // Process potongan BPJS Kesehatan
        $pot_bpjs_kes = Potongan::where('nama', 'LIKE', '%kesehatan%')->first();
        $hsl_bpjs_kes = 0;
        if ($pegawai->jabatan->gaji_pokok < 12000000) {

            $hsl_bpjs_kes = + (0.01 * $pegawai->jabatan->gaji_pokok);
        } else {

            $hsl_bpjs_kes = + (0.01 * 12000000);
        }

        // Process potongan BPJS Ketenagakerjaan
        $pot_bpjs_ket = Potongan::where('nama', 'LIKE', '%kerjaan%')->first();
        $hsl_bpjs_ket = 0.02 * $pegawai->jabatan->gaji_pokok;


        return view('admin.gaji.create', [
            'id' => $data,
            'pegawai' => $pegawai,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'jml_anak' => $jml_anak,
            'status' => $status,
            'tunj_status' => $tunj_status,
            'tunj_anak' => $tunj_anak,
            'tunj_kinerja' => $tunj_kinerja,
            'pot_bpjs_kes' => $pot_bpjs_kes,
            'hsl_bpjs_kes' => $hsl_bpjs_kes,
            'pot_bpjs_ket' => $pot_bpjs_ket,
            'hsl_bpjs_ket' => $hsl_bpjs_ket,
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
        $id = Crypt::decryptString($request->data);
        $pegawai = Pegawai::find($id);
        // Get Status
        $status = $pegawai->status;

        // Get Jumlah Anak
        $jml_anak = $pegawai->jml_anak;
        if ($jml_anak > 2) {
            $jml_anak = 2;
        }


        $this->validate($request, [
            'dari' => 'required',
            'ke' => 'required',
        ]);

        $period_dari = $request->dari;
        $period_ke = $request->ke;

        $status = Gaji::where('id_pegawai', $id)
            ->whereMonth('tanggal', date('m', strtotime($period_dari)))->whereYear('tanggal', date('Y', strtotime($period_dari)))->count();

        if ($status != 0) {
            Alert::error('warning', ' Slip Dengan Periode Gaji Yang Baru Anda Buat Sudah Ada, Hapus Slip Gaji Lama Terlebih Dahulu!!');
            return redirect(route('gaji.show', $request->data));
        } else {

            // Get Peraturan untuk keperluan keterlambatan dan Lembur
            $id_peraturan = Peraturan::latest('id')->pluck('id')->first();
            $peraturan = Peraturan::find($id_peraturan);
            $jam_masuk = $peraturan->jam_masuk;
            $jam_plg = $peraturan->jam_plg;


            //Get Gaji Pokok
            $gaji_pokok = (int)$request->gaji_pokok;

            // Get Tunjangan
            $tunj = $pegawai->tunjangan;

            // Get Value Tunjangan
            $tunj_ori = $request->tunj_ori;
            $tunj_status = $request->tunj_status;
            $tunj_anak = $request->tunj_anak;
            $tunj_kinerja = $request->tunj_kinerja;

            // Get Potongan
            $pot = $pegawai->potongan;

            // Get Value Potongan
            $pot_ori = $request->pot_ori;
            $pot_bpjs_kes = $request->pot_bpjs_kes;
            $pot_bpjs_ket = $request->pot_bpjs_ket;

            if ($tunj_ori == null && $tunj_anak == null && $tunj_status == null && $tunj_kinerja == null) {
                $tunjangan = 0;
                $att_tunjangan = [];
            } else {
                $tunjangan = $tunj_ori + $tunj_status + $tunj_anak + $tunj_kinerja;
                $att_tunjangan = $tunj;
            }

            if ($pot_ori == null && $pot_bpjs_kes == null && $pot_bpjs_ket) {
                $potongan = 0;
                $att_potongan = [];
            } else {
                $potongan = $pot_ori + $pot_bpjs_kes + $pot_bpjs_ket;
                $att_potongan = $pot;
            }

            //Potongan Terlambat & Alpha
            $telat = Presensi_harian::where('id_pegawai', $id)
                ->whereMonth('tanggal', date('m', strtotime($period_dari)))
                ->whereYear('tanggal', date('Y', strtotime($period_dari)))
                ->where('jam_dtg', '>', $jam_masuk)
                ->count();

            $bolos = Presensi_harian::where('id_pegawai', $id)
                ->whereMonth('tanggal', date('m', strtotime($period_dari)))
                ->whereYear('tanggal', date('Y', strtotime($period_dari)))
                ->where('ket', "Alpha")
                ->count();

            $pot_telat = Potongan::where('nama', 'like', "%terlambat%")->pluck('jumlah')->first();
            $pot_bolos = Potongan::where('nama', 'like', "%bolos%")->pluck('jumlah')->first();
            $jml_ptgn_telat = $telat * $pot_telat;
            $jml_ptgn_bolos = $bolos * $pot_bolos;


            $perusahaan = Perusahaan::orderBy('id', 'desc')->first();
            $jml_tunj = (int)$tunjangan;
            // Process potongan PPH 21
            $ptkp = 0;
            if ($status == 'Menikah' && $jml_anak != 0) {
                $ptkp += (54000000 + 4500000 + ($jml_anak * 4500000));
            } elseif ($status == 'Lajang' && $jml_anak != 0) {
                $ptkp += (54000000 + ($jml_anak * 4500000));
            } else {
                $ptkp += 54000000;
            }

            $gaji_pokok_tahunan = 12 * $pegawai->jabatan->gaji_pokok;
            $jml_tunj_tahunan = 12 * $tunjangan;
            $jml_potongan_tahunan = 12 * $potongan;

            $upah_neto = (($gaji_pokok_tahunan + $jml_tunj_tahunan) - $jml_potongan_tahunan);

            $pkp = $upah_neto - $ptkp;
            $pkp_op = $pkp;
            $pph_terhutang = 0;

            if ($pkp <= 50000000) {
                $pph_terhutang += 0.05 * $pkp;
            } elseif ($pkp >= 5000000 && $pkp <= 250000000) {
                $pph_terhutang += 0.05 * 50000000;
                $pkp_op -= 50000000;
                $pph_terhutang += 0.15 * $pkp_op;
            } else {
                $pph_terhutang += 0.05 * 50000000;
                $pkp_op -= 50000000;
                $pph_terhutang += 0.15 * 250000000;
                $pkp_op -= 250000000;
                $pph_terhutang += 0.25 * $pkp_op;
            }

            $jml_ptgn_pph = $pph_terhutang / 12;
            $jml_ptgn = (int)$potongan + $jml_ptgn_telat + $jml_ptgn_bolos + $jml_ptgn_pph;
            $tot_gaji_diterima = ($gaji_pokok + $jml_tunj) - $jml_ptgn;
            $tot_pemasukan = $gaji_pokok + $jml_tunj;

            $data  = [
                'att_tunjangan' => $att_tunjangan,
                'att_potongan' => $att_potongan,
                'jml_tunj' => $jml_tunj,
                'jml_ptgn' => $jml_ptgn,
                'tot_gaji_diterima' => $tot_gaji_diterima,
                'pegawai' => $pegawai,
                'gaji_pokok' => $gaji_pokok,
                'tot_pemasukan' => $tot_pemasukan,
                'period_dari' => $period_dari,
                'period_ke' => $period_ke,
                'telat' => $telat,
                'perusahaan' => $perusahaan,


                //Terlambat dan Bolos
                'jml_ptgn_telat' => $jml_ptgn_telat,
                'jml_ptgn_bolos' => $jml_ptgn_bolos,

                //Tunjangan Keluarga & Anak
                'tunj_status' => $tunj_status,
                'tunj_anak' => $tunj_anak,
                'tunj_kinerja' => $tunj_kinerja,

                //Potongan BPJS KES & KET
                'pot_bpjs_kes' => $pot_bpjs_kes,
                'pot_bpjs_ket' => $pot_bpjs_ket,

                //Potongan PPH per Bulan
                'pot_pph' => $jml_ptgn_pph,
            ];

            $pdf = PDF::loadView('admin.gaji.gaji_pdf', $data)->setPaper('a4', 'potrait');;

            // return $pdf->download('pdf_file.pdf');

            $path = $id . '_' . date('m-Y', strtotime($period_dari)) . '.pdf';

            $pdf->save('slip_gaji/' . $path);

            Gaji::create([
                'id_pegawai' => $id,
                'tanggal' => $period_dari,
                'gaji_pokok' => $gaji_pokok,
                'jml_tunjangan' => $jml_tunj,
                'jml_potongan' => $jml_ptgn,
                'tot_gaji_diterima' => $tot_gaji_diterima,
                'path' => $path,
            ]);

            Alert::success('success', ' Berhasil Membuat Slip Gaji !');
            return redirect(route('gaji.show', $request->data));
        }
    }

    public function downloadSlipGaji($data)
    {

        $path = Crypt::decryptString($data);

        $filePath = public_path("/slip_gaji/" . $path);
        $headers = ['Content-Type: application/pdf'];
        $fileName = 'Slip Gaji_' . $path;

        return response()->download($filePath, $fileName, $headers);
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
        $slipGaji = Gaji::where('id_pegawai', $id)
            ->whereYear('tanggal', date('Y'))
            ->orderBy('tanggal', 'desc')->get();

        return view('admin.gaji.listSlipGaji', [
            'id' => $data,
            'pegawai' => $pegawai,
            'slipGaji' => $slipGaji
        ]);
    }


    public function sendEmail($id_pegawai, $id_gaji)
    {
        $id_peg = Crypt::decryptString($id_pegawai);
        $id_gaji1 = Crypt::decryptString($id_gaji);

        $gaji = Gaji::find($id_gaji1);
        $pegawai = Pegawai::find($id_peg);

        // $data["email"] = Pegawai::where('id', $id_peg)->pluck('email')->first();
        $data["email"] = $pegawai->email;
        $data["title"] = 'SLIP GAJI PERIODE ' . date('F Y', strtotime($gaji->tanggal));
        $data["body"] = 'Halo!! Slip gaji kamu udah ada nih! bisa di download di Email Ini!!';
        $data["nama"] = $pegawai->nama;
        $file = public_path('/slip_gaji/' . $gaji->path);

        try {
            Mail::send('emails.sendSlipGaji', $data, function ($message) use ($data, $file) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"])->attach($file);
            });

            $gaji->dikirim_tgl = date("Y-m-d");
            $gaji->is_sent = true;
            $gaji->save();

            Alert::success('success', ' Berhasil Mengirim Slip Gaji ke Email Pegawai !');
            return redirect(route('gaji.show', $id_pegawai));
        } catch (\Exception $ex) {
            Alert::error('error', 'Gagal! cek kembali pengaturan gmail anda');
            return redirect(route('gaji.show', $id_pegawai));
        }
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
    public function destroy($data)
    {
        //

        $id = Crypt::decryptString($data);
        $gaji = Gaji::find($id);
        $encrypt = Crypt::encryptString($gaji->id_pegawai);
        File::delete(public_path('/slip_gaji/' . $gaji->path));
        $gaji->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('gaji.show', $encrypt));
    }
}
