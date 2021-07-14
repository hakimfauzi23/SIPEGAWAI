@extends('layout.base')


@section('title', 'Edit Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Data Pegawai</span>
                    - Edit Data Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('pegawai.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Pegawai
                    </a>
                </li>
                <li class="active">Edit Data Pegawai {{ 'ID : ' . $pegawai->id }}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6>Anda sedang berada di halaman edit data pegawai, di dalam menu ini dapat mengedit semua data pegawai,
                    termasuk data divisi,data jabatan dan atasan.
                </h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    <form method="post" enctype="multipart/form-data" action="{{ route('pegawai.update', $id) }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Data Pegawai</h5>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col">
                        <legend class="text-semibold"><i class="icon-reading position-left"></i> Data Personal
                        </legend>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>

                            <div class="form-group">
                                <label>NIK :</label>
                                <input type="text" name="nik" class="form-control" placeholder="NIK...."
                                    value="{{ $pegawai->nik }}">

                                @if ($errors->has('nik'))
                                    <div class="text-danger">
                                        {{ $errors->first('nik') }}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Nama :</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap . . ."
                                    value="{{ $pegawai->nama }}">

                                @if ($errors->has('nama'))
                                    <div class="text-danger">
                                        {{ $errors->first('nama') }}
                                    </div>

                                @endif

                            </div>

                            <div class="form-group">
                                <label class="display-block">Gender:</label>

                                <label class="radio-inline">
                                    <input type="radio" class="styled" value="Pria" name="jk" required
                                        {{ $pegawai->jk == 'Pria' ? 'checked' : '' }}>
                                    Pria
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" class="styled" value="Wanita" name="jk" required
                                        {{ $pegawai->jk == 'Wanita' ? 'checked' : '' }}>
                                    Wanita
                                </label>

                                @if ($errors->has('jk'))
                                    <div class="text-danger">
                                        {{ $errors->first('jk') }}
                                    </div>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputState">Tanggal lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control"
                                            value="{{ $pegawai->tgl_lahir }}">

                                        @if ($errors->has('tgl_lahir'))
                                            <div class="text-danger">
                                                {{ $errors->first('tgl_lahir') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control"
                                            placeholder="Tempat Lahir . . ." value="{{ $pegawai->tempat_lahir }}">
                                        @if ($errors->has('tempat_lahir'))
                                            <div class="text-danger">
                                                {{ $errors->first('tempat_lahir') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>

                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputState">Agama</label>
                                <select class=" select" data-placeholder="Pilih Agama" searchable="Search here.."
                                    name="agama">
                                    <option value="">Pilih Agama</option>
                                    <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}> Buddha
                                    </option>
                                    <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}> Hindu
                                    </option>
                                    <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}> Islam
                                    </option>
                                    <option value="Katholik" {{ $pegawai->agama == 'Katholik' ? 'selected' : '' }}>
                                        Katholik
                                    </option>
                                    <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}> Kristen
                                    </option>
                                    <option value="Konghucu" {{ $pegawai->agama == 'Konghucu' ? 'selected' : '' }}>
                                        Konghucu
                                    </option>
                                    <option value="Protestan" {{ $pegawai->agama == 'Protestan' ? 'selected' : '' }}>
                                        Protestan
                                    </option>
                                    <option value="Lainya" {{ $pegawai->agama == 'Lainya' ? 'selected' : '' }}> Lainya
                                    </option>
                                </select>

                                @if ($errors->has('agama'))
                                    <div class="text-danger">
                                        {{ $errors->first('agama') }}
                                    </div>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select" name="status" data-placeholder="Pilih Status">
                                            <option value="">Pilih Status</option>
                                            <option value="Menikah"
                                                {{ $pegawai->status == 'Menikah' ? 'selected' : '' }}> Menikah
                                            </option>
                                            <option value="Lajang" {{ $pegawai->status == 'Lajang' ? 'selected' : '' }}>
                                                Lajang
                                            </option>
                                        </select>

                                        @if ($errors->has('status'))
                                            <div class="text-danger">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Jumlah Anak</label>
                                        <input type="number" name="jml_anak" class="form-control"
                                            placeholder="Jumlah Anak . . ." value="{{ $pegawai->jml_anak }}">
                                        @if ($errors->has('jml_anak'))
                                            <div class="text-danger">
                                                {{ $errors->first('jml_anak') }}
                                            </div>
                                        @endif

                                    </div>

                                </div>

                                <div class="row-md-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat KTP:</label>
                                            <textarea name="alamat_ktp" class="form-control" rows="5"
                                                placeholder="Alamat sesuai KTP ..">{{ $pegawai->alamat_ktp }}</textarea>

                                            @if ($errors->has('alamat_ktp'))
                                                <div class="text-danger">
                                                    {{ $errors->first('alamat_ktp') }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat Domisili:</label>
                                            <textarea name="alamat_dom" class="form-control" rows="5"
                                                placeholder="Alamat sesuai Domisili Sekarang">{{ $pegawai->alamat_dom }}</textarea>

                                            @if ($errors->has('alamat_dom'))
                                                <div class="text-danger">
                                                    {{ $errors->first('alamat_dom') }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>

                <div class="row">
                    <div class="col text-right">
                        <legend class="text-semibold"> Data Kepegawaian <i class=" icon-briefcase3 position-right"></i>
                        </legend>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No. Handphone</label>
                                        <input type="text" name="no_hp" class="form-control"
                                            placeholder="No Handphone . . ." value="{{ $pegawai->no_hp }}">

                                        @if ($errors->has('no_hp'))
                                            <div class="text-danger">
                                                {{ $errors->first('no_hp') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $pegawai->email }}" placeholder="Email Pegawai . . .">

                                        @if ($errors->has('email'))
                                            <div class="text-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select" data-live-search="true" data-placeholder="Pilih Role"
                                        searchable="Search here.." name="id_role">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $pegawai->id_role == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('id_role'))
                                        <div class="text-danger">
                                            {{ $errors->first('id_role') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Diterima </label>
                                <input type="date" name="tgl_masuk" class="form-control"
                                    value="{{ $pegawai->tgl_masuk }}">
                                @if ($errors->has('tgl_masuk'))
                                    <div class="text-danger">
                                        {{ $errors->first('tgl_masuk') }}
                                    </div>
                                @endif
                            </div>


                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select class="select" name="id_jabatan" data-placeholder="Pilih Jabatan">
                                            <option value="">Pilih Jabatan</option>
                                            @foreach ($jabatan as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $pegawai->id_jabatan == $key ? 'selected' : '' }}>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Divisi</label>
                                        <select class="select" name="id_divisi" data-placeholder="Pilih Divisi">
                                            <option value="">Pilih Divisi</option>
                                            @foreach ($divisi as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $pegawai->id_divisi == $key ? 'selected' : '' }}>
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

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Atasan</label>
                                <select class="select" name="id_atasan" data-placeholder="Pilih Atasan">
                                    <option value="">Pilih Atasan</option>
                                    </option>
                                    @foreach ($atasan as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $pegawai->id_atasan == $key ? 'selected' : '' }}>
                                            {{ $key . ' - ' . $value }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_atasan'))
                                    <div class="text-danger">
                                        {{ $errors->first('id_atasan') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>File Foto 3x4:</label>
                                <input type="file" name="imgupload" class="form-control" value="{{ old('imgupload') }}">
                                @if ($errors->has('imgupload'))
                                    <div class="text-danger">
                                        {{ $errors->first('imgupload') }}
                                    </div>
                                @endif
                            </div>

                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <legend class="text-semibold"><i class="icon-cash3 position-left"></i> Data Tunjangan & Potongan
                        </legend>
                    </div>
                </div>
                <div class="row">
                    <fieldset>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block text-semibold">Tunjangan</label>
                                @foreach ($tunjangan as $value)
                                    @if ($value->is_shown == 1)
                                        <label class="checkbox-inline">
                                            {{ Form::checkbox('tunjangan[]', $value->id, in_array($value->id, $pegawaiTunjangan) ? true : false, ['class' => 'styled']) }}
                                            {{ $value->nama }}
                                            @if (stripos($value->nama, 'anak') || stripos($value->nama, 'keluarga'))
                                                : {{ $value->jumlah . '% x gaji pokok' }}
                                            @else
                                                : @currency($value->jumlah)
                                            @endif
                                        </label>
                                        <br />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block text-semibold">Potongan</label>
                                @foreach ($potongan as $value)
                                    <label class="checkbox-inline">
                                        {{ Form::checkbox('potongan[]', $value->id, in_array($value->id, $pegawaiPotongan) ? true : false, ['class' => 'styled']) }}
                                        {{ $value->nama }}
                                        : @currency($value->jumlah)
                                    </label>
                                    <br />
                                @endforeach
                            </div>
                        </div>
                    </fieldset>

                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Update Data <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /2 columns form -->

@endsection
