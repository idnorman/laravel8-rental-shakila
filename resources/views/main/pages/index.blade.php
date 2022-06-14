@extends('main.layouts.app')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0" style="margin-bottom: 90px;">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('_main/img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                        <h1 class="display-1 text-white mb-md-4">Best Rental Cars In Your Location</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('_main/img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Rent A Car</h4>
                        <h1 class="display-1 text-white mb-md-4">Quality Cars with Unlimited Miles</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        {{-- <h1 class="display-1 text-primary text-center">01</h1> --}}
        <h1 class="display-4 text-uppercase text-center mb-5">Welcome To <span class="text-primary">Royal Cars</span></h1>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <img class="w-75 mb-4" src="{{ asset('_main/img/about.png') }}" alt="">
                <p>Justo et eos et ut takimata sed sadipscing dolore lorem, et elitr labore labore voluptua no rebum sed, stet voluptua amet sed elitr ea dolor dolores no clita. Dolores diam magna clita ea eos amet, amet rebum voluptua vero vero sed clita accusam takimata. Nonumy labore ipsum sea voluptua sea eos sit justo, no ipsum sanctus sanctus no et no ipsum amet, tempor labore est labore no. Eos diam eirmod lorem ut eirmod, ipsum diam sadipscing stet dolores elitr elitr eirmod dolore. Magna elitr accusam takimata labore, et at erat eirmod consetetur tempor eirmod invidunt est, ipsum nonumy at et.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-headset text-secondary"></i>
                    </div>
                    <h4 class="text-uppercase m-0">24/7 Car Rental Support</h4>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-car text-secondary"></i>
                    </div>
                    <h4 class="text-light text-uppercase m-0">Car Reservation Anytime</h4>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
                    </div>
                    <h4 class="text-uppercase m-0">Lots Of Pickup Locations</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@guest
<!-- Banner Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mx-0">
            <div class="col-lg-6 px-0">
                <div class="px-5 bg-secondary d-flex align-items-center justify-content-between" style="height: 350px;">
                    <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="{{ asset('_main/img/banner-left.png') }}" alt="">
                    <div class="text-right">
                        <h3 class="text-uppercase text-light mb-3">Belum punya akun?</h3>
                        <p class="mb-4">Segera mendaftar melalui tombol dibawah ini</p>
                        <a class="btn btn-primary py-2 px-4" href="{{ route('main.register') }}">Daftar</a>
                        </div>
                </div>
            </div>
            <div class="col-lg-6 px-0">
                <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                    <div class="text-left">
                        <h3 class="text-uppercase text-light mb-3">Sudah punya akun?</h3>
                        <p class="mb-4">Silakan masuk untuk dengan tombol dibawah ini</p>
                        <a class="btn btn-primary py-2 px-4" href="{{ route('main.login') }}">Masuk</a>
                    </div>
                    <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="{{ asset('_main/img/banner-right.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
@endguest
    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            {{-- <h1 class="display-1 text-primary text-center">03</h1> --}}
            <h1 class="display-4 text-uppercase text-center mb-5">Pilih mobil anda</h1>
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
@section('custom-js')
    @if ($errors->any() || session()->has('success') || session()->has('warning') || session()->has('error'))
        window.onload = function() {
        var el = document.getElementById('target');
        el.scrollIntoView(true);
        }
    @endif
@endsection
@endsection
