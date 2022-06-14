@extends('panel.layouts.skeleton')

@section('app')

<body class="hold-transition login-page accent-teal">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-teal">
            <div class="card-header text-center">
                <a class="h1">Rental<b>Shakila</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Lupa password? Dapatkan link untuk reset password melalui email anda</p>
                <form action="{{ route('panel.forgetPasswordProcess') }}" method="post">
                    {{ @csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @if(session()->has('success'))

                    <div class="text-success text-center text-bold my-3"> {{ session('success') }}</div>

                    @endif

                    @if(session()->has('warning'))

                    <div class="text-warning text-center text-bold my-3"> {{ session('warning') }}</div>
                    @endif

                    @if(session()->has('error'))

                    <div class="text-danger text-center text-bold my-3"> {{ session('error') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-teal btn-block">Dapatkan password baru</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('panel.login') }}">Masuk</a>
                </p>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    @endsection