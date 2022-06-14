@extends('panel.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ url('panel') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('panel/rental') }}">Data Rental</a></li>
                            <li class="breadcrumb-item active">Lihat Data</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Profile Image -->
                        <div class="card card-teal card-outline">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 my-auto mx-auto">
                                    <div class="card-body box-profile">
                                        <img class="img-fluid rounded" src="{{ asset('_images/' . $rental->car->image) }}"
                                            alt="Car Images">
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 ">
                                    <div class="card-body box-profile">

                                        <ul class="list-group list-group-unbordered my-2">
                                            <li class="list-group-item">
                                                <div class="card collapsed-card my-0">
                                                    <div class="card-header" data-card-widget="collapse">
                                                        <b class="float-left text-dark">Kustomer </b>
                                                        <a class="float-right">
                                                            {{ $rental->user->name }}
                                                            <button type="button" class="btn btn-tool pr-0" data-card-widget="collapse"> 
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </a>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body py-0">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <b class="float-left text-dark">Email </b>
                                                                <a
                                                                    class="float-right">{{ $rental->user->email }}</a>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b class="float-left text-dark">Telepon </b>
                                                                <a
                                                                    class="float-right">{{ $rental->user->phone }}</a>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b class="float-left text-dark">Alamat </b>
                                                                <a
                                                                    class="float-right">{{ $rental->user->address }}</a>
                                                            </li>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="card collapsed-card my-0">
                                                    <div class="card-header" data-card-widget="collapse">
                                                        <b class="float-left text-dark">Mobil </b>
                                                        <a class="float-right">
                                                            {{ $rental->car->type }}
                                                            <button type="button" class="btn btn-tool pr-0" data-card-widget="collapse"> 
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </a>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body py-0">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <b class="float-left text-dark">Biaya Rental/hari </b>
                                                                <a
                                                                    class="float-right">{{ formatPrice($rental->car->price) }}</a>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b class="float-left text-dark">Tersedia </b>
                                                                <a
                                                                    class="float-right">{{ $rental->car->total }}</a>
                                                            </li>
                                                            
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Tanggal Rental </b> <a class="float-right">{!! formatDate($rental->start_date) . ' &mdash; ' . formatDate($rental->end_date) !!}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Tanggal Kembali </b> <a
                                                    class="float-right">{{ formatDate($rental->return_date) }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Status</b>
                                                <a class="float-right">
                                                    @if ($rental->status == 'active')
                                                        <span class="text-center text-info">Aktif</span>
                                                    @elseif($rental->status == 'pending')
                                                        <span class="text-center text-warning">Menunggu Konfirmasi</span>
                                                    @elseif($rental->status == 'success')
                                                        <span class="text-center text-success">Selesai</span>
                                                    @else
                                                        <span class="text-center text-danger">Batal</span>
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <a href="{{ route('panel.rental.edit', $rental->id) }}"
                                    class="btn btn-warning btn-block"><b>Ubah</b></a>
                                <button class="btn btn-danger btn-block mt-2 font-weight-bold" data-toggle="modal"
                                    data-target="#modal-default">Hapus</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk mengapus data ini?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <form action="{{ route('panel.rental.delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $rental->id }}">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
