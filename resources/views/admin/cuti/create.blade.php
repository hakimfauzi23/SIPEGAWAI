@extends('layout.base')


@section('title', 'Tambah Data Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - Tambah Data Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('cuti.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Cuti
                    </a>
                </li>
                <li class="active">Tambah Data Cuti </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
            <em>
                <h6> Halaman ini digunakan untuk menginput data cuti pegawai.
                    <br><b>Fitur ini digunakan apabila terdapat riwayat cuti yang belum terdaftar di dalam sistem, contohnya
                        adalah sebelum aplikasi dijalankan sudah terdapat <br> data riwayat cuti.</b>
                </h6>
            </em>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Tambah Data</h5>
        </div>

        <div class="panel-body">

            <div class="row">
                <form action="{{ route('cuti.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pegawai</label>
                                <select class="select" name="id_pegawai" data-placeholder = "Pilih Pegawai">
                                    <option value="">Pilih Pegawai</option>
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
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputState">Tipe Cuti</label>
                                <select class=" select" name="tipe_cuti" data-placeholder = "Pilih Tipe Cuti">
                                    <option value="">Pilih Tipe Cuti</option>
                                    <option value="Tahunan"> Tahunan </option>
                                    <option value="Besar"> Besar </option>
                                    <option value="Bersama"> Bersama </option>
                                    <option value="Hamil"> Hamil </option>
                                    <option value="Sakit"> Sakit </option>
                                    <option value="Penting"> Penting </option>
                                </select>
                                @if ($errors->has('tipe_cuti'))
                                    <div class="text-danger">
                                        {{ $errors->first('tipe_cuti') }}
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tanggal') }}">
                                @if ($errors->has('tgl_mulai'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_mulai') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tanggal') }}">
                                @if ($errors->has('tgl_selesai'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_selesai') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="inputAddress">Keterangan</label>
                        <textarea name="ket" class="form-control" cols="30" rows="5"
                            placeholder="Contoh : Mengantarkan Anak Khitanan/Baptis , Menikah , Menikahkan Anak, dan lain-lain . . ">{{ old('ket') }}</textarea>

                        @if ($errors->has('ket'))
                            <div class="text-danger">
                                {{ $errors->first('ket') }}
                            </div>
                        @endif

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
