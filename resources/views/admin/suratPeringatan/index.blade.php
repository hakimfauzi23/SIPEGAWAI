@extends('layout.base')


@section('title', 'Data Surat Peringatan')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-file-text2"></i> <span class="text-semibold">Surat Peringatan</span>
                    - List Data Surat Peringatan</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><i class="active icon-home2 position-left"></i> List Data Surat Peringatan</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman untuk menampilkan riwayat pemberian surat peringatan ke pegawai, diurutkan dari
                        yang terbaru, juga dapat mencari surat peringatan sesuai tanggal yang dikehendaki.
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

                    <form method="get" action="{{ route('suratPeringatan.search') }}">

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
                    <a href="{{ route('suratPeringatan.create') }}"><i class="icon-file-plus"></i> Buat Surat Peringatan
                        Baru</a>
                </div>

                <div class="panel-body">
                    <table class="table datatable-basic table-bordered table-striped table-hover table-xs">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Info Surat Peringatan</th>
                                <th class="text-center" hidden>Tanggal</th>
                                <th class="text-center">Pelanggaran</th>
                                <th class="text-center" hidden>Waktu Kerja</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if ($suratPeringatan->count())
                                @foreach ($suratPeringatan as $key => $p)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ $p->pegawai->nama }}
                                            <br>
                                            {{ 'Dibuat : ' . date('d F Y', strtotime($p->tanggal)) }}
                                            <br>
                                            {{ 'Tingkat : SP-' . $p->tingkat }}
                                        </td>
                                        <td class="text-center" hidden></td>
                                        <td>
                                            <ul>
                                                @if ($p->tingkat != 'III')
                                                    @foreach ($p->pelanggaran as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                @else
                                                    <li>-</li>
                                                @endif
                                            </ul>
                                        </td>
                                        <td class="text-center" hidden>
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
                                                        <li><a href="{{ route('suratPeringatan.destroy', $encyrpt) }}"><i
                                                                    class=" icon-trash"></i> Hapus</a>
                                                        </li>
                                                        <li><a href="{{ route('suratPeringatan.show', $encyrpt) }}"
                                                                target="_blank"><i class=" icon-folder-open3"></i> Buka File
                                                                Surat</a>
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
