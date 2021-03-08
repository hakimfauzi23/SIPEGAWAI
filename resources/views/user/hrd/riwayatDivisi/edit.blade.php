@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')
    @php
    $encrypt = Crypt::encryptString($riwayat_divisi->id_pegawai);
    @endphp

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

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('hrdPegawai.index') }}">List Pegawai</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('hrdPegawai.show', $encrypt) }}">{{ $riwayat_divisi->pegawai->id . '-' . $riwayat_divisi->pegawai->nama }}
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('hrdRiwayatDivisi.show', $encrypt) }}">List Riwayat
                            divisi
                        </a>
                    </li>
                    <li class="breadcrumb-item">Edit Data divisi</li>

                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <form method="post" action="{{ route('hrdRiwayatDivisi.update', $id) }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group mb-3 ">
                    <input type="text" name="id" value="{{ $riwayat_divisi->id }}" hidden>
                    <label for="inputState">Pegawai</label>
                    <input type="text" name="#" class="form-control" value="{{ $riwayat_divisi->pegawai->nama }}"
                        disabled>
                    <input type="text" name="id_pegawai" class="form-control" value="{{ $riwayat_divisi->id_pegawai }}"
                        hidden>

                    @if ($errors->has('id_pegawai'))
                        <div class="text-danger">
                            {{ $errors->first('id_pegawai') }}
                        </div>
                    @endif

                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Divisi</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_divisi">
                            <option>Pilih divisi</option>
                            @foreach ($divisi as $key => $value)
                                <option value="{{ $key }}"
                                    {{ $riwayat_divisi->id_divisi == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('id_divisi'))
                            <div class="text-danger">
                                {{ $errors->first('id_divisi') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal Mulai Masuk Divisi</label>
                        <input type="date" name="tgl_mulai" class="form-control"
                            value="{{ $riwayat_divisi->tgl_mulai }}">

                        @if ($errors->has('tgl_mulai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_mulai') }}
                            </div>
                        @endif

                    </div>


                </div>

                <div class="form-group">
                    <a href="{{ route('hrdRiwayatDivisi.show', $encrypt) }}" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
    </section>
@endsection
