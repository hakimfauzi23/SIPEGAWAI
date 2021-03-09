@extends('user.layouts.base')

@section('title', 'Data Presensi Pegawai')

@section('content')


    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Data Presensi Harian Pegawai</h1>
                    <p>Mengelola Data Presensi Pegawai sebagai data master untuk pengawasan Pegawai. </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-section Area -->




    <section class="about-area section-gap">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Data Presensi Harian / </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            @if (session('success_message'))
                <div class="alert alert success">
                    {{ session('success_message') }}
                </div>
            @endif
            <a href="{{ route('hrdPresensi.create') }}" class="btn btn-primary">Tambah Data Baru</a>
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
                                    <a href="{{ route('hrdPresensi.edit', $encyrpt) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('hrdPresensi.destroy', $encyrpt) }}"
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
    </section>
@endsection
