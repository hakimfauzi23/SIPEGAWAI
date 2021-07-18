@extends('layout.base')


@section('title', 'Export Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-magazine"></i> <span class="text-semibold">Export Data Kinerja</span>
                    - Export Kinerja Pegawai</h4>
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
    <div class="row">
        <div class="panel bg-info">
            <div class="panel-heading">
                <em>
                    <h6>Ini adalah halaman yang digunakan untuk Export Data Kinerja Tahunan Pegawai seperti persentase
                        kehadiran,
                        cuti
                        yang digunakan, hingga surat peringatan yang pernah didapatkan dalam bentuk Excel.
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

    <div class="panel">
        <div class="panel-body">
            <div class="col-mt-3"></div>
            <form method="get" action="{{ route('report.getYear') }}">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label for="" class="text-semibold">Tahun</label>
                            <input class="form-control text-center" type="text" id="datepicker" name="year"
                                value="{{ $year }}">
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

    <div class="row">
        <div class="panel">
            <div class="panel-body">
                <div class="text-right mb-4">
                    <form action="{{ route('report.search.pegawai') }}" method="GET">
                        <input type="hidden" name="year" value="{{ $year }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari sesuatu . . ." name="query">
                            <span class="input-group-btn">
                                <input class="btn bg-teal" type="submit" value="Search">
                            </span>
                        </div>
                    </form>
                </div>
                <table class="table  table-bordered table-striped table-hover ">
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
                                    <td class="text-center"> <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                        <a href="{{ route('report.exportKinerja', ['id_pegawai' => $encyrpt, 'year' => $year]) }}"
                                            class="btn btn bg-success"><i class=" icon-file-excel"></i> Export
                                        </a>
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
                        {{ $pegawai->links() }}
                    </div>
                    <div class="mt-4">
                        {{ 'Total Data: ' . $pegawai->total() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    </script>

@endsection
