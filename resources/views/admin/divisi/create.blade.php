@extends('layout.base')


@section('title', 'Tambah Data Divisi')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-hat"></i> <span class="text-semibold">Divisi</span>
                    - Tambah Data Divisi</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('divisi.index') }}"> <i class="active icon-home2 position-left"></i> List Data
                        Divisi
                    </a>
                </li>
                <li class="active">Tambah Data Divisi</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- 2 columns form -->
    <form method="post" enctype="multipart/form-data" action="{{ route('divisi.store') }}">

        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-heading">
                {{-- <h5 class="panel-title">Multiple columns</h5> --}}
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col">
                        <legend class="text-semibold"><i class="icon-pen-plus"></i> Data Divisi
                        </legend>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Divisi</label>
                    <input type="text" name="nm_divisi" class="form-control" placeholder="Nama Divisi . . . "
                        value="{{ old('nm_divisi') }}">

                    @if ($errors->has('nm_divisi'))
                        <div class="text-danger">
                            {{ $errors->first('nm_divisi') }}
                        </div>
                    @endif
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
