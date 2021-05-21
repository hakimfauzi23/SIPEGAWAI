@extends('layout.base')


@section('title', 'Tambah Slip Gaji Baru')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-cash3"></i> <span class="text-semibold">Data Gaji</span>
                    - Tambah Slip Gaji Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('gaji.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai
                    </a>
                </li>
                <li> <a href="{{ route('gaji.show', $id) }}"> Slip Gaji Tahun Ini
                    </a>
                </li>
                <li class="active">Buat Slip Gaji Pegawai</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Selamat datang di halaman untuk membuat slip gaji pegawai. Pada Halaman ini terdapat daftar potongan
                    dan tunjangan yang dapat di masukan ke dalam slip gaji pegawai dengan menceklis checkboxnya saja.
                    Apabila ingin menambahkan tunjangan dan potongan bisa ditambahkan melalui <b>Menu Potongan &
                        Tunjangan</b>.</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'gaji.store', 'method' => 'POST']) !!}
    <div class="panel ">
        <div class="panel-body">
            <div class="row">
                <div class="col">
                    <legend class="text-semibold"> Data Pegawai <i class=" icon-user position-right"></i>
                    </legend>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input name="gaji_pokok" type="hidden" value={{ $pegawai->jabatan->gaji_pokok }}>
                    <input name="data" type="hidden" value={{ $id }}>


                    <div class="form-group">
                        <label class="text-semibold"> ID Pegawai </label>
                        <input type="text" class="form-control" value="{{ $pegawai->id }}" disabled>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold"> Nama </label>
                        <input type="text" class="form-control" value="{{ $pegawai->nama }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-semibold"> Jabatan </label>
                            <input type="text" class="form-control" value="{{ $pegawai->jabatan->nm_jabatan }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-semibold"> Divisi </label>
                            <input type="text" class="form-control" value="{{ $pegawai->divisi->nm_divisi }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-semibold"> Gaji Pokok </label>
                        <input type="text" class="form-control" value="@currency($pegawai->jabatan->gaji_pokok)" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col text-right">
                    <legend class="text-semibold"> Data Gaji <i class=" icon-cash position-right"></i>
                    </legend>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <label class="display-block text-semibold">Periode <a href="" data-toggle="modal"
                            data-target="#modal_iconified">
                            <i class="icon-info22"></i></a></label>

                    <div class="col-md-6">
                        <label for="">Dari</label>
                        <input type="date" class="form-control" name="dari">
                    </div>
                    <div class="col-md-6">
                        <label for="">Ke</label>
                        <input type="date" class="form-control" name="ke">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="display-block text-semibold">Tunjangan</label>
                        @foreach ($tunjangan as $value)
                            <label class="checkbox-inline">
                                {{ Form::checkbox('tunjangan[]', $value->id, false, ['class' => 'styled']) }}
                                {{ $value->nama }}
                                : @currency($value->jumlah)

                            </label>
                            <br />
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="display-block text-semibold">Potongan</label>
                        @foreach ($potongan as $value)
                            <label class="checkbox-inline">
                                {{ Form::checkbox('potongan[]', $value->id, false, ['class' => 'styled']) }}{{ $value->nama }}
                                : @currency($value->jumlah)
                            </label>
                            <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


    <!-- Iconified modal -->
    <div id="modal_iconified" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-info3"></i> &nbsp;Apa Maksud dari Periode?
                    </h5>
                </div>
                <div class="modal-body">
                    <h6>Periode adalah waktu 'Dari-Ke' gaji diberikan, apabila slip gaji ini untuk Bulan May 2020, Maka
                        pemilihan Periode yang benar adalah
                        Dari : 01/05/2020, Ke : 01/06/2020. </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- /iconified modal -->

@endsection
