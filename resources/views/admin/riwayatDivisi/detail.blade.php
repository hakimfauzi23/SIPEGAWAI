@extends('admin.layouts.base')

@section('page_title', 'Riwayat Divisi')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('pegawai.details', $id) }}">{{ $pegawai->id . '-' . $pegawai->nama }} </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">List Riwayat Divisi</li>
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

            <table style="text-align:center" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>@sortablelink('id_divisi','DIVISI')</th>
                        <th>@sortablelink('tgl_mulai','TANGGAL MULAI')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($riwayat_divisi->count())
                        @foreach ($riwayat_divisi as $key => $p)
                            <tr>
                                <td>{{ $p->divisi->nm_divisi }}</td>
                                <td>{{ $p->tgl_mulai }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('riwayatDivisi.edit', $encyrpt) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('riwayatDivisi.destroy', $encyrpt) }}"
                                        class="btn btn-danger delete-confirm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $riwayat_divisi->currentPage() }}
                || Total Data : {{ $riwayat_divisi->total() }}
                {{ $riwayat_divisi->links() }}

            </div>
        </div>

    </div>


@endsection
