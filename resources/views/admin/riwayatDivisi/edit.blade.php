@extends('admin.layouts.base')

@section('page_title', 'Edit Data Riwayat divisi')


@section('content')
    @php
    $encrypt = Crypt::encryptString($riwayat_divisi->id_pegawai);
    @endphp

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('pegawai.details', $encrypt) }}">{{ $riwayat_divisi->pegawai->id . '-' . $riwayat_divisi->pegawai->nama }}
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('riwayatDivisi.show', $encrypt) }}">List Riwayat divisi
                </a>
            </li>
            <li class="breadcrumb-item">Edit Data divisi</li>

        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('riwayatDivisi.update', $id) }}">

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
                    <a href="{{ route('riwayatDivisi.show', $encrypt) }}" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
