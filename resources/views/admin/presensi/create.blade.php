@extends('admin.layouts.base')

@section('page_title', 'Tambah Data Presensi')


@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('presensi.index') }}">Data Presensi Harian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Presensi</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('presensi.store') }}">

                {{ csrf_field() }}

                <div class="form-group mb-3">
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

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
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
                            <option value="Hadir"> Hadir </option>
                            <option value="Cuti"> Cuti </option>
                            <option value="Alpha"> Alpha </option>
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
                        <input type="time" name="jam_dtg" class="form-control" value="{{ old('jam_dtg') }}">
                        @if ($errors->has('jam_dtg'))
                            <div class="text-danger">
                                {{ $errors->first('jam_dtg') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Jam Pulang</label>
                        <input type="time" name="jam_plg" class="form-control" value="{{ old('jam_plg') }}">
                        @if ($errors->has('jam_plg'))
                            <div class="text-danger">
                                {{ $errors->first('jam_plg') }}
                            </div>
                        @endif
                    </div>
                </div>





                <div class="form-group">
                    <a href="/presensi" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
