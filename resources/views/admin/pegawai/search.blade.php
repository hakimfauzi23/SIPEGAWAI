@extends('admin.layouts.base')

@section('page_title', 'List Pegawai')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai </a></li>
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
                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai Baru</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <form action="{{ route('pegawai.search') }}" method="GET" class="form-inline">
                        {{ csrf_field() }}

                        <div class="form-group ml-5">
                            <div class="input-group">
                                <input class="form-control mr-2" type="text" name="cari" placeholder="Cari Pegawai .."
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
                        <th>@sortablelink('id','ID Pegawai')</th>
                        <th>@sortablelink('nama','NAMA ')</th>
                        <th>@sortablelink('id_jabatan','JABATAN')</th>
                        <th>@sortablelink('id_divisi','DIVISI')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pegawai->count())
                        @foreach ($pegawai as $key => $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jabatan->nm_jabatan }}</td>
                                <td>{{ $p->divisi->nm_divisi }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('pegawai.details', $encyrpt) }}" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $pegawai->currentPage() }}
                || Total Data : {{ $pegawai->total() }}
                {{ $pegawai->links() }}

            </div>
        </div>

    </div>


@endsection
