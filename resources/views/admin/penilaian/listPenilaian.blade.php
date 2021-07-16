@extends('layout.base')


@section('title', 'Penilaian Pegawai Bulan ini')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user"></i> <span class="text-semibold">Menu Staff</span>
                    - Penilaian Pegawai </h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ route('penilaian.index') }}"><i class="active icon-home2 position-left"></i> List
                        Data
                        Bawahan</a></li>
                <li class="active">Data Penilaian</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Di halaman ini terdapat daftar daftar penilaian pegawai guna untuk peringkat pegawai. tambahkan
                    penilaian dengan tombol 'tambah penilaian'.
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
            @if (App\Models\PenilaianPegawai::where('id_pegawai', $pegawai->id)->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->count() != 0)
                <p class="text-danger"><i class="icon-file-plus"></i> Penilaian bulan ini sudah dibuat!</p>
            @else
                <a href="{{ route('penilaian.createData', $id) }}"><i class="icon-file-plus"></i> Tambah Penilaian</a>
            @endif

        </div>
        <div class="panel-body">
            <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Nilai</th>
                        <th> Nilai Akhir</th>
                        <th hidden></th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if ($penilaian->count())
                        @foreach ($penilaian as $key => $p)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ date('F Y ', strtotime($p->tanggal)) }}
                                </td>
                                <td>
                                    {{ 'Tanggung Jawab: ' . $p->responsible }}
                                    ||
                                    {{ 'Inisiatif: ' . $p->initiate }}
                                    ||
                                    {{ 'Teamwork: ' . $p->teamwork }}
                                    ||
                                    {{ 'Kedisiplinan: ' . $p->discipline }}
                                    ||
                                    {{ 'Performa Kerja: ' . $p->work_performance }}

                                </td>
                                <td>
                                    {{ ($p->responsible + $p->initiate + $p->teamwork + $p->discipline + $p->work_performance) / 5 }}
                                </td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <?php
                                                $enc_id = Crypt::encryptString($p->id);
                                                ?>
                                                <li><a href="{{ route('penilaian.edit', $enc_id) }}"><i
                                                            class="icon-pen"></i> Edit</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
    <!-- /basic datatable -->

@endsection
