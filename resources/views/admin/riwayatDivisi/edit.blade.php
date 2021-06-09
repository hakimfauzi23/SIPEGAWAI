@extends('layout.base')


@section('title', 'Edit Data Riwayat Divisi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-hat"></i> <span class="text-semibold">Data Divisi</span>
                    - Edit Data Riwayat Divisi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('riwayatDivisi.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Data
                        Divisi
                    </a>
                </li>
                <li> <a href="{{ route('riwayatDivisi.show', $id_pegawai) }}"> Data Riwayat Divisi
                    </a>
                </li>
                <li class="active">Edit Data Riwayat Divisi</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Anda sedang berada di halaman edit data riwayat divisi, di dalam menu ini dapat mengedit data riwayat
                    divisi.
                    <br><b>Apabila ada update riwayat divisi baru tetapi belum tercantum di dalam sistem, tambah baru
                        riwayat divisi, bukan edit. </b>
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('riwayatDivisi.update', $id) }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}


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

                <input type="hidden" name="id_pegawai" value="{{ $riwayatDivisi->id_pegawai }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Divisi</label>
                            <select class="select" name="id_divisi">
                                <option>Pilih Divisi</option>
                                @foreach ($divisi as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ $riwayatDivisi->id_divisi == $key ? 'selected' : '' }}>
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
                            <label for="">Tanggal Mendapatkan Divisi</label>
                            <input type="date" name="tgl_mulai" class="form-control" placeholder="Nama Divisi . . . "
                                value="{{ $riwayatDivisi->tgl_mulai }}">

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
