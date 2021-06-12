<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;


class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-divisi', ['all']);
    }

    public function index()
    {
        //
        $divisi = Divisi::all();
        return view('admin.divisi.index', ['divisi' => $divisi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.divisi.create');
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
            'nm_divisi' => 'required',
        ]);

        Divisi::create([
            'nm_divisi' => $request->nm_divisi
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('divisi');
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
        $divisi = Divisi::find($id);
        return view('admin.divisi.edit', [
            'divisi' => $divisi,
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
            'nm_divisi' => 'required'
        ]);

        $divisi = Divisi::find($id);

        $divisi->nm_divisi = $request->nm_divisi;
        $divisi->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect('/divisi');
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
        $divisi = Divisi::find($id);
        $divisi->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('/divisi');
    }

    public function search(Request $request)
    {
        $cari = $request->cari;
        $divisi = Divisi::where('nm_divisi', 'like', "%" . $cari . "%")
            ->paginate(10);

        return view('admin.divisi.search', [
            'divisi' => $divisi,
        ]);
    }
}
