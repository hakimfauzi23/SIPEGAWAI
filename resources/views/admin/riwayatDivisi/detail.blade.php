@extends('layout.base')


@section('title', 'Data Riwayat Divisi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-hat"></i> <span class="text-semibold">Data Divisi</span>
                    - Data Riwayat Divisi Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ route('riwayatDivisi.index') }}"><i class="active icon-home2 position-left"></i> List
                        Data
                        Pegawai</a></li>
                <li class="active">Data Riwayat Divisi </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Pada halaman merupakan daftar list riwayat divisi yang dimiliki oleh pegawai yang baru saja anda pilih
                    pada halaman sebelumnya.
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
            <?php ?>
            <a href="{{ route('riwayatDivisi.createData', $id) }}"><i class="icon-file-plus"></i> Tambah Riwayat
                Divisi</a>
        </div>


        <table class="table datatable-basic table-bordered table-striped table-hover">
            <thead class="bg-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Tgl Masuk Divisi</th>
                    <th hidden>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @if ($riwayatDivisi->count())
                    @foreach ($riwayatDivisi as $key => $p)
                        <tr>
                            <td>{{ $i++ }}</td>
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
                                            <li><a href="{{ route('riwayatDivisi.destroy', $encyrpt) }}"><i
                                                        class=" icon-trash"></i> Hapus</a>
                                            </li>
                                            <li><a href="{{ route('riwayatDivisi.edit', $encyrpt) }}"><i
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
