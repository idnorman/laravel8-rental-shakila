@extends('panel.layouts.app')

@section('title', $car->type)

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ url('/panel') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/panel/mobil') }}">Data Mobil</a></li>
                            <li class="breadcrumb-item active">{{ $car->type }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        <h5 class="mb-0">{{ session()->get('success') }}</h5>
                    </div>
                @endif
                <div class="row">

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <!-- Profile Image -->
                        <div class="card card-teal card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="img-fluid rounded mx-auto" src="{{ asset('_images/' . $car->image) }}"
                                        alt="Car Images">
                                </div>
                                <ul class="list-group list-group-unbordered my-3">
                                    <li class="list-group-item">
                                        <b>Jenis</b> <a class="float-right">{{ $car->type }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Biaya Rental</b> <a class="float-right">{{ $car->price }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tersedia</b> <a class="float-right">{{ $car->total }}</a>
                                    </li>
                                </ul>

                                <a href="{{ route('panel.car.edit', $car->id) }}"
                                    class="btn btn-warning btn-block"><b>Ubah</b></a>
                                <button class="btn btn-danger btn-block mt-2 font-weight-bold" data-toggle="modal"
                                    data-target="#modal-default">Hapus</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="card card-teal card-outline">
                            <div class="card-header p-2">
                                <h4 class="heading ml-1 mt-1">Riwayat Rental</h4>
                            </div><!-- /.card-header -->
                            <div class="card-body pb-1">
                                <div class="list-group">
                                    @forelse ($rentals as $rental)
                                        <a href="{{ route('panel.rental.show', $rental->id) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 text-body">{{ $rental->user->name }}</h5>
                                                <span class="text-body">{!! formatDate($rental->start_date) . ' &mdash; ' . formatDate($rental->end_date) !!}</span>
                                            </div>
                                            <p class="mb-1 text-body">Status:
                                                @if ($rental->status == 'active')
                                                    <span class="text-center text-info">Aktif</span>
                                                @elseif($rental->status == 'pending')
                                                    <span class="text-center text-warning">Menunggu Konfirmasi</span>
                                                @elseif($rental->status == 'finish')
                                                    <span class="text-center text-success">Selesai</span>
                                                @else
                                                    <span class="text-center text-danger">Batal</span>
                                                @endif
                                            </p>
                                        </a>
                                    @empty
                                    <span class="text-center text-muted">Riwayat kosong</span>
                                    @endforelse
                                </div>
                               
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $rentals->links() !!}
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
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
                    <form action="{{ route('panel.car.delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $car->id }}">
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

@section('custom-js')
$(document).ready(function() {
    setTimeout(function() {
    $(".alert").alert('close');
    }, 3000);
});

@endsection