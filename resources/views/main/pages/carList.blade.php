@extends('main.layouts.app')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Daftar Mobil</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="{{ url('') }}">Beranda</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Daftar Mobil</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            {{-- <h1 class="display-1 text-primary text-center">03</h1> --}}
            {{-- <h1 class="display-4 text-uppercase text-center mb-5">Pilih mobil anda</h1> --}}
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="rent-item mb-4">
                            <img class="img-fluid mb-4" src="{{ asset('_images/' . $car->image) }}" alt="">
                            <h4 class="text-uppercase mb-4">{{ $car->type }}</h4>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="px-2">
                                    <i class="fa fa-car text-primary mr-1"></i>
                                    <span>{{ $car->price }}</span>
                                </div>
                                <div class="px-2 border-left border-right">
                                    <i class="fa fa-cogs text-primary mr-1"></i>
                                    <span>{{ $car->total }}</span>
                                </div>
                                <div class="px-2">
                                    <i class="fa fa-road text-primary mr-1"></i>
                                    <span>25K</span>
                                </div>
                            </div>

                            @guest
                                <a class="btn btn-primary px-3 mr-1" href="{{ route('main.register') }}">Daftar</a>
                                <a class="btn btn-primary px-3" href="{{ route('main.login') }}">Masuk</a>
                            @else
                                <a class="btn btn-primary px-3" href="{{ route('main.rental', $car->id) }}">Rental</a>
                            @endguest

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->
@endsection
