@extends('layout.base')


@section('title', 'Tambah Data Presensi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Presensi</span>
                    - Tambah Data Presensi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('presensi.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Presensi
                    </a>
                </li>
                <li class="active">Tambah Data Presensi </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- 2 columns form -->


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Multiple Data Input</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <a href="{{ route('presensi.template') }}">Download Template</a>

            <div class="row">
                <form action="{{ route('presensi.import') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        @csrf
                        <input class="form-control" type="file" name="file" accept=".csv">
                    </div>
                    <div class="">
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-arrow-right14 position-right"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /2 columns form -->

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Single Data Input</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <div class="row">
                <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="inputState">Pegawai</label>
                        <select class="select" name="id_pegawai">
                            <option>Pilih Pegawai</option>
                            @foreach ($pegawai as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('id_pegawai'))
                            <div class="text-danger">
                                {{ $errors->first('id_pegawai') }}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                                @if ($errors->has('tanggal'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggal') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputState">Keterangan</label>
                                <select class="select" name="ket">
                                    <option>Pilih Keterangan</option>
                                    <option value="Hadir"> Hadir </option>
                                    <option value="Cuti"> Cuti </option>
                                    <option value="Alpha"> Alpha </option>
                                </select>

                                @if ($errors->has('ket'))
                                    <div class="text-danger">
                                        {{ $errors->first('ket') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="inputState">Jam Datang</label>
                                <input type="time" name="jam_dtg" class="form-control" value="{{ old('jam_dtg') }}">
                                @if ($errors->has('jam_dtg'))
                                    <div class="text-danger">
                                        {{ $errors->first('jam_dtg') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="inputState">Jam Pulang</label>
                                <input type="time" name="jam_plg" class="form-control" value="{{ old('jam_plg') }}">
                                @if ($errors->has('jam_plg'))
                                    <div class="text-danger">
                                        {{ $errors->first('jam_plg') }}
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="">
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-arrow-right14 position-right"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
