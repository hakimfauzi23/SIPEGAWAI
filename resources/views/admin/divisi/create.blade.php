@extends('admin.layouts.base')

@section('page_title', 'Tambah Data Divisi')


@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('divisi.index') }}">List Divisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Divisi</li>            
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('divisi.store') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nama Divisi</label>
                    <input type="text" name="nm_divisi" class="form-control" placeholder="Divisi Baru . . . "
                        value="{{ old('nm_divisi') }}">

                    @if ($errors->has('nm_divisi'))
                        <div class="text-danger">
                            {{ $errors->first('nm_divisi') }}
                        </div>
                    @endif

                </div>


                <div class="form-group">
                    <a href="/divisi" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
