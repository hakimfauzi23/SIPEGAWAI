<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class TunjanganController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:menu-gaji', ['all']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tunjangan = Tunjangan::all();
        return view('admin.tunjangan.index', [
            'tunjangan' => $tunjangan,
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
        return view('admin.tunjangan.create');
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
            'nama' => 'required',
            'jumlah' => 'required',
        ]);

        $rupiah_string = $request->jumlah;
        $jumlah_string = preg_replace("/[^0-9]/", "", $rupiah_string);
        $jumlah = (int) $jumlah_string;


        Tunjangan::create([
            'nama' => $request->nama,
            'jumlah' => $jumlah,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('tunjangan');
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
        $tunjangan = Tunjangan::find($id);
        return view('admin.tunjangan.edit', [
            'tunjangan' => $tunjangan,
            'id' => $data
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

        $this->validate($request, [
            'nama' => 'required',
            'jumlah' => 'required',
        ]);

        $rupiah_string = $request->jumlah;
        $jumlah_string = preg_replace("/[^0-9]/", "", $rupiah_string);
        $jumlah = (int) $jumlah_string;

        $tunjangan = Tunjangan::find($id);
        $tunjangan->nama = $request->nama;
        $tunjangan->jumlah = $jumlah;
        $tunjangan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect('tunjangan');
    }

    public function isActive(Request $request, $data)
    {
        $id = Crypt::decryptString($data);
        $tunj = Tunjangan::find($id);
        $tunj->is_active = $request->is_active;
        $tunj->save();
        return redirect('tunjangan');
    }
    public function isShown(Request $request, $data)
    {
        $id = Crypt::decryptString($data);
        $tunj = Tunjangan::find($id);
        $tunj->is_shown = $request->is_shown;
        $tunj->save();
        return redirect('tunjangan');
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
        $tunjangan = Tunjangan::find($id);
        $tunjangan->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('/tunjangan');
    }
}
