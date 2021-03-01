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
            <a href="{{ route('cuti.create') }}" class="btn btn-primary">Tambah Pengajuan Cuti Baru</a>
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
