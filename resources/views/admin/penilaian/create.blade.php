@extends('layout.base')


@section('title', 'Tambah Penilaian Pegawai')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-user"></i> <span class="text-semibold">Menu Staff</span>
                    - Penilaian Pegawai</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('penilaian.index') }}"> <i class="active icon-home2 position-left"></i> List
                        Data
                        Bawahan
                    </a>
                </li>
                <li>
                    <a href="{{ route('penilaian.show', $id) }}"> Data penilaian</a>
                </li>
                <li class="active">Buat Penilaian baru</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6></h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'penilaian.store', 'method' => 'POST']) !!}
    <div class="panel ">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel ">
                        <div class="panel-heading bg-info">
                            <h5 class="panel-title text-center">Data Pegawai</h5>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                @php $path =Storage::url('images/'.$pegawai->path); @endphp
                                <img src="{{ url($path) }}"
                                    onerror="this.onerror=null; this.src='{{ URL::to('/admin/assets/images/brands/user.jpeg') }}'"
                                    alt="Foto Profil" width="160">
                            </div>
                            <div class="mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-xs">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $pegawai->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $pegawai->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>{{ $pegawai->jabatan->nm_jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Divisi</td>
                                        <td>:</td>
                                        <td>{{ $pegawai->divisi->nm_divisi }}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel ">
                        <div class="panel-heading bg-info">
                            <h5 class="panel-title text-center">Form Penilaian</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Tanggung Jawab</label>
                                    <div class="col-lg-10">
                                        <input name="data" type="hidden" value={{ $id }}>

                                        <input type="number" class="form-control" name="responsible"
                                            value="{{ old('responsible') }}" placeholder="Skala 10-100">
                                    </div>

                                    @if ($errors->has('responsible'))
                                        <div class="text-danger">
                                            {{ $errors->first('responsible') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Inisiatif</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" name="initiate"
                                            value="{{ old('initiate') }}" placeholder="Skala 10-100">
                                    </div>

                                    @if ($errors->has('initiate'))
                                        <div class="text-danger">
                                            {{ $errors->first('initiate') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Teamwork</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" name="teamwork"
                                            value="{{ old('teamwork') }}" placeholder="Skala 10-100">
                                    </div>

                                    @if ($errors->has('teamwork'))
                                        <div class="text-danger">
                                            {{ $errors->first('teamwork') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Work Performance</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" name="work_performance"
                                            value="{{ old('work_performance') }}" placeholder="Skala 10-100">
                                    </div>

                                    @if ($errors->has('work_performance'))
                                        <div class="text-danger">
                                            {{ $errors->first('work_performance') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Kedisiplinan</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control"
                                            value="{{ $nl_kedisiplinan }}  (Berdasarkan presensi serta jumlah terlambat/pulang awal)"
                                            placeholder="Skala 10-100" alt="Nilai ini" disabled>
                                        <input type="hidden" class="form-control" name="discipline"
                                            value="{{ $nl_kedisiplinan }}" placeholder="Skala 10-100">
                                    </div>

                                    @if ($errors->has('discipline'))
                                        <div class="text-danger">
                                            {{ $errors->first('discipline') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Buat penilaian!</button>
            </div>
        </div>

    </div>
    {!! Form::close() !!}



@endsection
