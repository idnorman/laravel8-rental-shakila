@extends('panel.layouts.skeleton')

@section('app')

<body class="hold-transition login-page accent-teal">
    <div class="login-box">
        <div class="card card-outline card-teal">
            <div class="card-header text-center">
                <a class="h1">Rental<b>Shakila</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silakan ubah password anda dengan form berikut</p>
                @if(session()->has('success'))

                <div class="text-success text-center text-bold mb-3"> {{ session('success') }}</div>

                @endif

                @if(session()->has('warning'))

                <div class="text-warning text-center text-bold mb-3"> {{ session('warning') }}</div>
                @endif

                @if(session()->has('error'))

                <div class="text-danger text-center text-bold mb-3"> {{ session('error') }}</div>
                @endif
                <form action="{{ route('panel.resetPasswordProcess') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
            <span class="invalid-feedback" role="alert">
              {{ $message }}
            </span>
            @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
              {{ $message }}
              </span>
            @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-teal btn-block">Ubah password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="{{ route('panel.login') }}">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->



    @endSection