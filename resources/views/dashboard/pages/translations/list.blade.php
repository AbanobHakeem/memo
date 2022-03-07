@extends('layouts.dashboard')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Translation Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Translation</li>
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
                        <div class="card">
                            <div class="card-header">
                                @can('dashboard.translation.store')
                                <h3 class="card-title"> <a data-toggle="modal" data-target="#addTrans"
                                        class="btn btn-primary">Add new</a></h3>
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="example1" class="table table-hover text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>KEY</th>
                                        @foreach ($prefixes as $prefix)
                                            <th>{{ ucfirst($prefix) }}</th>
                                        @endforeach
                                        @canany(['dashboard.translation.store','dashboard.translation.destroy'])
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keys as $key)
                                        <tr>
                                            <td data-name="key">{{ $key }}</td>
                                            @foreach ($langs as $prefix => $lang)
                                                <td data-name="{{ $prefix }}">{{ $lang[$key] ?? '' }}</td>
                                            @endforeach
                                            @canany(['dashboard.translation.store','dashboard.translation.destroy'])
                                            <td>
                                                @can('dashboard.translation.store')
                                                <a href="" class="btn btn-outline-success btn-editTrans" data-toggle="modal"
                                                    data-target="#editTrans">Edit</a>
                                                @endcan
                                                @can('dashboard.translation.destroy')
                                                <a href="" class="btn btn-outline-danger btn-destroy-trans"
                                                    data-key="{{ $key }}">Delete</a>
                                                @endcan
                                            </td>
                                            @endcanany
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="text" placeholder="Search KEY" />
                                        </th>
                                        @foreach ($prefixes as $prefix)
                                            <th>
                                                <input type="text" placeholder="Search {{ ucfirst($prefix) }}" />
                                            </th>
                                        @endforeach
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>




    <!-- Modal -->
    <div class="modal fade" id="addTrans" tabindex="-1" role="dialog" aria-labelledby="addTransTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransTitle">Add new Translation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.translation.store') }}" method="POST" id="storeTransForm">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">KEY</label>
                            <input type="text" class="form-control" name="key" id="key" aria-describedby="helpId"
                                placeholder="Add new KEY">
                        </div>
                        @foreach ($prefixes as $prefix)
                            <div class="mb-3">
                                <label for="" class="form-label">{{ $prefix }}</label>
                                <input type="text" class="form-control" name="langs[{{ $prefix }}]"
                                    aria-describedby="helpId" placeholder="Add new {{ $prefix }}">
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('storeTransForm').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editTrans" tabindex="-1" role="dialog" aria-labelledby="editTransTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransTitle">Edit Translation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.translation.store') }}" method="POST" id="updateTransForm">
                        @csrf
                        <input type="text" class="form-control" name="key" id="key" aria-describedby="helpId" hidden
                            placeholder="Add new KEY">
                        @foreach ($prefixes as $prefix)
                            <div class="mb-3">
                                <label for="" class="form-label">{{ $prefix }}</label>
                                <input type="text" class="form-control" name="langs[{{ $prefix }}]"
                                    id="{{ $prefix }}" aria-describedby="helpId"
                                    placeholder="Add new {{ $prefix }}">
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('updateTransForm').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-trans-form" action="{{ route('dashboard.translation.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="key">
    </form>
@endsection
@push('js')
    <script src="{{ asset('control') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('control') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('control') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('control') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('control') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "cloumsearch": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
