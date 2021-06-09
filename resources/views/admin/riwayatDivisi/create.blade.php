@extends('layout.base')


@section('title', 'Tambah Data Riwayat Divisi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-hat"></i> <span class="text-semibold">Data Divisi</span>
                    - Tambah Data Riwayat Divisi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('riwayatDivisi.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Data
                        Divisi
                    </a>
                </li>
                <li> <a href="{{ route('riwayatDivisi.show', $id) }}"> Data Riwayat Divisi
                    </a>
                </li>
                <li class="active">Tambah Data Riwayat Divisi</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini berguna apabila anda ingin menambah data riwayat divisi baru.</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('riwayatDivisi.store') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-heading">
                {{-- <h5 class="panel-title">Multiple columns</h5> --}}
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

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
                            <label>Divisi</label>
                            <select class="select" name="id_divisi">
                                <option>Pilih Divisi</option>
                                @foreach ($divisi as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_divisi'))
                                <div class="text-danger">
                                    {{ $errors->first('id_divisi') }}
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
