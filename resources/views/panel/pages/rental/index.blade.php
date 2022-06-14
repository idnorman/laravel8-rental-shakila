@php
function dateFormat($date)
{
    $date = explode('-', $date);
    $date = $date[2] . '-' . $date[1] . '-' . $date[0];
    return $date;
}
@endphp

@extends('panel.layouts.app')

@section('title', 'Dashboard')
@section('custom-import-css')

    {{-- <link rel="stylesheet" href="{{ asset('_panel/plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                            <li class="breadcrumb-item"><a href="{{ url('/panel') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Data Rental</li>
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
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5 class="mb-0">{{ session()->get('success') }}</h5>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('panel.rental.create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kustomer</th>
                                            <th>Mobil</th>
                                            <th>Tgl Rental</th>
                                            <th>Tgl Kembali</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rentals as $rental)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $rental->user->name }}
                                                    <!-- <div class="card collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">{{ $rental->user->name }}</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool"
                                                                    data-card-widget="collapse">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div> -->
                                                            <!-- /.card-tools -->
                                                        <!-- </div> -->
                                                        <!-- /.card-header -->
                                                        <!-- <div class="card-body">
                                                            <dl>
                                                                <dt>Email: </dt>
                                                                <dd>{{ $rental->user->email }}</dd>
                                                                <dt>Nomor HP: </dt>
                                                                <dd>{{ $rental->user->phone }}</dd>
                                                                <dt>Alamat: </dt>
                                                                <dd>{{ $rental->user->address }}</dd>
                                                            </dl>
                                                        </div> -->
                                                        <!-- /.card-body -->
                                                    <!-- </div> -->
                                                </td>
                                                <td>{{ $rental->car->type }}</td>
                                                <td>{{ dateFormat($rental->start_date) . ' s/d ' . dateFormat($rental->end_date) }}
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('panel.rental.returnDateUpdate') }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="id" value="{{ $rental->id }}">
                                                        <div class="form-group">
                                                            <div class="input-group date returnDate" id="returnDate{{$rental->id}}"
                                                                data-target-input="nearest">
                                                                <input type="text" name="return_date"
                                                                    class="form-control returnDate datetimepicker-input"
                                                                    data-target="#returnDate{{$rental->id}}" data-toggle="datetimepicker" 
                                                                    autocomplete="off"
                                                                    value="{{ $rental->return_date == null ? '' : formatDate($rental->return_date) }}"
                                                                    placeholder="{{ $rental->return_date == null ? 'Belum Kembali' : formatDate($rental->return_date) }}" />
                                                                <div class="input-group-append"
                                                                    data-target="#returnDate{{$rental->id}}"
                                                                    data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i
                                                                            class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-teal text-center">Simpan</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('panel.rental.statusUpdate') }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="id" value="{{ $rental->id }}">
                                                        <div class="form-group">
                                                            <select name="status" class="form-control">
                                                                <option class="text-warning" value="pending"
                                                                    {{ $rental->status == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-info" value="active"
                                                                    {{ $rental->status == 'active' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option class="text-success" value="success"
                                                                    {{ $rental->status == 'success' ? 'selected' : '' }}>
                                                                    Selesai</option>
                                                                <option class="text-danger" value="canceled"
                                                                    {{ $rental->status == 'canceled' ? 'selected' : '' }}>
                                                                    Batal</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-teal text-center">Simpan</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('panel.rental.show', $rental->id) }}"
                                                        class="btn btn-sm btn-info d-block mb-1">Detail</a>
                                                    <a href="{{ route('panel.rental.edit', $rental->id) }}"
                                                        class="btn btn-sm btn-warning d-block mb-1">Ubah</a>
                                                    <a href="" class="btn btn-sm btn-danger d-block" data-toggle="modal"
                                                        data-target="#modal-default" data-id="{{ $rental->id }}"
                                                        data-type="{{ $rental->car->type }}">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kustomer</th>
                                            <th>Mobil</th>
                                            <th>Tgl Rental</th>
                                            <th>Tgl Kembali</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-12 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
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
                        <input type="hidden" name="id" value="" id="id">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@section('custom-import-js')
    <script src="{{ asset('_panel/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('_panel/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endsection
@section('custom-js')
    $(function () {
    $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "language": {
        "zeroRecords": "Belum ada data rental",
        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 dari 0 data",
        "paginate": {
            "previous": "Sebelumnya",
            "next": "Selanjutnya"
        },
        "search": "Cari: ",
        "buttons": {
            "copy": "Salin",
            "colvis": "Filter Kolom"
        }
    },
    "buttons": [
    {
    extend: 'copyHtml5',
    exportOptions: {
    columns: [0,2,3,4]
    }
    },
    {
    extend: 'csvHtml5',
    exportOptions: {
    columns: [0,2,3,4]
    }
    },
    {
    extend: 'excelHtml5',
    exportOptions: {
    columns: [0,2,3,4]
    }
    },
    {
    extend: 'pdfHtml5',
    exportOptions: {
    columns: [0,2,3,4]
    }
    },
    {
    extend: 'print',
    exportOptions: {
    columns: [0,2,3,4]
    }
    },
    {
    extend: 'colvis'
    }
    ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    });
    });

    $('.returnDate').each(function(){
        $(this).datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    

    //triggered when modal is about to be shown
    $('#modal-default').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var id = $(e.relatedTarget).data('id');
    var type = 'Hapus Data';

    //populate the textbox
    $(e.currentTarget).find('.modal-title').text(type);
    $(e.currentTarget).find('input[name="id"]').val(id);

    });

    $(document).ready(function() {
    setTimeout(function() {
    $(".alert").alert('close');
    }, 3000);
    });
@endsection
@endsection
