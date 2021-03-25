@extends('login.base')

@section('title', 'Lupa Password')

@section('content')
    <div class="wrap-login200 p-l-55 p-r-55 p-t-80 p-b-30">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Link Untuk Reset Password Akun SIPEGAWAI Kamu Ada Di Bawah Sini</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <a href="http://127.0.0.1:8000/reset-password/{{ $token }}">Klik Disini</a>.
                    </div>
                </div>
            </div>
        </div>
</div>@endsection
