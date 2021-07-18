<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Models\Presensi_harian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //
    public function pegawai(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.pegawai.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function penilaian(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pegawai = Pegawai::where('id_atasan', Auth::user()->id)
                ->orWhere('id_atasan', null)->where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            if (Auth::user()->id_role == 2) {
                $pegawai = Pegawai::where('id_atasan', Auth::user()->id)
                    ->orWhere('id_atasan', null)->where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('id', 'LIKE', '%' . $search . '%')
                    ->paginate(5);
            } elseif (Auth::user()->id_role == 1) {
                $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('id', 'LIKE', '%' . $search . '%')
                    ->paginate(5);
            } else {
                $pegawai = Pegawai::where('id_atasan', Auth::user()->id)
                    ->where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('id', 'LIKE', '%' . $search . '%')
                    ->paginate(5);
            }
            $pegawai->appends($request->all());
            return view('admin.penilaian.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function riwayatJabatan(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.riwayatJabatan.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function riwayatDivisi(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.riwayatDivisi.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function rekapPresensi(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.rekapPresensi.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function presensi(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $dari = $_GET['dari'];
            $ke = $_GET['ke'];

            $presensi = Presensi_harian::whereHas('pegawai', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%');
            })
                ->orWhere('ket', 'LIKE', '%' . $search . '%')
                ->whereBetween('tanggal', [$dari, $ke])
                ->paginate(20);
            $presensi->appends($request->all());
            return view('admin.presensi.index', [
                'presensi' => $presensi,
                'dari' => $dari,
                'ke' => $ke,
            ]);
        }
    }

    public function cuti(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $dari = $_GET['dari'];
            $ke = $_GET['ke'];

            $cuti = Cuti::whereHas('pegawai', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%');
            })
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->orWhere('tipe_cuti', 'LIKE', '%' . $search . '%')
                ->whereBetween('tgl_pengajuan', [$dari, $ke])
                ->paginate(20);
            $cuti->appends($request->all());
            return view('admin.cuti.index', [
                'cuti' => $cuti,
                'dari' => $dari,
                'ke' => $ke,
            ]);
        }
    }

    public function rekapCuti(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.rekapCuti.index', [
                'pegawai' => $pegawai,
            ]);
        }
    }


    public function gaji(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $pageNum = $_GET['page'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.gaji.listPegawai', [
                'pegawai' => $pegawai,
            ]);
        }
    }

    public function report(Request $request)
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
            $year = $_GET['year'];
            $pegawai = Pegawai::where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->paginate(5);
            $pegawai->appends($request->all());
            return view('admin.report.index', [
                'pegawai' => $pegawai,
                'year' => $year,
            ]);
        }
    }
}
