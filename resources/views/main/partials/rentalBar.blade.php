<div class="container-fluid bg-white pt-3 px-lg-5">
    <div class="row mx-n2 d-flex justify-content-center">

        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <form action="{{ route('main.rentalBarProcess') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" name="bar_start_date" id="rentalbarstartdate"
                            class="form-control p-4 rentalbarstartdate datetimepicker-input @error('bar_start_date') is-invalid @enderror"
                            placeholder="Tanggal Mulai" data-target="#rentalbarstartdate" data-toggle="datetimepicker"
                            @guest disabled @endguest autocomplete="off"/>
                        @error('bar_start_date')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <div class="form-group">
                <div class="input-group date" data-target-input="nearest">
                    <input type="text" name="bar_end_date" id="rentalbarenddate"
                        class="form-control p-4 rentalbarenddate datetimepicker-input @error('bar_end_date') is-invalid @enderror"
                        placeholder="Tanggal Mulai" data-target="#rentalbarenddate" data-toggle="datetimepicker" @guest
                        disabled @endguest autocomplete="off"/>
                    @error('bar_end_date')
                        <span class="invalid-feedback" role="alert"> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-6 px-2">
            <select name="bar_car_id" class="custom-select px-4 mb-3 @error('bar_car_id') is-invalid @enderror" style="height: 50px;" @guest disabled @endguest>
                <option selected disabled>Pilih Mobil</option>
                @isset($cars)
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->type }}</option>
                    @endforeach
                @endisset
            </select>
            @error('bar_car_id')
                <span class="invalid-feedback" role="alert"> {{ $message }}
                </span>
            @enderror
        </div>


        @auth
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">Rental</button>
            </div>
        @endauth
        </form>
        @guest
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <a href="{{ route('main.register') }}">
                    <button class="btn btn-primary btn-block mb-3" style="height: 50px;">Daftar</button>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 px-2">
                <a href="{{ route('main.login') }}">
                    <button class="btn btn-primary btn-block mb-3" style="height: 50px;">Masuk</button>
                </a>
            </div>
        @endguest
    </div>
</div>
