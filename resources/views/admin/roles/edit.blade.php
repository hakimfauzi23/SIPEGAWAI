@extends('layout.base')


@section('title', 'Edit Data Role')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-key"></i> <span class="text-semibold">Manajemen Role dan Menu</span>
                    - Edit Data Role</h4>
            </div>

        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li> <a href="{{ route('manajemen.index') }}"> <i class="active icon-home2 position-left"></i> Manajemen
                        Role dan Menu
                    </a>
                </li>
                <li class="active">Edit Data Role</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel bg-info">
        <div class="panel-heading">
            <em>
                <h6> Halaman ini digunakan untuk mengedit hak akses pada setiap role yang ada di Aplikasi SIPEGAWAI ini.
                </h6>
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

    <?php $encrypt = Crypt::encryptString($role->id); ?>
    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['role.update', $encrypt]]) !!}
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="display-block text-semibold">Name</label>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="display-block text-semibold">Hak Akses</label>
                        @foreach ($permission as $value)
                            <label class="checkbox-inline">
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'styled']) }}{{ $value->name }}
                            </label>
                            <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
