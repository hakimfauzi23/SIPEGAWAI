<?php

namespace App\Http\Controllers;

use App\Exports\KinerjaExport;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Excel;

class ReportKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-export-kinerja', ['all']);
    }

    public function index()
    {
        //

        $year = date("Y");

        $pegawai = Pegawai::paginate(20);
        return view('admin.report.index', [
            'pegawai' => $pegawai,
            'year' => $year,
        ]);
    }

    public function getList(Request $request)
    {
        $year = $request->year;
        $pegawai = Pegawai::paginate(10);
        $pegawai->appends($request->all());
        return view('admin.report.index', [
            'pegawai' => $pegawai,
            'year' => $year,
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

    public function exportKinerja($id_pegawai, $year)
    {
        $id_peg = Crypt::decryptString($id_pegawai);
        return Excel::download(new KinerjaExport($id_peg, $year), 'Laporan-Kinerja-Tahunan-' . $id_peg . '-' . $year . '.xlsx');
        // dd([$dari, $ke, $id_peg]);
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
    public function show($id)
    {
        //
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
