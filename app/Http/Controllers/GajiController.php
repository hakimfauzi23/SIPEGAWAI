<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pegawai;
use App\Models\Peraturan;
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


        $pegawai = Pegawai::all();

        $idPegawai = $pegawai->pluck('id');
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
        
        return view('admin.gaji.create', [
            'id' => $data,
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
        $id = Crypt::decryptString($request->data);
        $pegawai = Pegawai::find($id);

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

            // Get Potongan
            $pot = $pegawai->potongan;
            // dd($tunj);
            if ($tunj == null) {
                $tunjangan = 0;
                $att_tunjangan = [];
            } else {
                $tunjangan = $tunj->sum('jumlah');
                $att_tunjangan = $tunj;
            }

            if ($pot == null) {
                $potongan = 0;
                $att_potongan = [];
            } else {
                $potongan = $pot->sum('jumlah');
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


            $jml_tunj = (int)$tunjangan;
            $jml_ptgn = (int)$potongan + $jml_ptgn_telat + $jml_ptgn_bolos;
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


                //Terlambat dan Bolos
                'jml_ptgn_telat' => $jml_ptgn_telat,
                'jml_ptgn_bolos' => $jml_ptgn_bolos,
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
        $data["email"] = 'haniffauzihakim5059@gmail.com';
        $data["title"] = 'SLIP GAJI PERIODE ' . date('F Y', strtotime($gaji->tanggal));
        $data["body"] = 'Halo!! Slip gaji kamu udah ada nih! bisa di download di Email Ini!!';
        $data["nama"] = $pegawai->nama;
        $file = public_path('/slip_gaji/' . $gaji->path);

        Mail::send('emails.sendSlipGaji', $data, function ($message) use ($data, $file) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])->attach($file);
        });

        $gaji->dikirim_tgl = date("Y-m-d");
        $gaji->is_sent = true;
        $gaji->save();

        Alert::success('success', ' Berhasil Mengirim Slip Gaji ke Email Pegawai !');
        return redirect(route('gaji.show', $id_pegawai));
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
