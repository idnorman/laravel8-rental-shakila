@extends('main.layouts.app')

@section('custom-import-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('_panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection


@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Car Listing</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Listing</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    <div class="container">
        @if (session()->has('success'))
            <div class="text-success text-center text-bold mb-5 h4"> {{ session('success') }}</div>
        @endif

        @if (session()->has('warning'))
            <div class="text-warning text-center text-bold mb-5 h4"> {{ session('warning') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="text-danger text-center text-bold mb-5 h4"> {{ session('error') }}</div>
        @endif


        <table class="table" id="example1">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mobil</th>
                    <th scope="col">Tgl Mulai</th>
                    <th scope="col">Tgl Selesai</th>
                    <th scope="col">Tgl Kembali</th>
                    <th class="text-center" scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $rental->car->type }}</th>
                        <th>{{ formatDate($rental->start_date) }}</th>
                        <th>{{ formatDate($rental->end_date) }}</th>
                        <th class="text-center">@if (empty($rental->return_date))
                                -
                            @else
                                {{ formatDate($rental->return_date) }}
                            @endif
                        </th>
                        @if($rental->status == 'active')
                        <th class="text-center text-info">Aktif</th>
                        @elseif($rental->status == 'pending')
                        <th class="text-center text-warning">Menunggu Konfirmasi</th>
                        @elseif($rental->status == 'finish')
                        <th class="text-center text-success">Selesai</th>
                        @else
                        <th class="text-center text-danger">Batal</th>
                        @endif
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
@endsection

@section('custom-import-js')
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
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
    "language": {
        "zeroRecords": "Belum ada transaksi",
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
    {{-- "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"] --}}
    "buttons": [
        {
            extend: 'copyHtml5',
            exportOptions: {
                {{-- columns: [0,2,3,4] --}}
            }
        },
        {
            extend: 'csvHtml5',
            exportOptions: {
                {{-- columns: [0,2,3,4] --}}
            }
        },
        {
            extend: 'excelHtml5',
            exportOptions: {
                {{-- columns: [0,2,3,4] --}}
            }
        },
        {
            extend: 'pdfHtml5',
            exportOptions: {
                {{-- columns: [0,2,3,4] --}}
            }
        },
        {
            extend: 'print',
            exportOptions: {
                {{-- columns: [0,2,3,4] --}}
            }
        },
        {
            extend: 'colvis'
        }
    ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
@endsection