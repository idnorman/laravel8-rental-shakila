@extends('panel.layouts.app')

@section('title', 'Tambah Mobil')

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
                            <li class="breadcrumb-item"><a href="{{ url('/panel/mobil') }}">Data Mobil</a></li>
                            <li class="breadcrumb-item active">Tambah Mobil</li>
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
                                <form action="{{ route('panel.car.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="type">Jenis Mobil</label>
                                        <input type="text" name="type"
                                            class="form-control @error('type') is-invalid @enderror" id="type"
                                            value="{{ old('type') }}" placeholder="Kijang Innove Hitam tahun 2012">
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="price">Biaya Rental/Hari</label>
                                        <input type="number" name="price"
                                            class="form-control @error('price') is-invalid @enderror" id="price"
                                            value="{{ old('price') }}" placeholder="200000">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Jumlah Tersedia</label>
                                        <input type="number" name="total"
                                            class="form-control @error('total') is-invalid @enderror" id="total"
                                            value="{{ old('total') }}" placeholder="2">
                                        @error('total')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Foto Mobil</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image"
                                                    class="custom-file-input form-control @error('image') is-invalid @enderror"
                                                    id="image">
                                                <label class="custom-file-label" for="image">Pilih Gambar</label>
                                            </div>
                                        </div>
                                        @error('image')
                                            <span class="text-danger text-sm" style="font-size: 80% !important" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <div class="d-flex justify-content-start">
                                            <img id="imagePreview" class="mt-3" width="200" src="#" alt="Image Preview" style="display: none"/>
                                        </div>
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
    image.onchange = evt => {
        const [file] = image.files;
        if (file) {
            imagePreview.style.display = "block";
            imagePreview.src = URL.createObjectURL(file);
        }
    }
@endsection
@endsection
