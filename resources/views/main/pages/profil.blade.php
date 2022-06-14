@extends('main.layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header">
	<h1 class="display-3 text-uppercase text-white mb-3">Profil</h1>
	<div class="d-inline-flex text-white">
		<h6 class="text-uppercase m-0"><a class="text-white" href="{{ url('/') }}">Beranda</a></h6>
		<h6 class="text-body m-0 px-3">/</h6>
		<h6 class="text-uppercase text-body m-0">Profil</h6>
	</div>
</div>
<!-- Page Header Start -->
<div class="container-fluid pb-5" id="target">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<h2 class="mb-4">Personal Detail</h2>
				<div class="mb-5">
					<div class="row">
						<div class="col-6 form-group">
							<label class="text-secondary" for="paypal">Nama</label>
							<input type="text" class="form-control p-4" value="{{ auth()->user()->name }}" disabled>
						</div>
						<div class="col-6 form-group">
							<label class="text-secondary" for="paypal">Nomor HP</label>
							<input type="text" class="form-control p-4" value="{{ auth()->user()->phone }}" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-12 form-group">
							<label class="text-secondary" for="paypal">Email</label>
							<input type="email" class="form-control p-4" value="{{ auth()->user()->email }}" disabled>
						</div>
						<div class="col-12 form-group">
							<label class="text-secondary" for="paypal">Alamat</label>
							<input type="text" class="form-control p-4" value="{{ auth()->user()->address }}" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
                    <div class="bg-secondary py-4 pr-4 mb-5">
                    	<form action="{{ route('main.changePassword') }}" method="POST">
                    		@csrf
                    		@method('put')
                        <h2 class="text-primary mb-4 text-center">Ubah Password</h2>
                        @if (session()->has('success'))
                            <div class="text-success text-center text-bold mb-4 h4"> {{ session('success') }}</div>
                        @endif

                        @if (session()->has('warning'))
                            <div class="text-warning text-center text-bold mb-4 h4"> {{ session('warning') }}</div>
                        @endif

                        @if (session()->has('error'))
                            <div class="text-danger text-center text-bold mb-4 h4"> {{ session('error') }}</div>
                        @endif
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                            	<label for="paypal">Password Baru</label>
                                <input type="password" name="password"
                                        class="form-control p-4 @error('password') is-invalid @enderror"
                                        placeholder="Password Baru" required/>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <label for="paypal">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                        class="form-control p-4 @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi Password Baru" required/>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="ml-4">
                        	
                        	<button class="btn btn-block btn-primary py-3">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('custom-js')
        window.onload = function() {
        var el = document.getElementById('target');
        el.scrollIntoView(true);
        }
@endsection
@endsection