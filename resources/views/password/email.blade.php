@extends('login.base')

@section('title', 'Lupa Password')

@section('content')
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
        <form action="{{ route('forget-password.postEmail') }}" method="POST" class="login100-form validate-form">
            {{ csrf_field() }}
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <span class="login100-form-title p-b-37">
                Masukan Email Anda
            </span>

            <div class="mb-3"></div>
            <div class="row">
                <div class="wrap-input100 validate-input m-b-20 " data-validate="Masukan Email Anda">
                    <input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="focus-input100"></span>
                </div>
            </div>

            <div class="mt-4"></div>
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    Send Password Reset Link!
                </button>
            </div>
            <div class="mt-3"></div>
            <div class="text-center">
                <a href="/login" class="txt2 hov1">
                    Login Di sini
                </a>
            </div>
        </form>
    </div>
@endsection
