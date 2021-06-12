@extends('layout.base')


@section('title', 'Edit Data Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Data Cuti</span>
                    - Edit Data Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('cuti.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Cuti
                    </a>
                </li>
                <li class="active">Edit Data Cuti ID : {{ $cuti->id }} </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Anda sedang berada di halaman edit data cuti, di dalam menu ini dapat mengedit semua data cuti
                    kecuali id cuti.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form action="{{ route('cuti.update', $id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Data</h5>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <legend class="text-semibold"><i class="icon-furniture position-left"></i> Data Cuti</legend>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pegawai</label>
                                    <select class="select" name="id_pegawai" data-placeholder = "Pilih Pegawai">
                                        <option value="">Pilih Pegawai</option>
                                        @foreach ($pegawai as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $cuti->id_pegawai == $key ? 'selected' : '' }}>
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
                                        <option value="Tahunan" {{ $cuti->tipe_cuti == 'Tahunan' ? 'selected' : '' }}>
                                            Tahunan
                                        </option>
                                        <option value="Besar" {{ $cuti->tipe_cuti == 'Besar' ? 'selected' : '' }}> Besar
                                        </option>
                                        <option value="Bersama" {{ $cuti->tipe_cuti == 'Bersama' ? 'selected' : '' }}>
                                            Bersama
                                        </option>
                                        <option value="Hamil" {{ $cuti->tipe_cuti == 'Hamil' ? 'selected' : '' }}> Hamil
                                        </option>
                                        <option value="Sakit" {{ $cuti->tipe_cuti == 'Sakit' ? 'selected' : '' }}> Sakit
                                        </option>
                                        <option value="Penting" {{ $cuti->tipe_cuti == 'Penting' ? 'selected' : '' }}>
                                            Penting
                                        </option>
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
                                    <input type="date" name="tgl_mulai" class="form-control"
                                        value="{{ $cuti->tgl_mulai }}">
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
                                    <input type="date" name="tgl_selesai" class="form-control"
                                        value="{{ $cuti->tgl_selesai }}">
                                    @if ($errors->has('tgl_selesai'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_selesai') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengajuan</label>
                                    <input type="date" name="tgl_pengajuan" class="form-control"
                                        value="{{ $cuti->tgl_pengajuan }}">
                                    @if ($errors->has('tgl_pengajuan'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_pengajuan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="ket" class="form-control" cols="30" rows="5"
                                        placeholder="Contoh : Mengantarkan Anak Khitanan/Baptis , Menikah , Menikahkan Anak, dan lain-lain . . ">{{ $cuti->ket }}</textarea>

                                    @if ($errors->has('ket'))
                                        <div class="text-danger">
                                            {{ $errors->first('ket') }}
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <legend class="text-semibold"><i class="icon-calendar position-left"></i> Data Persetujuan</legend>

                        <label class="display-block">Status:</label>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="radio">
                                    <label>
                                        <input type="radio" value="Diproses" class="styled" name="status"
                                            {{ $cuti->status == 'Diproses' ? 'checked' : '' }}>
                                        Diproses
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" value="Disetujui HRD" class="styled" name="status"
                                            {{ $cuti->status == 'Disetujui HRD' ? 'checked' : '' }}>
                                        Disetujui HRD
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" value="Disetujui Atasan" class="styled" name="status"
                                            {{ $cuti->status == 'Disetujui Atasan' ? 'checked' : '' }}>
                                        Disetujui Atasan
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="Ditolak HRD" class="styled" name="status"
                                            {{ $cuti->status == 'Ditolak HRD' ? 'checked' : '' }}>
                                        Ditolak HRD
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="Ditolak Atasan" class="styled" name="status"
                                            {{ $cuti->status == 'Ditolak Atasan' ? 'checked' : '' }}>
                                        Ditolak Atasan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Disetujui Atasan</label>
                                    <input type="date" name="tgl_disetujui_atasan" class="form-control"
                                        value="{{ $cuti->tgl_disetujui_atasan }}">
                                    @if ($errors->has('tgl_disetujui_atasan'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_disetujui_atasan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Disetujui HRD</label>
                                    <input type="date" name="tgl_disetujui_hrd" class="form-control"
                                        value="{{ $cuti->tgl_disetujui_hrd }}">
                                    @if ($errors->has('tgl_disetujui_hrd'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_disetujui_hrd') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Ditolak Atasan</label>
                                    <input type="date" name="tgl_ditolak_atasan" class="form-control"
                                        value="{{ $cuti->tgl_ditolak_atasan }}">
                                    @if ($errors->has('tgl_ditolak_atasan'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_ditolak_atasan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Ditolak HRD</label>
                                    <input type="date" name="tgl_ditolak_hrd" class="form-control"
                                        value="{{ $cuti->tgl_ditolak_hrd }}">
                                    @if ($errors->has('tgl_ditolak_hrd'))
                                        <div class="text-danger">
                                            {{ $errors->first('tgl_ditolak_hrd') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Submit form <i
                                        class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
