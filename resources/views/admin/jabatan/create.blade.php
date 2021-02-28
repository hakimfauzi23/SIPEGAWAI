@extends('admin.layouts.base')

@section('page_title', 'Tambah Data Jabatan')


@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jabatan.index') }}">List Jabatan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jabatan</li>            
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('jabatan.store') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="nm_jabatan" class="form-control" placeholder="Jabatan ... "
                        value="{{ old('nm_jabatan') }}">

                    @if ($errors->has('nm_jabatan'))
                        <div class="text-danger">
                            {{ $errors->first('nm_jabatan') }}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" class="form-control" placeholder="Gaji Pokok ..."
                        value="{{ old('gaji_pokok') }}">

                    @if ($errors->has('gaji_pokok'))
                        <div class="text-danger">
                            {{ $errors->first('gaji_pokok') }}
                        </div>
                    @endif

                </div>


                <div class="form-group">
                    <a href="/jabatan" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
