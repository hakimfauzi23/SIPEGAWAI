@extends('layout.base')

@section('title', 'Dashboard')


@section('content_header')
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title text-center">
                <h2><span class="text-semibold">SIPEGAWAI</span></h2>
            </div>

        </div>

    </div>
@endsection

@section('content')

    <div class="panel bg-success">
        <div class="text-center">
            <h4>Selamat Datang {{ Auth::user()->nama }} !!</h4>
        </div>
    </div>
@endsection
