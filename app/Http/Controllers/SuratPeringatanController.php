<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Perusahaan;
use App\Models\SuratPeringatan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class SuratPeringatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-surat-peringatan', ['all']);
    }

    public function index()
    {
        //
        $dari = date("Y-01-01");
        $ke = date("Y-12-31");
        $suratPeringatan = SuratPeringatan::orderBy('id', 'desc')->get();

        return view('admin.suratPeringatan.index', [
            'suratPeringatan' => $suratPeringatan,
            'dari' => $dari,
            'ke' => $ke,

        ]);
    }

    public function searchSurat(Request $request)
    {
        $dari = $request->dari;
        $ke = $request->ke;
        $suratPeringatan = SuratPeringatan::orderBy('id', 'desc')->get();

        return view('admin.suratPeringatan.index', [
            'suratPeringatan' => $suratPeringatan,
            'dari' => $dari,
            'ke' => $ke,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::pluck('nama', 'id');
        return view('admin.suratPeringatan.create', [
            'pegawai' => $pegawai
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
            'id_pegawai' => 'required',
            'pelanggaran' => 'required',
        ]);

        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }


        $pelanggaran = $request->pelanggaran;
        $id_pegawai = $request->id_pegawai;
        $tingkat = $request->tingkat;
        $pelanggaran = $request->pelanggaran;

        $newSp = SuratPeringatan::create([
            'id_pegawai' => $id_pegawai,
            'tanggal' => date('Y-m-d'),
            'tingkat' => $tingkat,
            'pelanggaran' => $pelanggaran,
        ]);

        $pegawai = Pegawai::find($id_pegawai);
        $bulan = numberToRomanRepresentation(date('m'));
        $tahun = date('Y');
        $lastIncreament = substr($newSp->id, -3);
        $id_surat = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $perusahaan = Perusahaan::orderBy('id', 'desc')->first();

        $data = [
            'pegawai' => $pegawai,
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('Y-m-d'),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_surat' => $id_surat,
            'perusahaan' => $perusahaan,
        ];

        if ($tingkat == 'I') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($tingkat == 'II') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat2_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($tingkat == 'III') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat3_pdf', $data)->setPaper('a4', 'potrait');;
        }

        $email["email"] = $pegawai->email;
        $email["title"] = 'SURAT PERINGATAN ';
        $email["body"] = 'PENERBITAN SURAT';
        $email["nama"] = $pegawai->nama;

        try {
            Mail::send('emails.sendSuratPeringatan', $email, function ($message) use ($email, $pdf, $pegawai) {
                $message->to($email["email"], $email["email"])
                    ->subject($email["title"])->attachData($pdf->output(), "Surat-Peringatan-" . $pegawai->nama . ".pdf");
            });

            Alert::success('success', ' Berhasil Membuat Surat Peringatan & Dikirim ke Email Pegawai !');
            return redirect(route('suratPeringatan.index'));
        } catch (\Exception $ex) {
            Alert::error('error', 'Gagal! cek kembali pengaturan gmail anda');
            $Destorysurat = SuratPeringatan::find($newSp->id);
            $Destorysurat->delete();
            return redirect(route('suratPeringatan.create'));
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
        $suratPeringatan = SuratPeringatan::find($id);

        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }

        $pelanggaran = $suratPeringatan->pelanggaran;
        $id_pegawai = $suratPeringatan->id_pegawai;
        $tingkat = $suratPeringatan->tingkat;
        $pelanggaran = $suratPeringatan->pelanggaran;


        $pegawai = Pegawai::find($id_pegawai);
        $bulan = numberToRomanRepresentation(date('m', strtotime($suratPeringatan->tanggal)));
        $tahun = date('Y', strtotime($suratPeringatan->tanggal));
        $lastIncreament = substr($suratPeringatan->id, -3);
        $id_surat = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $perusahaan = Perusahaan::orderBy('id', 'desc')->first();

        $data = [
            'pegawai' => $pegawai,
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('Y-m-d', strtotime($suratPeringatan->tanggal)),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_surat' => $id_surat,
            'perusahaan' => $perusahaan,

        ];

        if ($tingkat == 'I') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($tingkat == 'II') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat2_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($tingkat == 'III') {
            $pdf = PDF::loadView('admin.suratPeringatan.surat3_pdf', $data)->setPaper('a4', 'potrait');;
        }

        return $pdf->stream('pdf_file.pdf', array('Attachment' => 0));
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
        $suratPeringatan = SuratPeringatan::find($id);
        $suratPeringatan->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect(route('suratPeringatan.index'));
    }
}
