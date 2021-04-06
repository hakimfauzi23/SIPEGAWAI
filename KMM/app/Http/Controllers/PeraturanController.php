<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $peraturan = Peraturan::find(1);
        return view('admin.peraturan.index', [
            'peraturan' => $peraturan,
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

    public function jamMasuk(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jam_masuk = $request->jam_masuk;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function jamPulang(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jam_plg = $request->jam_plg;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function cutiTahunan(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_tahunan = $request->jml_cuti_tahunan;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }



    public function cutiBersama(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_bersama = $request->jml_cuti_bersama;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function cutiPenting(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_penting = $request->jml_cuti_penting;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function cutiSakit(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_sakit = $request->jml_cuti_sakit;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function cutiBesar(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_besar = $request->jml_cuti_besar;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function cutiHamil(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->jml_cuti_hamil = $request->jml_cuti_hamil;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }

    public function syarTahunan(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->syarat_bulan_cuti_tahunan = $request->syarat_bulan_cuti_tahunan;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
    }


    public function syarBesar(Request $request, $data)
    {
        $id = Crypt::decrypt($data);

        $peraturan = Peraturan::find($id);

        $peraturan->syarat_bulan_cuti_besar = $request->syarat_bulan_cuti_besar;
        $peraturan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect(route('peraturan.index'));
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
