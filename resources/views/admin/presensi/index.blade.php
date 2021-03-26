@extends('layout.base')


@section('title', 'Data Presensi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-notebook"></i> <span class="text-semibold">Presensi</span>
                    - List Data Presensi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Presensi</li>
                {{-- <li class="active">Dashboard</li> --}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- Basic datatable -->
    <div class="row">
        <div class="col">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5 class="panel-title">Tanggal</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">

                    <form method="get" action="{{ route('presensi.search') }}">

                        {{ csrf_field() }}
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
                            <button type="submit" class="btn btn-primary">Submit form <i
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
                    {{-- <h5 class="panel-title">List Data Presensi</h5> --}}
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table datatable-basic table-bordered table-striped table-hover">
                        <thead class="bg-primary-300">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Waktu Kerja</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($presensi->count())
                                @foreach ($presensi as $key => $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->pegawai->nama }}</td>
                                        <td>{{ $p->tanggal }}</td>
                                        <td class="text-center"><span <?php if ($p->ket == 'Hadir') {
                                                echo 'class="label bg-success"';
                                                }
                                                if ($p->ket == 'Alpha') {
                                                echo 'class="label bg-danger"';
                                                }
                                                if ($p->ket == 'Cuti') {
                                                echo 'class="label bg-info"';
                                                }
                                                ?>>{{ $p->ket }}</span></td>
                                        <td>{{ $p->jam_dtg . ' - ' . $p->jam_plg }}</td>
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
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /basic datatable -->
    @endsection
