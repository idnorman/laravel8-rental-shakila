@extends('main.layouts.app')

@section('content')
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Rental</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="{{ url('/') }}">Beranda</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Rental</h6>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <h4 class="text-secondary text-uppercase mb-5">rental {{ $car->type }}</h4>
                <div>
                    <img class="img-fluid mb-4" src="{{ asset('_images/' . $car->image) }}" width="500" alt="">
                    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 50px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 50px; height: 50px;">
                            <i class="fa fa-2x fa-money-bill-wave text-secondary"></i>
                        </div>
                        <h4 class="text-light text-uppercase m-0">{{ $car->price }}</h4>
                    </div>
                    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 50px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 50px; height: 50px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h4 class="text-light text-uppercase m-0">Car Reservation Anytime</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5" id="target">
                <div class="bg-secondary p-5">
                    @if(session()->has('success'))
                        <span class="text-primary text-center"> {{ session()->get('message') }} </span>
                    @endif
                    <!-- <h3 class="text-primary text-center mb-4">Masuk ke Rental Shakila</h3> -->
                    <form action="{{ route('main.rentalProcess') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="form-group">
                            <label for="rentalstartdate">Tanggal Mulai</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" name="start_date" id="rentalstartdate" class="form-control p-4 rentalstartdate datetimepicker-input @error('start_date') is-invalid @enderror" placeholder="Tanggal Mulai" data-target="#rentalstartdate" data-toggle="datetimepicker" autocomplete="off"/>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rentalenddate">Tanggal Selesai</label>
                            <div class="input-group date" id="rentalenddate" data-target-input="nearest">
                                <input type="text" name="end_date" class="form-control p-4 rentalenddate datetimepicker-input @error('end_date') is-invalid @enderror" placeholder="Tanggal Selesai" data-target="#rentalenddate" data-toggle="datetimepicker" autocomplete="off"/>
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group mb-0 pt-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 50px;">Rental</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @section('custom-js')

    $('#rentalstartdate').datetimepicker({
        format: 'L',
        minDate: new Date(new Date().setHours(0,0,0,0)),
        @if(session()->has('startDate'))
        date: '{{ session('startDate')}}'
        @endif
    });
    $('#rentalenddate').datetimepicker({
        format: 'L',
        minDate: new Date(new Date().setHours(0,0,0,0)),
        @if(session()->has('endDate'))
        date: '{{ session('endDate')}}'
        @endif
    });
    @if(!($errors->has('bar_start_date') or $errors->has('bar_end_date') or $errors->has('bar_car_id')))
    window.onload = function() {
        var el = document.getElementById('target');
        el.scrollIntoView(true);
    }
    @endif
    @endsection
@endsection