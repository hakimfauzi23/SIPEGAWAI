@extends('admin.layouts.base')

@section('page_title', 'Edit Data Riwayat Jabatan')


@section('content')
    @php
    $encrypt = Crypt::encryptString($riwayat_jabatan->id_pegawai);
    @endphp

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('pegawai.details', $encrypt) }}">{{ $riwayat_jabatan->pegawai->id . '-' . $riwayat_jabatan->pegawai->nama }}
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('riwayatJabatan.show', $encrypt) }}">List Riwayat Jabatan
                </a>
            </li>
            <li class="breadcrumb-item">Edit Data Jabatan</li>

        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('riwayatJabatan.update', $id) }}">

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
                    <a href="/presensi" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
