@extends('layout.base')

@section('title', 'Details Data Cuti')

@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Cuti</span>
                    - Details Data Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('staffCuti.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Riwayat
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
                <div class="table-responsive">
                    <table class="table table-xs">
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><span <?php if ($cuti->status == 'Disetujui HRD' || $cuti->status ==
                                    'Disetujui Atasan') {
                                    echo 'class="label bg-success"';
                                    }
                                    if ($cuti->status == 'Ditolak HRD' || $cuti->status == 'Ditolak Atasan') {
                                    echo 'class="label bg-danger"';
                                    }
                                    if ($cuti->status == 'Diproses') {
                                    echo 'class="label bg-info"';
                                    }
                                    ?>>{{ $cuti->status }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Ditolak Atasan</td>
                            <td>:</td>
                            <td>
                                @if (!($cuti->tgl_ditolak_atasan))
                                {{ '-'}}
                                @else
                                {{ date('d-M-Y', strtotime($cuti->tgl_ditolak_atasan)) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Disetujui Atasan</td>
                            <td>:</td>
                            <td>
                                @if (!($cuti->tgl_disetujui_atasan))
                                {{ '-'}}
                                @else
                                {{ date('d-M-Y', strtotime($cuti->tgl_disetujui_atasan)) }}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Ditolak HRD</td>
                            <td>:</td>
                            <td>
                                @if (!($cuti->tgl_ditolak_hrd))
                                {{ '-'}}
                                @else
                                {{ date('d-M-Y', strtotime($cuti->tgl_ditolak_hrd)) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Disetujui HRD</td>
                            <td>:</td>
                            <td>
                                @if (!($cuti->tgl_disetujui_hrd))
                                {{ '-'}}
                                @else
                                {{ date('d-M-Y', strtotime($cuti->tgl_disetujui_hrd)) }}
                                @endif

                            </td>
                        </tr>
                    </table>
                </div>


            </div>
        </div>
    </div>

@endsection
