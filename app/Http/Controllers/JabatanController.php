<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jabatan = Jabatan::sortable()->paginate(10);
        return view('admin.jabatan.index', ['jabatan' => $jabatan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.jabatan.create');
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
            'nm_jabatan' => 'required',
            'gaji_pokok' => 'required',
        ]);

        Jabatan::create([
            'nm_jabatan' => $request->nm_jabatan,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        Alert::success('success', ' Berhasil Input Data !');
        return redirect('jabatan');
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
        $jabatan = Jabatan::find($id);
        return view('admin.jabatan.edit', ['jabatan' => $jabatan]);
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
            'nm_jabatan' => 'required',
            'gaji_pokok' => 'required',
        ]);



        $jabatan = Jabatan::find($id);

        $jabatan->nm_jabatan = $request->nm_jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->save();

        Alert::success('success', ' Berhasil Update Data !');
        return redirect('/jabatan');
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
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        Alert::success('success', ' Berhasil Hapus Data !');
        return redirect('/jabatan');
    }
}
