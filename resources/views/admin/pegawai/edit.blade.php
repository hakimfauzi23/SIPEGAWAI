@extends('admin.layouts.base')

@section('page_title', 'Edit Data Pegawai')


@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">List Pegawai</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('pegawai.details', $id) }}">{{ $pegawai->id . '-' . $pegawai->nama }} </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Pegawai</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="card  shadow">
        <div class="card-body">

            <form method="post" enctype="multipart/form-data" action="{{ route('pegawai.update', $id) }}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}


                <div class=" form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="">ID PEGAWAI</label>
                        <input type="text" name="" class="form-control" value="{{ $pegawai->id }}" disabled>
                        <input type="text" name="id" class="form-control" p value="{{ $pegawai->id }}" hidden>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control" value="{{ $pegawai->password }}">

                        @if ($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class=" form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="">Nomor Induk Kependudukan</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIK...."
                            value="{{ $pegawai->nik }}">

                        @if ($errors->has('nik'))
                            <div class="text-danger">
                                {{ $errors->first('nik') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap . . ."
                            value="{{ $pegawai->nama }}">

                        @if ($errors->has('nama'))
                            <div class="text-danger">
                                {{ $errors->first('nama') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="form-row mb-3">
                    <div class="form-group col ">
                        <label for="">Jenis Kelamin</label>
                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" id="customControlValidation2" value="pria"
                                name="jk" {{ $pegawai->jk == 'pria' ? 'checked' : '' }} required>
                            <label class="custom-control-label" for="customControlValidation2">Pria</label>
                        </div>

                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" id="customControlValidation3" value="wanita"
                                name="jk" {{ $pegawai->jk == 'wanita' ? 'checked' : '' }} required>
                            <label class="custom-control-label" for="customControlValidation3">Wanita</label>
                        </div>
                        @if ($errors->has('jk'))
                            <div class="text-danger">
                                {{ $errors->first('jk') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-md-5 ">

                        <label for="inputAddress">Alamat KTP</label>
                        <textarea name="alamat_ktp" class="form-control" cols="30" rows="5"
                            placeholder="Alamat sesuai KTP ..">{{ $pegawai->alamat_ktp }}</textarea>

                        @if ($errors->has('alamat_ktp'))
                            <div class="text-danger">
                                {{ $errors->first('alamat_ktp') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-md-5 ">

                        <label for="inputAddress2">Alamat Domisili</label>
                        <textarea name="alamat_dom" class="form-control" cols="30" rows="5"
                            placeholder="Alamat sesuai Domisili Sekarang">{{ $pegawai->alamat_dom }}</textarea>

                        @if ($errors->has('alamat_dom'))
                            <div class="text-danger">
                                {{ $errors->first('alamat_dom') }}
                            </div>
                        @endif

                    </div>


                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir . . ."
                            value="{{ $pegawai->tempat_lahir }}">
                        @if ($errors->has('tempat_lahir'))
                            <div class="text-danger">
                                {{ $errors->first('tempat_lahir') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-md-6">
                        <label for="">No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="No Handphone . . ."
                            value="{{ $pegawai->no_hp }}">

                        @if ($errors->has('no_hp'))
                            <div class="text-danger">
                                {{ $errors->first('no_hp') }}
                            </div>
                        @endif

                    </div>

                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Tanggal lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="{{ $pegawai->tgl_lahir }}">

                        @if ($errors->has('tgl_lahir'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_lahir') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $pegawai->email }}">

                        @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                    </div>

                </div>
                <div class="form-row mb-3">

                    <div class="form-group col-md-6">
                        <label for="inputState">Agama</label>
                        <select class=" form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="agama">
                            <option>Pilih Agama</option>
                            <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}> Buddha </option>
                            <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}> Hindu </option>
                            <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}> Islam </option>
                            <option value="Katholik" {{ $pegawai->agama == 'Katholik' ? 'selected' : '' }}> Katholik
                            </option>
                            <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}> Kristen
                            </option>
                            <option value="Konghucu" {{ $pegawai->agama == 'Konghucu' ? 'selected' : '' }}> Konghucu </option>
                            <option value="Protestan" {{ $pegawai->agama == 'Protestan' ? 'selected' : '' }}> Protestan </option>
                            <option value="Lainya" {{ $pegawai->agama == 'Lainya' ? 'selected' : '' }}> Lainya </option>
                        </select>

                        @if ($errors->has('status'))
                            <div class="text-danger">
                                {{ $errors->first('status') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Role</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_role">
                            <option>Pilih Role Pegawai</option>
                            @foreach ($role as $key => $value)
                                <option value="{{ $key }}" {{ $pegawai->id_role == $key ? 'selected' : '' }}>
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

                <div class="form-row mb-3">

                    <div class="form-group col-md-6">

                        <label for="inputState">Status</label>
                        <select class=" form-control selectpicker" data-live-search="false" searchable="Search here.."
                            name="status">
                            <option>Pilih Status</option>
                            <option value="menikah" {{ $pegawai->status == 'menikah' ? 'selected' : '' }}> Menikah
                            </option>
                            <option value="lajang" {{ $pegawai->status == 'lajang' ? 'selected' : '' }}> Lajang
                            </option>
                        </select>

                        @if ($errors->has('status'))
                            <div class="text-danger">
                                {{ $errors->first('status') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputState">Jumlah Anak</label>
                        <input type="number" name="jml_anak" class="form-control" placeholder="Jumlah Anak . . ."
                            value="{{ $pegawai->jml_anak }}">
                        @if ($errors->has('jml_anak'))
                            <div class="text-danger">
                                {{ $errors->first('jml_anak') }}
                            </div>
                        @endif

                    </div>

                </div>

                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="inputState">Jabatan</label>
                        <select class="form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_jabatan">
                            <option>Pilih Jabatan</option>
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

                    <div class="form-group col-md-6">
                        <label for="inputState">Divisi</label>
                        <select class=" form-control selectpicker" data-live-search="true" searchable="Search here.."
                            name="id_divisi">
                            <option>Pilih Divisi</option>
                            @foreach ($divisi as $key => $value)
                                <option value="{{ $key }}" {{ $pegawai->id_divisi == $key ? 'selected' : '' }}>
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


                <div class="form-row mb-3">

                    <div class="form-group col-md-6">
                        <label>Tanggal Diterima </label>
                        <input type="date" name="tgl_masuk" class="form-control" value="{{ $pegawai->tgl_masuk }}">
                        @if ($errors->has('tgl_masuk'))
                            <div class="text-danger">
                                {{ $errors->first('tgl_masuk') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>File Foto 3x4 </label>
                        <input type="file" name="imgupload" class="form-control" value="{{ old('imgupload') }}">
                        @if ($errors->has('imgupload'))
                            <div class="text-danger">
                                {{ $errors->first('imgupload') }}
                            </div>
                        @endif
                    </div>

                </div>



                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>

@endsection
