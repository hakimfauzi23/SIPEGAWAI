@extends('layout.base')


@section('title', 'Tambah Data Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-users4"></i> <span class="text-semibold">Data Pegawai</span>
                    - Tambah Data Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('pegawai.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Pegawai
                    </a>
                </li>
                <li class="active">Tambah Data Pegawai</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini berguna apabila anda ingin menambah data pegawai baru, pastikan data yang akan ditambahkan
                    belum ada di dalam database.</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('pegawai.store') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Tambah Data Pegawai</h5>
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
                                    value="{{ old('nik') }}">

                                @if ($errors->has('nik'))
                                    <div class="text-danger">
                                        {{ $errors->first('nik') }}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label>Nama :</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap . . ."
                                    value="{{ old('nama') }}">

                                @if ($errors->has('nama'))
                                    <div class="text-danger">
                                        {{ $errors->first('nama') }}
                                    </div>

                                @endif

                            </div>

                            <div class="form-group">
                                <label class="display-block">Gender:</label>

                                <label class="radio-inline">
                                    <input type="radio" class="styled" value="pria" name="jk"
                                        {{ old('jk') == 'pria' ? 'checked' : '' }}>
                                    Pria
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" class="styled" value="wanita" name="jk"
                                        {{ old('jk') == 'wanita' ? 'checked' : '' }}>
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
                                            value="{{ old('tgl_lahir') }}">

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
                                            placeholder="Tempat Lahir . . ." value="{{ old('tempat_lahir') }}">
                                        @if ($errors->has('tempat_lahir'))
                                            <div class="text-danger">
                                                {{ $errors->first('tempat_lahir') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>


                                {{-- <div class="form-group">
                                <label>Attach screenshot:</label>
                                <input type="file" class="file-styled">
                            </div> --}}

                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputState">Agama</label>
                                <select class=" select" data-placeholder="Pilih salah satu" searchable="Search here.."
                                    name="agama">
                                    <option value=""> Pilih Agama< /option>
                                    <option {{ old('agama') == 'Buddha' ? 'selected' : '' }} value="Buddha"> Buddha
                                    </option>
                                    <option {{ old('agama') == 'Hindu' ? 'selected' : '' }} value="Hindu"> Hindu
                                    </option>
                                    <option {{ old('agama') == 'Islam' ? 'selected' : '' }} value="Islam"> Islam
                                    </option>
                                    <option {{ old('agama') == 'Katholik' ? 'selected' : '' }} value="Katholik"> Katholik
                                    </option>
                                    <option {{ old('agama') == 'Kristen' ? 'selected' : '' }} value="Kristen"> Kristen
                                    </option>
                                    <option {{ old('agama') == 'Konghucu' ? 'selected' : '' }} value="Konghucu"> Konghucu
                                    </option>
                                    <option {{ old('agama') == 'Protestan' ? 'selected' : '' }} value="Protestan">
                                        Protestan </option>
                                    <option {{ old('agama') == 'Lainya' ? 'selected' : '' }} value="Lainya"> Lainya
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
                                        <select class="select" data-placeholder="Pilih Status" name="status">
                                            <option value="">Pilih Status</option>
                                            <option {{ old('status') == 'Menikah' ? 'selected' : '' }} value="Menikah">
                                                Menikah </option>
                                            <option {{ old('status') == 'Lajang' ? 'selected' : '' }} value="Lajang">
                                                Lajang </option>
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
                                            placeholder="Jumlah Anak . . ." value="{{ old('jml_anak') }}">
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
                                                placeholder="Alamat sesuai KTP ..">{{ old('alamat_ktp') }}</textarea>

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
                                                placeholder="Alamat sesuai Domisili Sekarang">{{ old('alamat_dom') }}</textarea>

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
                                            placeholder="No Handphone . . ." value="{{ old('no_hp') }}">

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
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                            placeholder="Email Pegawai . . .">

                                        @if ($errors->has('email'))
                                            <div class="text-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <label>Role</label>

                                <select class="select" data-live-search="true" data-placeholder="Pilih Role"
                                    searchable="Search here.." name="id_role">
                                    <option value="">Pilih Role</option>
                                    @foreach ($role as $key => $value)
                                        <option {{ old('id_role') == $key ? 'selected' : '' }}
                                            value="{{ $key }}">
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

                            <div class="form-group">
                                <label>Tanggal Diterima </label>
                                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk') }}">
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
                                        <select class="select" data-placeholder="Pilih Jabatan" name="id_jabatan">
                                            <option value="">Pilih Jabatan</option>
                                            @foreach ($jabatan as $key => $value)
                                                <option {{ old('id_jabatan') == $key ? 'selected' : '' }}
                                                    value="{{ $key }}">
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
                                        <select data-placeholder="Pilih Divisi" class="select" name="id_divisi">
                                            <option value="">Pilih Divisi</option>
                                            @foreach ($divisi as $key => $value)
                                                <option {{ old('id_divisi') == $key ? 'selected' : '' }}
                                                    value="{{ $key }}">
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
                                <select class="select" data-placeholder="Pilih Atasan (Kosongi Bila Tidak Ada)"
                                    name="id_atasan">
                                    <option value="">Pilih Atasan</option>
                                    <option value="">Tidak Ada</option>
                                    @foreach ($pegawai as $key => $value)
                                        <option {{ old('id_atasan') == $key ? 'selected' : '' }}
                                            value="{{ $key }}">
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
                                            {{ Form::checkbox('tunjangan[]', $value->id, false, ['class' => 'styled']) }}
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
                                    @if ($value->is_shown == 1)
                                        <label class="checkbox-inline">
                                            {{ Form::checkbox('potongan[]', $value->id, false, ['class' => 'styled']) }}{{ $value->nama }}
                                            @if (stripos($value->nama, 'bpjs') || stripos($value->nama, 'pph'))
                                            : Sesuai UU
                                            @else
                                            : @currency($value->jumlah)
                                            @endif
                                        </label>
                                        <br />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </fieldset>

                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Submit form <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /2 columns form -->

@endsection
