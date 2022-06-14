@extends('main.layouts.app')

@section('content')
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Daftar</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{ url('/') }}">Beranda</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Daftar</h6>
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
                <p>Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna</p>

            </div>
            <div class="col-lg-6 mb-5" id="target">
                <div class="bg-secondary p-5">
                    @if(session()->has('success'))
                        <span class="text-primary text-center"> {{ session()->get('message') }} </span>
                    @endif
                    <!-- <h3 class="text-primary text-center mb-4">Masuk ke Rental Shakila</h3> -->
                    <form action="{{ route('main.registerProcess') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="text" name="name" class="form-control p-4 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Shakila" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="email" name="email" class="form-control p-4 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Anda@email.com" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="number" name="phone" class="form-control p-4 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="08xxx..." />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="text" name="address" class="form-control p-4 @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Jl. Kartama..." />
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="password" name="password" class="form-control p-4 @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="password" name="password_confirmation" class="form-control p-4 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Konfirmasi Passowrd" />
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 50px;">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @section('custom-js')
    {{-- @if ($errors->any()) --}}
        window.onload = function() {
        var el = document.getElementById('target');
        el.scrollIntoView(true);
        }
    {{-- @endif --}}
    @endsection
@endsection