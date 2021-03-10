@extends('admin.layouts.base')

@section('page_title', 'List Presensi Harian')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('presensi.index') }}">Data Presensi Harian </a></li>
            <li class="breadcrumb-item"> Hasil Pencarian </li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">
            @if (session('success_message'))
                <div class="alert alert success">
                    {{ session('success_message') }}
                </div>
            @endif

            <div class="row">
                <div class="col">
                    <a href="{{ route('presensi.create') }}" class="btn btn-primary">Tambah Data Baru</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <form action="{{ route('presensi.search') }}" method="GET" class="form-inline">
                        {{ csrf_field() }}

                        <div class="form-group ml-5">
                            <div class="input-group">
                                <input class="form-control mr-2" type="text" name="cari" placeholder="Cari ID Presensi .."
                                    value="{{ old('cari') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit">Go!</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="mb-3"></div>

            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>@sortablelink('id','ID PRESENSI')</th>
                        <th>@sortablelink('nama','NAMA PEGAWAI')</th>
                        <th>@sortablelink('tanggal','TANGGAL')</th>
                        <th>@sortablelink('ket','KETERANGAN')</th>
                        <th>@sortablelink('jam_dtg','JAM DATANG')</th>
                        <th>@sortablelink('jam_plg','JAM PULANG')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($presensi->count())
                        @foreach ($presensi as $key => $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->pegawai->nama }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->ket }}</td>
                                <td>{{ $p->jam_dtg }}</td>
                                <td>{{ $p->jam_plg }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('presensi.edit', $encyrpt) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('presensi.destroy', $encyrpt) }}"
                                        class="btn btn-danger delete-confirm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $presensi->currentPage() }}
                || Total Data : {{ $presensi->total() }}
                {{ $presensi->links() }}

            </div>
        </div>

    </div>


@endsection
