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
                            <li class="breadcrumb-item"><a href="{{ url('/panel/rental') }}">Data Rental</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
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
                                <h4 class="m-0">Ubah Data</h4>
                            </div>
                            <div class="card-body">
                                <!-- form start -->
                                <form action="{{ route('panel.rental.update') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $rental->id }}">
                                    <div class="form-group">
                                        <label>Pilih Kustomer</label>
                                        <select name="user_id" class="form-control select2 select2-teal @error('user_id') is-invalid  @enderror" data-dropdown-css-class="select2-teal" style="width: 100%;">
                                          <option selected="selected" disabled>Pilih Kustomer</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ ($user->id == $rental->user->id) ? 'selected' : '' }}>{{ $user->name }} &mdash; {{ $user->email }} &mdash; {{ $user->phone }}</option>    
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
                                            <option value="{{ $car->id }}" {{ ($car->id == $rental->car->id) ? 'selected' : '' }}>{{ $car->type }} &mdash; {{ $car->price }}</option>    
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
                                        <label>Tanggal Kembali</label>
                                        <div class="input-group date" id="returnDate"
                                            data-target-input="nearest">
                                            <div class="input-group-prepend"
                                                data-target="#returnDate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i
                                                        class="fa fa-calendar"></i></div>
                                            </div>
                                            <input type="text" name="return_date"
                                                class="form-control datetimepicker-input"
                                                data-target="#returnDate"
                                                data-toggle="datetimepicker"
                                                autocomplete="off"
                                                value="{{ $rental->return_date == null ? 'Belum Kembali' : formatDate($rental->return_date) }}"
                                                placeholder="{{ $rental->return_date == null ? 'Belum Kembali' : formatDate($rental->return_date) }}" />
                                            
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                          <option value="pending" {{ ($rental->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                          <option value="active" {{ ($rental->status == 'active') ? 'selected' : '' }}>Aktif</option>
                                          <option value="success" {{ ($rental->status == 'success') ? 'selected' : '' }}>Selesai</option>
                                          <option value="canceled" {{ ($rental->status == 'canceled') ? 'selected' : '' }}>Batal</option>
                                        </select>
                                      </div>
                                    <div class="form-group">
                                        <input type="submit" class="form-control btn btn-teal" value="Ubah">
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
    <script src="{{ asset('_panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection
@section('custom-js')
$('#returnDate').datetimepicker({
    format: 'DD-MM-YYYY'
});
    $(function () {
        bsCustomFileInput.init();
        $('.select2').select2();
        //Date range picker
        $('#reservation').daterangepicker({
            startDate: '{{ formatDate($rental->start_date, 'd-m-Y') }}', 
            endDate: '{{ formatDate($rental->end_date, 'd-m-Y') }}',
            locale: {
                format: 'DD-MM-YYYY'
            }
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
