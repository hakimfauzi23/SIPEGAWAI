@extends('layout.base')


@section('title', 'Ganti Password')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-unlocked"></i> <span class="text-semibold">Ganti Password</span></h4>
            </div>

        </div>

    </div>
@endsection

@section('content')
    <!-- 2 columns form -->

    <form method="POST" action="{{ route('pass.store') }}">
        {{ csrf_field() }}
        <div class="panel panel-flat">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body text-center">
                @csrf

                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Masukan Password Sekarang</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="current_password"
                            autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Masukan Password Baru</label>

                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control" name="new_password"
                            autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>

                    <div class="col-md-6">
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password"
                            autocomplete="current-password">
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Update! <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>

    <!-- /2 columns form -->
@endsection

