@extends('layout.base')


@section('title', 'Data Riwayat Divisi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-hat"></i> <span class="text-semibold">Riwayat Divisi</span>
                    - Data Riwayat Divisi Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('hrdPegawai.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Pegawai
                    </a>
                </li>
                <li> <?php $id_pegawai = Crypt::encryptString($pegawai->id); ?>
                    <a href="{{ route('hrdPegawai.show', $id_pegawai) }}"> Details Data Pegawai {{ 'ID : ' . $pegawai->id }}</a>
                </li>
                <li class="active">Daftar Riwayat Divisi</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <?php ?>
            <a href="{{ route('riwayatDivisi.createData', $id) }}"><i class="icon-file-plus"></i> Tambah Riwayat
                Divisi</a>
            {{-- <h5 class="panel-title">List Data Pegawai</h5> --}}
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-basic table-bordered table-striped table-hover">
            <thead class="bg-primary-300">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Tgl Masuk Divisi</th>
                    <th hidden>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($riwayatDivisi->count())
                    @foreach ($riwayatDivisi as $key => $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->pegawai->nama }}</td>
                            <td>{{ $p->divisi->nm_divisi }}</td>
                            <td>{{ $p->tgl_mulai }}</td>
                            <td hidden><span class="label label-success">Active</span></td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                            <li><a href="{{ route('hrdPegawai.editRiwayatDivisi', $encyrpt) }}"><i
                                                        class=" icon-pencil5"></i> Edit</a>
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
    <!-- /basic datatable -->

@endsection
