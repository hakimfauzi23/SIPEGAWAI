@extends('user.layouts.base')

@section('title', 'Data Pegawai')

@section('content')

    @php
    $encrypt = Crypt::encryptString($riwayat_jabatan->id_pegawai);
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

            <div class="section-title text-center">
                <h4>List Riwayat Jabatan Pegawai</h4>
            </div>


            <form method="post" action="{{ route('hrdRiwayatJabatan.update', $id) }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group mb-3 ">
                    <input type="text" name="id" value="{{ $riwayat_jabatan->id }}" hidden>
                    <label for="inputState">Pegawai</label>
                    <input type="text" name="#" class="form-control" value="{{ $riwayat_jabatan->pegawai->nama }}"
                        disabled>
                    <input type="text" name="id_pegawai" class="form-control" value="{{ $riwayat_jabatan->id_pegawai }}"
                        hidden>

                    @if ($errors->has('id_pegawai'))
                        <div class="text-danger">
                            {{ $errors->first('id_pegawai') }}
                        </div>
                    @endif

                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Jabatan</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_jabatan">
                            <option>Pilih Jabatan</option>
                            @foreach ($jabatan as $key => $value)
                                <option value="{{ $key }}"
                                    {{ $riwayat_jabatan->id_jabatan == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('id_jabatan'))
                            <div class="text-danger">
                                {{ $errors->first('id_jabatan') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal Mulai Jabatan</label>
                        <input type="date" name="tgl_mulai" class="form-control"
                            value="{{ $riwayat_jabatan->tgl_mulai }}">

                        @if ($errors->has('tgl_mulai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_mulai') }}
                            </div>
                        @endif

                    </div>


                </div>

                <div class="form-group">
                    <a href="{{ route('riwayatDivisi.show', $encrypt) }}" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
        </div>
    </section>
@endsection
