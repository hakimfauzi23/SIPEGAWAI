@extends('admin.layouts.base')

@section('page_title', 'Riwayat Jabatan')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('pegawai.details', $id) }}">{{ $pegawai->id . '-' . $pegawai->nama }} </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">List Riwayat Jabatan</li>
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
                        <th>@sortablelink('id_jabatan','JABATAN')</th>
                        <th>@sortablelink('tgl_mulai','TANGGAL MULAI')</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($riwayat_jabatan->count())
                        @foreach ($riwayat_jabatan as $key => $p)
                            <tr>
                                <td>{{ $p->jabatan->nm_jabatan }}</td>
                                <td>{{ $p->tgl_mulai }}</td>
                                <td>
                                    <?php $encyrpt = Crypt::encryptString($p->id); ?>
                                    <a href="{{ route('riwayatJabatan.edit', $encyrpt) }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href="{{ route('riwayatJabatan.destroy', $encyrpt) }}"
                                        class="btn btn-danger delete-confirm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <br />
            <div class="pagenation">

                Page : {{ $riwayat_jabatan->currentPage() }}
                || Total Data : {{ $riwayat_jabatan->total() }}
                {{ $riwayat_jabatan->links() }}

            </div>
        </div>

    </div>


@endsection
