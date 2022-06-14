@extends('main.layouts.app')

@section('content')
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Reset password</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="{{ url('') }}">Beranda</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">reset password</h6>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h1 class="display-4 text-uppercase mb-5">Rental Shakila</h1>
                    <div class="row mx-n2 mb-3">
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{ asset('_main/img/gallery-1.jpg') }}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{ asset('_main/img/gallery-2.jpg') }}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{ asset('_main/img/gallery-3.jpg') }}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{ asset('_main/img/gallery-4.jpg') }}" alt="">
                        </div>
                    </div>
                    <p>Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua
                        sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et
                        sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod,
                        dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna
                    </p>

                </div>
                <div class="col-lg-6 mb-5" id="target">
                    <div class="bg-secondary p-5">
                        <!-- <h3 class="text-primary text-center mb-4">Masuk ke Rental Shakila</h3> -->
                        @if (session()->has('success'))
                            <div class="text-success text-center text-bold mb-4 h4"> {{ session('success') }}</div>
                        @endif

                        @if (session()->has('warning'))
                            <div class="text-warning text-center text-bold mb-4 h4"> {{ session('warning') }}</div>
                        @endif

                        @if (session()->has('error'))
                            <div class="text-danger text-center text-bold mb-4 h4"> {{ session('error') }}</div>
                        @endif
                        <form action="{{ route('main.resetPasswordProcess') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="form-group">
                                <div>
                                    <input type="password" name="password"
                                        class="form-control p-4 @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password Baru" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input type="password" name="password_confirmation"
                                        class="form-control p-4 @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi Password Baru" />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 50px;">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('custom-js')
    @if ($errors->any() || session()->has('success') || session()->has('warning') || session()->has('error'))
        window.onload = function() {
        var el = document.getElementById('target');
        el.scrollIntoView(true);
        }
    @endif
@endsection
@endsection
