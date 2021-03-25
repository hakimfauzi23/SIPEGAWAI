{{-- @extends('login.base')

@section('title', 'Reset Password')

@section('content')
    <div class="wrap-login200 p-l-55 p-r-55 p-t-80 p-b-30">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        <form method="POST" action="/reset-password">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>@endsection --}}


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
