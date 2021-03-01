@extends('admin.layouts.base')

@section('page_title', 'Tambah Pengajuan Cuti')


@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Data Pengajuan Cuti</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('cuti.details', $id) }}">{{ $cuti->id . '-' . $cuti->pegawai->nama }} </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Pengajuan Cuti</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card mt-4">
        <div class="card-body">

            <form method="post" action="{{ route('cuti.update',$id) }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-row mb-3">

                    <div class="form-group col-md-6">
                        <label for="inputState">Pegawai</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_pegawai">
                            <option>Pilih Pegawai</option>
                            @foreach ($pegawai as $key => $value)
                                <option value="{{ $key }}" {{ $cuti->id_pegawai == $key ? 'selected' : '' }}>
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
                            <option value="Tahunan" {{ $cuti->tipe_cuti == 'Tahunan' ? 'selected' : '' }}> Tahunan
                            </option>
                            <option value="Besar" {{ $cuti->tipe_cuti == 'Besar' ? 'selected' : '' }}> Besar </option>
                            <option value="Bersama" {{ $cuti->tipe_cuti == 'Bersama' ? 'selected' : '' }}> Bersama
                            </option>
                            <option value="Hamil" {{ $cuti->tipe_cuti == 'Hamil' ? 'selected' : '' }}> Hamil </option>
                            <option value="Sakit" {{ $cuti->tipe_cuti == 'Sakit' ? 'selected' : '' }}> Sakit </option>
                            <option value="Penting" {{ $cuti->tipe_cuti == 'Penting' ? 'selected' : '' }}> Penting
                            </option>
                        </select>
                        @if ($errors->has('tipe_cuti'))
                            <div class="text-danger">
                                {{ $errors->first('tipe_cuti') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row mb-3">

                    <div class="form-group col-md-4">
                        <label for="inputState">Tanggal Pengajuan</label>
                        <input type="date" name="tgl_pengajuan" class="form-control" value="{{ $cuti->tgl_pengajuan }}">
                        @if ($errors->has('tgl_pengajuan'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_pengajuan') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="{{ $cuti->tgl_mulai }}">
                        @if ($errors->has('tgl_mulai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_mulai') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" class="form-control" value="{{ $cuti->tgl_selesai }}">
                        @if ($errors->has('tgl_selesai'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_selesai') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">

                        <label for="inputAddress">Keterangan</label>
                        <textarea name="ket" class="form-control" cols="30" rows="5"
                            placeholder="Contoh : Mengantarkan Istri Melakukan Persalinan . . . ">{{ $cuti->ket }}</textarea>

                        @if ($errors->has('ket'))
                            <div class="text-danger">
                                {{ $errors->first('ket') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-6 ">
                        <label for="">Status</label>
                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" id="Diproses" value="Diproses" name="status"
                                {{ $cuti->status == 'Diproses' ? 'checked' : '' }} required>
                            <label class="custom-control-label" for="Diproses">Diproses</label>
                        </div>

                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" id="Disetujui" value="Disetujui" name="status"
                                {{ $cuti->status == 'Disetujui' ? 'checked' : '' }} required>
                            <label class="custom-control-label" for="Disetujui">Disetujui</label>
                        </div>

                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" id="Ditolak" value="Ditolak" name="status"
                                {{ $cuti->status == 'Ditolak' ? 'checked' : '' }} required>
                            <label class="custom-control-label" for="Ditolak">Ditolak</label>
                        </div>

                        @if ($errors->has('status'))
                            <div class="text-danger">
                                {{ $errors->first('status') }}
                            </div>
                        @endif

                    </div>

                </div>


                <div class="form-group">
                    <a href="{{ route('cuti.details', $id) }}" class="btn btn-primary">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>

@endsection
