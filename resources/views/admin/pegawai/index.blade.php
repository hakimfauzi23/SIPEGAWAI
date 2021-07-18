@extends('layout.base')


@section('title', 'Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Data Pegawai</span>
                    - List Data Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Pegawai</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman yang menampilkan semua data pegawai yang aktif bekerja di dalam perusahaan ini.
                        <br>Data pegawai bisa dilihat detailnya, dihapus, maupun diedit
                    </h6>
                </em>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <a href="{{ route('pegawai.create') }}"><i class="icon-file-plus"></i> Tambah Pegawai Baru || </a>
                <a href="{{ route('pegawai.trash') }}"><i class=" icon-folder-search"></i> Data Pegawai Resign</a>
            </div>

            <div class="panel-body">
                <div class="text-right mb-4">
                    <form action="{{ route('pegawai.search') }}" method="GET">
                        <input type="hidden" name="page" value="{{ $pegawai->currentPage() }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari sesuatu . . ." name="query">
                            <span class="input-group-btn">
                                <input class="btn bg-teal" type="submit" value="Search">
                            </span>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered table-striped table-hover ">
                    <thead class="bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Pegawai</th>
                            <th hidden>Nama</th>
                            <th hidden>Jabatan</th>
                            <th hidden>Divisi</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if ($pegawai->count())
                            @foreach ($pegawai as $key => $p)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td><b>{{ $p->id }}</b></span>
                                        <br>
                                        <span class="label bg-danger">{{ $p->role->name }}</span>
                                        <br>
                                        {{ $p->nama }}
                                        <br>
                                        <span class="label bg-warning">{{ $p->divisi->nm_divisi }}</span>
                                        <span class="label bg-teal">

                                            @if ($p->id_jabatan == null)
                                                <b>Belum Ada Jabatan</b>
                                            @else
                                                {{ $p->jabatan->nm_jabatan }}
                                            @endif

                                        </span>
                                        <br>
                                        {{ $p->email . ' / ' . $p->no_hp }}
                                    </td>
                                    <td hidden>{{ $p->nama }}</td>
                                    <td hidden></td>
                                    <td hidden></td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                    <li><a href="{{ route('pegawai.show', $encyrpt) }}"><i
                                                                class="icon-file-eye"></i> Detail </a>
                                                    </li>
                                                    <li><a href="{{ route('pegawai.destroy', $encyrpt) }}"><i
                                                                class=" icon-trash"></i> Hapus</a>
                                                    </li>
                                                    <li><a href="{{ route('pegawai.edit', $encyrpt) }}"><i
                                                                class=" icon-pencil5"></i> Edit</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center"> Data tidak ada!</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
                <div class="text-right">
                    <div class="mt-4">
                        {{ $pegawai->links() }}
                    </div>
                    <div class="mt-4">
                        {{ 'Total Data: ' . $pegawai->total() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic datatable -->

@endsection
