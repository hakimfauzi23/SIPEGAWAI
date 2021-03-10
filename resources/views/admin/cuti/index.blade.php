@extends('admin.layouts.base')

@section('page_title', 'List Pengajuan Cuti')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">List Pengajuan Cuti / </li>
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
                    <a href="{{ route('cuti.create') }}" class="btn btn-primary">Tambah Pengajuan Cuti Baru</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <form action="{{ route('cuti.search') }}" method="GET" class="form-inline">
                        {{ csrf_field() }}

                        <div class="form-group ml-5">
                            <div class="input-group">
                                <input class="form-control mr-2" type="text" name="cari" placeholder="Cari ID Data Cuti .."
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
                        <th>@sortablelink('id','ID Cuti')</th>
                        <th>@sortablelink('nama','NAMA ')</th>
                        <th>@sortablelink('tgl_pengajuan','TGL PENGAJUAN')</th>
                        <th>@sortablelink('status','STATUS')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cuti->count())
                        @foreach ($cuti as $key => $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->pegawai->nama }}</td>
                                <td>{{ $p->tgl_pengajuan }}</td>
                                <td>{{ $p->status }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('cuti.details', $encyrpt) }}" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $cuti->currentPage() }}
                || Total Data : {{ $cuti->total() }}
                {{ $cuti->links() }}

            </div>
        </div>

    </div>


@endsection
