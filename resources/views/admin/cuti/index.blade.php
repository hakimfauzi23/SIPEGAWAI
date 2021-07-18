@extends('layout.base')


@section('title', 'Data Cuti')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-furniture"></i> <span class="text-semibold">Data Cuti</span>
                    - List Data Cuti</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Cuti</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman yang menampilkan semua data cuti pegawai yang berada di dalam sistem.
                        <br> Untuk pencarian data cuti pada waktu tertentu bisa mengubah range dari formuir tanggal
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

                    <form method="get" action="{{ route('cuti.search') }}">
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
                        <div class="mt-3"></div>
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
                    <a href="{{ route('cuti.create') }}"><i class="icon-file-plus"></i> Tambah Data Cuti Baru</a>
                    {{-- <h5 class="panel-title">List Data Cuti</h5> --}}
                </div>

                <div class="panel-body">
                    <div class="panel-body">
                        <div class="text-right mb-4">
                            <form action="{{ route('cuti.search.data') }}" method="GET">
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
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tipe Cuti</th>
                                    <th class="text-center">Tgl Pengajuan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if ($cuti->count())
                                    @foreach ($cuti as $key => $p)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $p->pegawai->nama }}</td>
                                            <td>{{ $p->tipe_cuti }}</td>
                                            <td class="text-center">{{ date('d F Y', strtotime($p->tgl_pengajuan)) }}
                                            </td>
                                            <td class="text-center"><span <?php if ($p->status == 'Disetujui HRD' || $p->status == 'Disetujui Atasan') {
    echo 'class="label bg-success"';
}
if ($p->status == 'Ditolak HRD' || $p->status == 'Ditolak Atasan') {
    echo 'class="label bg-danger"';
}
if ($p->status == 'Diproses') {
    echo 'class="label bg-info"';
}
?>>{{ $p->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                                            <li><a href="{{ route('cuti.show', $encyrpt) }}"><i
                                                                        class="icon-file-eye"></i> Detail </a>
                                                            </li>
                                                            <li><a href="{{ route('cuti.destroy', $encyrpt) }}"><i
                                                                        class=" icon-trash"></i> Hapus</a>
                                                            </li>
                                                            <li><a href="{{ route('cuti.edit', $encyrpt) }}"><i
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
                                {{ $cuti->links() }}
                            </div>
                            <div class="mt-4">
                                {{ 'Total Data: ' . $cuti->total() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /basic datatable -->
    @endsection
