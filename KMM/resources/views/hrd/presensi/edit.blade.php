@extends('layout.base')


@section('title', 'Edit Data Presensi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Presensi</span>
                    - Edit Data Presensi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('hrdPresensiHarian.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Presensi
                    </a>
                </li>
                <li class="active">Edit Data Presensi </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Edit Data Presensi</h5>
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
                <form action="{{ route('hrdPresensiHarian.update',$id) }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="inputState">Pegawai</label>
                        <select class="select" name="id_pegawai">
                            <option>Pilih Pegawai</option>
                            @foreach ($pegawai as $key => $value)
                                <option value="{{ $key }}" {{ $presensi->id_pegawai == $key ? 'selected' : '' }}>
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
                                <input type="date" name="tanggal" class="form-control" value="{{ $presensi->tanggal }}">
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
                                    <option value="Hadir" {{ $presensi->ket == 'Hadir' ? 'selected' : '' }}> Hadir
                                    </option>
                                    <option value="Cuti" {{ $presensi->ket == 'Cuti' ? 'selected' : '' }}> Cuti </option>
                                    <option value="Alpha" {{ $presensi->ket == 'Alpha' ? 'selected' : '' }}> Alpha
                                    </option>
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
                                <input type="time" name="jam_dtg" class="form-control" value="{{ $presensi->jam_dtg }}">
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
                                <input type="time" name="jam_plg" class="form-control" value="{{ $presensi->jam_plg }}">
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
