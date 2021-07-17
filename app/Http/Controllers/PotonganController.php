<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class PotonganController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:menu-gaji', ['only' => ['index', 'destroy', 'store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $potongan = Potongan::all();
        return view('admin.potongan.index', [
            'potongan' => $potongan,
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
        return view('admin.potongan.create');
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


        Potongan::create([
            'nama' => $request->nama,
            'jumlah' => $jumlah,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('potongan');
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
    public function edit($data)
    {
        //

        $id = Crypt::decryptString($data);
        $potongan = Potongan::find($id);
        return view('admin.potongan.edit', [
            'potongan' => $potongan,
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

        $potongan = Potongan::find($id);
        $potongan->nama = $request->nama;
        $potongan->jumlah = $jumlah;
        $potongan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect('potongan');
    }
    public function isActive(Request $request, $data)
    {
        $id = Crypt::decryptString($data);
        $tunj = Potongan::find($id);
        $tunj->is_active = $request->is_active;
        $tunj->save();
        return redirect('potongan');
    }
    public function isShown(Request $request, $data)
    {
        $id = Crypt::decryptString($data);
        $tunj = Potongan::find($id);
        $tunj->is_shown = $request->is_shown;
        $tunj->save();
        return redirect('potongan');
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
        $potongan = Potongan::find($id);
        $potongan->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('potongan');
    }
}
