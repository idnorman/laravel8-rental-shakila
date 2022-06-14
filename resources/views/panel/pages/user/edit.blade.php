@extends('panel.layouts.app')

@section('title', 'Ubah Data ' . $user->name )

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ url('/panel') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/panel/pengguna') }}">Data Pengguna</a></li>
                            <li class="breadcrumb-item active">Ubah Data {{ $user->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <div class="card card-teal card-outline">
                            <div class="card-header">
                                <h4 class="m-0">Ubah Data {{ $user->name }}</h4>
                            </div>
                            <div class="card-body">
                                <!-- form start -->
                                <form action="{{ route('panel.user.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $user->name }}" placeholder="{{ $user->name }}" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : $user->email }}" placeholder="{{ $user->email }}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <input type="number" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ? old('phone') : $user->phone }}" placeholder="{{ $user->phone }}" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') ? old('address') : $user->address }}" placeholder="{{ $user->address }}" />
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-block">Level Pengguna</label>
                            <div class="form-check-inline">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" value="customer" name="level" {{ ($user->level == 'customer') ? 'checked' : '' }}>
                                <label for="customRadio1" class="custom-control-label mr-2">Kustomer</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2" value="admin" name="level" {{ ($user->level == 'admin') ? 'checked' : '' }}>
                                <label for="customRadio2" class="custom-control-label">Admin</label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Konfirmasi Passowrd" />
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                        <input type="submit" class="form-control btn btn-teal" value="Simpan">
                        </div>
                    </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@section('custom-import-js')
    <script src="{{ asset('_panel/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
@section('custom-js')
    $(function () {
        bsCustomFileInput.init();
    });
    $(document).ready(function() {
        setTimeout(function() {
        $(".alert").alert('close');
        }, 3000);
    });

@endsection
@endsection
