@extends('layout.base')


@section('title', 'Tambah Data Presensi')


@section('content_header')
    <style>
        #list_item li {
            margin: 12px 0;
        }

    </style>
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Data Presensi</span>
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
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini digunakan untuk menginput data presensi, ada dua cara menginput data presensi yaitu dengan
                    <b>Multiple Data Input</b> atau <b>Single Data Input </b>.
                    <br> Untuk panduan Multiple Data Input klik Icon <i class="icon-info22"></i>
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Multiple Data Input <a href="" data-toggle="modal" data-target="#modal_iconified">
                    <i class="icon-info22"></i></a>
            </h5>
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
        </div>

        <div class="panel-body">

            <div class="row">
                <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="inputState">Pegawai</label>
                        <select class="select" name="id_pegawai" data-placeholder="Pilih Pegawai">
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
                                <select class="select" name="ket" data-placeholder="Pilih Keterangan">
                                    <option value="">Pilih Keterangan</option>
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
                        <div class="col-md-4">
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

                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="inputState">Apakah WFH?</label>
                                <select class="select" data-placeholder="Ya/Tidak" name="is_wfh">
                                    <option value=""></option>
                                    <option {{ old('is_wfh') == '1' ? 'selected' : '' }} value="1">
                                        Ya </option>
                                    <option {{ old('is_wfh') == '0' ? 'selected' : '' }} value="0">
                                        Tidak </option>
                                </select>

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

    <!-- Iconified modal -->
    <div id="modal_iconified" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-info3"></i> &nbsp;Panduan Multiple Input Data Presensi Harian
                    </h5>
                </div>
                <div class="modal-body" id="list_item">
                    {{-- <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                        <span class="text-semibold">Here we go!</span> Example of an alert inside modal.
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div> --}}
                    <ol type="1">
                        <li>Download template presensi dengan link yang sudah disediakan di atas formulir upload.</li>
                        <li>Buka template tersebut di dalam <a href="https://docs.google.com/spreadsheets/u/0/"><b>Google
                                    Spreadsheet</b></a>.</li>
                        <li>
                            Isi template tersebut dengan contoh format pengisian di bawah ini.
                            <table border="0">
                                <tr>
                                    <td>a. &nbsp;</td>
                                    <td>id_pegawai&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;21040XXX</td>
                                </tr>
                                <tr>
                                    <td>b. &nbsp;</td>
                                    <td>tanggal&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;2021-12-31 (yyyy-mm-dd)</td>
                                </tr>
                                <tr>
                                    <td>c. &nbsp;</td>
                                    <td>ket&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;Alpha/Cuti/Hadir</td>
                                </tr>
                                <tr>
                                    <td>d. &nbsp;</td>
                                    <td>jam_dtg&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;07:00 (hh:mm)</td>
                                </tr>
                                <tr>
                                    <td>e. &nbsp;</td>
                                    <td>jam_plg&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;16:00 (hh:mm)</td>
                                </tr>
                                <tr>
                                    <td>f. &nbsp;</td>
                                    <td>is_wfh&nbsp; </td>
                                    <td> : </td>
                                    <td>&nbsp;(Jika WFH tulis '1' jika tidak kosongi saja.)</td>
                                </tr>
                            </table>
                        </li>
                        <li>Setelah selesai mengisi template, simpan terlebih dahulu lalu download file template tersebut
                            dengan format
                            <b><em>.csv</b></em>
                        </li>
                        <li>Upload file template berbentuk <b><em>.csv</b></em> tadi ke form upload di halaman ini.</li>
                    </ol>
                </div>

                {{-- <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Tutup</button>
                </div> --}}
            </div>
        </div>
    </div>
<!-- /iconified modal -->@endsection
