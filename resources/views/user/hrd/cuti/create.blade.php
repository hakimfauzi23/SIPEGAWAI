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
                    <li class="breadcrumb-item"><a href="{{ route('hrdCuti.index') }}">Data Pengajuan Cuti</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengajuan Cuti</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <form method="post" action="{{ route('hrdCuti.store') }}">

                {{ csrf_field() }}


                <div class="form-row mb-3">

                    <div class="form-group col-md-6">
                        <label for="inputState">Pegawai</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_pegawai">
                            <option>Pilih Pegawai</option>
                            @foreach ($pegawai as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('id_pegawai'))
                            <div class="text-danger">
                                {{ $errors->first('id_pegawai') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Tipe Cuti</label>
                        <select class=" form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="tipe_cuti">
                            <option>Pilih Tipe Cuti</option>
                            <option value="Tahunan"> Tahunan </option>
                            <option value="Besar"> Besar </option>
                            <option value="Bersama"> Bersama </option>
                            <option value="Hamil"> Hamil </option>
                            <option value="Sakit"> Sakit </option>
                            <option value="Penting"> Penting </option>
                        </select>
                        @if ($errors->has('tipe_cuti'))
                            <div class="text-danger">
                                {{ $errors->first('tipe_cuti') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}">
                        @if ($errors->has('tgl_mulai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_mulai') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}">
                        @if ($errors->has('tgl_selesai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_selesai') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-3 ">

                    <label for="inputAddress">Keterangan</label>
                    <textarea name="ket" class="form-control" cols="30" rows="5"
                        placeholder="Contoh : Mengantarkan Istri Melakukan Persalinan . . . ">{{ old('ket') }}</textarea>

                    @if ($errors->has('ket'))
                        <div class="text-danger">
                            {{ $errors->first('ket') }}
                        </div>
                    @endif

                </div>


                <div class="form-group">
                    <a href="/hrdCuti" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
        </div>
    </section>
@endsection
