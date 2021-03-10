@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')


    <!-- Start top-section Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center text-center banner-content">
                <div class="col-lg-12">
                    <h1 class="text-white">Data Cuti Pegawai</h1>
                    <p>Mengelola Data Cuti Pegawai untuk mengawasi aktivitas cuti pegawai. </p>
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
                    <li class="breadcrumb-item"><a href="{{ route('hrdCuti.index') }}">Data Cuti </a></li>
                    <li class="breadcrumb-item"> Hasil Pencarian </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            @if (session('success_message'))
                <div class="alert alert success">
                    {{ session('success_message') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <a href="{{ route('hrdCuti.create') }}" class="btn btn-primary">Tambah Pengajuan Cuti Baru</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <form action="{{ route('hrdCuti.search') }}" method="GET" class="form-inline">
                        {{ csrf_field() }}

                        <div class="form-group ml-5">
                            <div class="input-group">
                                <input class="form-control mr-2" type="text" name="cari" placeholder="Cari ID Cuti"
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
                                    <a href="{{ route('hrdCuti.show', $encyrpt) }}" class="btn btn-success">Detail</a>
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
    </section>
@endsection
