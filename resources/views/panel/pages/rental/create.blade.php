@extends('panel.layouts.app')

@section('title', 'Dashboard')
@section('custom-import-css')
    <link rel="stylesheet" href="{{ asset('_panel/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('_panel/plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Tambah Rental</li>
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
                                <h4 class="m-0">Tambah Mobil</h4>
                            </div>
                            <div class="card-body">
                                <!-- form start -->
                                <form action="{{ route('panel.rental.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Pilih Kustomer</label>
                                        <select name="user_id" class="form-control select2 select2-teal @error('user_id') is-invalid  @enderror" data-dropdown-css-class="select2-teal" style="width: 100%;">
                                          <option selected="selected" disabled>Pilih Kustomer</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} &mdash; {{ $user->email }} &mdash; {{ $user->phone }}</option>    
                                          @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Mobil</label>
                                        <select name="car_id" class="form-control select2 select2-teal @error('car_id') is-invalid  @enderror" data-dropdown-css-class="select2-teal" style="width: 100%;">
                                          <option selected="selected" disabled>Pilih Mobil</option>
                                          @foreach ($cars as $car)
                                            <option value="{{ $car->id }}">{{ $car->type }} &mdash; {{ $car->price }}</option>    
                                          @endforeach
                                        </select>
                                        @error('car_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Rental</label>
                      
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                          <input type="text" name="rental_date" class="form-control float-right" id="reservation">
                                        </div>
                                        <!-- /.input group -->
                                      </div>
                                      <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                          <option value="pending">Pending</option>
                                          <option value="active">Aktif</option>
                                        </select>
                                      </div>
                                    <div class="form-group">
                                        <input type="submit" class="form-control btn btn-teal" value="Tambah">
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
    <script src="{{ asset('_panel/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection
@section('custom-js')
    $(function () {
        bsCustomFileInput.init();
        $('.select2').select2();
        //Date range picker
        $('#reservation').daterangepicker({
            minDate: new Date(),
        });
    });
    $(document).ready(function() {
        setTimeout(function() {
        $(".alert").alert('close');
        }, 3000);
    });
    image.onchange = evt => {
        const [file] = image.files;
        if (file) {
            imagePreview.style.display = "block";
            imagePreview.src = URL.createObjectURL(file);
        }
    }
@endsection
@endsection
