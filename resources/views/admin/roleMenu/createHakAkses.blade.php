@extends('layout.base')


@section('title', 'Tambah Menu')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajamen Role & Menu</span>
                    - Tambah Data Menu</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('manajemen.index') }}"> <i class="active icon-home2 position-left"></i> Manajemen
                        Menu &
                        Role
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
                <h6> Hak akses ditambahkan apabila terdapat menu baru yang memerlukan Hak akses baru.</h6>
            </em>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('manajemen.storeHakAkses') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Hak Akses </label>
                            <input type="text" name="name" class="form-control" placeholder="Hak Akses Baru . . ."
                                value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
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
