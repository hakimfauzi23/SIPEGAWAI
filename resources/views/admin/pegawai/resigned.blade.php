@extends('layout.base')


@section('title', 'Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Data Pegawai</span>
                    - Data Pegawai Resign</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('pegawai.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Pegawai
                    </a>
                </li>
                <li class="active">Data Pegawai Resign</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Ini adalah halaman yang menampilkan data pegawai yang datanya sudah dihapus dikarenakan sudah resign
                    dari perusahaan.
                    <br>Data sewaktu-waktu bisa di restore kembali.
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
        </div>

        <div class="panel-body">

            <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th hidden>Jabatan Terakhir</th>
                        <th hidden>Divisi Terakhir</th>
                        <th hidden>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pegawai->count())
                        <?php $i = 1; ?>
                        @foreach ($pegawai as $key => $p)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td><b>{{ $p->id }}</b></span>
                                    <br>
                                    <span class="label bg-danger">{{ $p->role->nm_role }}</span>
                                    <br>
                                    {{ $p->nama }}
                                    <br>
                                    <span class="label bg-warning">{{ $p->divisi->nm_divisi }}</span>
                                    <span class="label bg-teal">{{ $p->jabatan->nm_jabatan }}</span>
                                    <br>
                                    {{ $p->email . ' / ' . $p->no_hp }}
                                    <br>
                                    Data Dihapus <span
                                        class="label bg-info">{{ date('d-M-Y', strtotime($p->deleted_at)) }}</span>
                                </td>
                                <td hidden>{{ $p->jabatan->nm_jabatan }}</td>
                                <td hidden>{{ $p->divisi->nm_divisi }}</td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                <li><a href="{{ route('pegawai.restore', $encyrpt) }}"><i
                                                            class="fa fa-rotate-left "></i>Restore Data</a>
                                                </li>
                                                <li><a href="{{ route('pegawai.destroyPermanent', $encyrpt) }}"><i
                                                            class=" icon-trash"></i> Hapus Permanen</a>
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
