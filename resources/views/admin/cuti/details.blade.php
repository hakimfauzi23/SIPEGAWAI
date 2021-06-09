@extends('layout.base')

@section('title', 'Details Data Cuti')

@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - Details Data Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('cuti.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Cuti
                    </a>
                </li>
                <li class="active">Details Data Cuti ID : {{ $cuti->id }} </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading bg-teal">
                <h5 class="panel-title">Data Cuti</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>Nama Pemohon</td>
                            <td>:</td>
                            <td>{{ $cuti->pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tipe Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tipe_cuti }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_pengajuan }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_mulai }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai Cuti</td>
                            <td>:</td>
                            <td>{{ $cuti->tgl_selesai }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $cuti->ket }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading bg-teal">
                <h5 class="panel-title">Detail Proses</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>

            </div>
            <div class="panel-body">
                <div class="progress" style="height:40px">
                    <div <?php if ($cuti->status == 'Diproses') {
                        echo 'class="progress-bar bg-success"';
                        } else {
                        echo 'class="progress-bar bg-success"';
                        } ?> style="width:33.2%">
                        Diproses
                        <br>
                        {{ $cuti->tgl_pengajuan }}
                    </div>

                    <div <?php if ($cuti->status == 'Ditolak Atasan') {
                        echo 'class="progress-bar bg-danger" style="width:33.2%">
                        Ditolak Atasan <br>' . $cuti->tgl_ditolak_atasan;
                        } elseif ($cuti->status == 'Disetujui Atasan' || ($cuti->status == 'Disetujui HRD' || $cuti->status
                        == 'Ditolak HRD')) {
                        echo 'class="progress-bar bg-success" style="width:33.2%">
                        Disetujui Atasan <br>' . $cuti->tgl_disetujui_atasan;
                        } else {
                        echo 'class="progress-bar" style="width:33.2%">';
                        } ?>
                    </div>

                    <div <?php if ($cuti->status == 'Ditolak HRD') {
                        echo 'class="progress-bar bg-danger" style="width:33.2%">
                        Ditolak HRD <br>' . $cuti->tgl_ditolak_hrd;
                        } elseif ($cuti->status == 'Disetujui HRD') {
                        echo 'class="progress-bar bg-success" style="width:33.2%">
                        Disetujui HRD <br>' . $cuti->tgl_disetujui_hrd;
                        } else {
                        echo 'class="progress-bar " style="width:33.2%">';
                        } ?>
                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection
