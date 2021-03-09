@extends('user.layouts.base')

@section('title', 'Edit Data Presensi Pegawai')

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
                    <li class="breadcrumb-item"><a href="{{ route('hrdPresensi.index') }}">Data Presensi Harian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Presensi</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <form method="post" action="{{ route('hrdPresensi.update', $id) }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}


                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="">ID Pesensi</label>
                        <input type="text" name="" class="form-control" value="{{ $presensi->id }}" disabled>
                        <input type="text" name="id" class="form-control" p value="{{ $presensi->id }}" hidden>

                    </div>


                    <div class="form-group col-md-6">
                        <label for="inputState">Pegawai</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_pegawai">
                            <option>Pilih Pegawai</option>
                            @foreach ($pegawai as $key => $value)
                                <option value="{{ $key }}" {{ $presensi->id_pegawai == $key ? 'selected' : '' }}>
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
                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $presensi->tanggal }}">
                        @if ($errors->has('tanggal'))
                            <div class="text-danger">
                                {{ $errors->first('tanggal') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Keterangan</label>
                        <select class=" form-control selectpicker" data-live-search="false" searchable="Search here.."
                            name="ket">
                            <option>Pilih Keterangan</option>
                            <option value="Hadir" {{ $presensi->ket == 'Hadir' ? 'selected' : '' }}> Hadir </option>
                            <option value="Cuti" {{ $presensi->ket == 'Cuti' ? 'selected' : '' }}> Cuti </option>
                            <option value="Alpha" {{ $presensi->ket == 'Alpha' ? 'selected' : '' }}> Alpha </option>
                        </select>

                        @if ($errors->has('ket'))
                            <div class="text-danger">
                                {{ $errors->first('ket') }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Jam Datang</label>
                        <input type="time" name="jam_dtg" class="form-control" value="{{ $presensi->jam_dtg }}">
                        @if ($errors->has('jam_dtg'))
                            <div class="text-danger">
                                {{ $errors->first('jam_dtg') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Jam Pulang</label>
                        <input type="time" name="jam_plg" class="form-control" value="{{ $presensi->jam_plg }}">
                        @if ($errors->has('jam_plg'))
                            <div class="text-danger">
                                {{ $errors->first('jam_plg') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <a href="/hrdPresensi" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
        </div>
    </section>
@endsection
