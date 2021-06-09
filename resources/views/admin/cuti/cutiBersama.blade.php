@extends('layout.base')


@section('title', 'Atur Cuti Bersama')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - Atur Cuti Bersama</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> Atur Cuti Bersama</li>
                {{-- <li class="active">Dashboard</li> --}}
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
                <h6> Pada halaman ini terdapat fitur untuk mengatur cuti bersama pegawai jadi pegawai tidak usah mengajukan
                    sendiri untuk cuti bersama.
                    <br><b>Setelah berhasil melakukan pengaturan cuti pegawai di sini, sistem akan membuat data pengajuan
                        cuti ke semua pegawai dengan status "Diproses"</b>
                </h6>
            </em>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Atur Cuti Bersama</h5>
        </div>

        <div class="panel-body">

            <div class="row">
                <form action="{{ route('cuti.storeCutiBersama') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}


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
                            placeholder="Ex: Cuti Bersama Bulan Ramadhan/Cuti Bersama Natal/Cuti Bersama Tahun Baru">{{ old('ket') }}</textarea>

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
