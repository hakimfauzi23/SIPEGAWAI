@extends('layout.base')


@section('title', 'Data Presensi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Data Presensi</span>
                    - List Data Presensi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Presensi</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman yang menampilkan semua data presensi pegawai yang berada di dalam sistem.
                        <br> Untuk pencarian data presensi pada waktu tertentu bisa mengubah range dari formuir tanggal
                        <b>Dari</b> & <b>Ke</b>.
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
    <div class="row">
        <div class="col">
            <div class="panel panel-info">
                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger"> {{ session('error') }}</div>
                    @endif
                    <form method="get" action="{{ route('presensi.search') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dari</label>
                                    <input class="form-control" type="date" name="dari" id="" value="{{ $dari }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ke</label>
                                    <input class="form-control " type="date" name="ke" id="" value="{{ $ke }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Browse <i
                                    class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <a href="{{ route('presensi.create') }}"><i class="icon-file-plus"></i> Tambah Data Presensi Baru</a>
                </div>

                <div class="panel-body">
                    <div class="text-right mb-4">
                        <form action="{{ route('presensi.search.data') }}" method="GET">
                            <input type="hidden" name="dari" value="{{ $dari }}">
                            <input type="hidden" name="ke" value="{{ $ke }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari sesuatu . . ." name="query">
                                <span class="input-group-btn">
                                    <input class="btn bg-teal" type="submit" value="Search">
                                </span>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped table-hover table-xs">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Waktu Kerja</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($presensi->count())
                                @foreach ($presensi as $key => $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->pegawai->nama }}</td>
                                        <td class="text-center">{{ date('d F Y', strtotime($p->tanggal)) }}</td>
                                        <td class="text-center"><span @if ($p->ket == 'Hadir') class="label bg-success"@i
                                            @elseif ($p->ket == 'Alpha')class="label bg-danger";
                                            @elseif ($p->ket == 'Cuti')class="label bg-info"; @endif>{{ $p->ket }}</span>
                                            @if ($p->ket == 'Hadir' && $p->is_wfh == 1)
                                                <span class="label bg-purple-600" @i>{{ 'WFH' }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($p->ket == 'Hadir')
                                                {{ date('H:i', strtotime($p->jam_dtg)) . ' - ' . date('H:i', strtotime($p->jam_plg)) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                        <li><a href="{{ route('presensi.destroy', $encyrpt) }}"><i
                                                                    class=" icon-trash"></i> Hapus</a>
                                                        </li>
                                                        <li><a href="{{ route('presensi.edit', $encyrpt) }}"><i
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
                                    <td colspan="6" class="text-center"> Data tidak ada!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-right">
                        <div class="mt-4">
                            {{ $presensi->links() }}
                        </div>
                        <div class="mt-4">
                            {{ 'Total Data: ' . $presensi->total() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic datatable -->
    @endsection
