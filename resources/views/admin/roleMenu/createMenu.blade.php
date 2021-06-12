@extends('layout.base')


@section('title', 'Tambah Menu')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajamen Role & Menu</span>
                    - Tambah Menu Baru</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('manajemen.index') }}"> <i class="active icon-home2 position-left"></i>
                        Role & Menu
                    </a>
                </li>
                <li class="active">Tambah Menu Baru</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini untuk menambah menu baru di dalam SIPEGAWAI</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('manajemen.storeMenu') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Menu</label>
                            <input type="text" name="judul" class="form-control" placeholder="Nama Menu . . .  "
                                value="{{ old('judul') }}">

                            @if ($errors->has('judul'))
                                <div class="text-danger">
                                    {{ $errors->first('judul') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">URL Menu</label>
                            <input type="text" name="url" class="form-control"
                                placeholder="Contoh : suratPeringatan/create . . .  " value="{{ old('url') }}">

                            @if ($errors->has('url'))
                                <div class="text-danger">
                                    {{ $errors->first('url') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select class="select" name="id_hak_akses" data-placeholder="Pilih Hak Akses">
                                <option value=""></option>
                                @foreach ($hak_akses as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_hak_akses'))
                                <div class="text-danger">
                                    {{ $errors->first('id_hak_akses') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Parent Menu</label>
                            <select class="select" name="id_parent" >
                                <option value=""> Independen</option>
                                @foreach ($parent as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_parent'))
                                <div class="text-danger">
                                    {{ $errors->first('id_parent') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kode Icon Menu (khusus independen Menu)</label>
                            <select style="font-weight:900px" class="select-icons" name="icon" data-placeholder="Pilih Icon Menu">
                                <option value=""></option>
                                <option value=''> Tidak Ada Icon</option>
                                @foreach ($icon as $value)
                                    <option data-icon="{{ str_replace('icon-', '', $value) }}"
                                        value="{{ $value }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('icon'))
                                <div class="text-danger">
                                    {{ $errors->first('icon') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Order / Urutan Menu</label>
                            <input type="number" name="order" class="form-control"
                                placeholder="Contoh : suratPeringatan/create . . .  " value="{{ $order }}">

                            @if ($errors->has('order'))
                                <div class="text-danger">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                        </div>
                    </div>
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
