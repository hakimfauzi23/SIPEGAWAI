@extends('login.base')

@section('title', 'Lupa Password')

@section('content')
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">

        <span class="login100-form-title p-b-37">
            Reset Password
        </span>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reset-password.updatePassword') }}" method="POST" class="login100-form validate-form">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3"></div>
            <div class="wrap-input100 validate-input m-b-20 " data-validate="Masukan Email Anda">
                <input id="email" class="input100" type="text" name="email" placeholder="Masukan Email"
                    value="{{ old('email') }}">
                <span class="focus-input100"></span>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="wrap-input100 validate-input m-b-20 " data-validate="Masukan Password Baru">
                <input id="password" class="input100" type="password" name="password" placeholder="Masukan Password Baru"
                    value="{{ old('password') }}">
                <span class="focus-input100"></span>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="wrap-input100 validate-input m-b-20 " data-validate="Konfirmasi Password Baru">
                <input id="password-confirm" class="input100" type="password" name="password_confirmation"
                    placeholder="Konfirmasi Password Baru" value="{{ old('password_confirmation') }}">
                <span class="focus-input100"></span>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>


            <div class="mt-4"></div>
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@endsection
