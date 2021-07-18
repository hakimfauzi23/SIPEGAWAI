@extends('layout.base')


@section('title', 'Slip Gaji')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-cash3"></i> <span class="text-semibold">Data Gaji</span>
                    - Slip Gaji</h4>
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
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Pada halaman merupakan daftar list pegawai yang bisa dipilih untuk dilihat daftar slip gaji per Bulan di
                    tahun ini. </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="panel panel-flat">

        <div class="panel-body">
            <div class="text-right mb-4">
                <form action="{{ route('gaji.search.pegawai') }}" method="GET">
                    <input type="hidden" name="page" value="{{ $pegawai->currentPage() }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari sesuatu . . ." name="query">
                        <span class="input-group-btn">
                            <input class="btn bg-teal" type="submit" value="Search">
                        </span>
                    </div>
                </form>
            </div>
            <table class="table  table-bordered table-striped table-hover table-xs">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th class="text-center">Status</th>
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
                                    <span class="label bg-warning">
                                        @if ($p->id_divisi == null)
                                            <b>Belum Ada Divisi</b>
                                        @else
                                            {{ $p->divisi->nm_divisi }}
                                        @endif
                                    </span>
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
                                <td class="text-center">
                                    @if (App\Models\Gaji::where('id_pegawai', $p->id)->whereMonth('tanggal', date('m'))->count() != 0)
                                        <span class="label bg-success">Slip Gaji Bulan Ini sudah Ada</span>
                                    @else
                                        <span class="label bg-danger">Slip Gaji Bulan Ini Belum Ada</span>
                                    @endif
                                </td>
                                <td hidden></td>
                                <td hidden><span class="label label-success">Active</span></td>
                                <td class="text-center"> <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('gaji.show', $encyrpt) }}" class="btn btn bg-info-300"><i
                                            class=" icon-eye"></i> Lihat
                                    </a>

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
    <!-- /basic datatable -->

@endsection
