@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')

    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Data Pegawai</h1>
                    <p>Mengelola Semua Data Pegawai Perusahaan dengan Efisien </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-section Area -->


    <section class="about-area section-gap">
        <div class="container">

            <div class="section-title text-center">
                <h4>List Riwayat Divisi Pegawai</h4>
            </div>


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
                                    <a href="{{ route('hrdRiwayatDivisi.edit', $encyrpt) }}"
                                        class="btn btn-warning">Edit</a>
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
    </section>
@endsection
