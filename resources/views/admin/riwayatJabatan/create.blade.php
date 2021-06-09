@extends('layout.base')


@section('title', 'Tambah Data Riwayat Jabatan')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user-tie"></i> <span class="text-semibold">Data Jabatan</span>
                    - Tambah Data Riwayat Jabatan</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('riwayatJabatan.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai
                    </a>
                </li>
                <li> <a href="{{ route('riwayatJabatan.show', $id) }}"> Data Riwayat Jabatan
                    </a>
                </li>
                <li class="active">Tambah Data Riwayat Jabatan</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini berguna apabila anda ingin menambah data riwayat jabatan baru.</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('riwayatJabatan.store') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-body">

                <input type="hidden" name="id_pegawai" value="{{ $pegawai->id }}">
                <input type="hidden" name="token" value="{{ $id }}">

                <div class="row">
                    <div class="col">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="select" name="id_jabatan">
                                <option>Pilih Jabatan</option>
                                @foreach ($jabatan as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_jabatan'))
                                <div class="text-danger">
                                    {{ $errors->first('id_jabatan') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Mendapatkan Jabatan</label>
                            <input type="date" name="tgl_mulai" class="form-control" placeholder="Nama Jabatan . . . "
                                value="{{ old('tgl_mulai') }}">

                            @if ($errors->has('tgl_mulai'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_mulai') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Submit form <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /2 columns form -->

@endsection
