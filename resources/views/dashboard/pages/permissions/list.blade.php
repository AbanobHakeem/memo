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
                        <h1>permissions Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">permissions</li>
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
                                @can('dashboard.permissions.create')
                                <h3 class="card-title"> <a href="{{ route('dashboard.permissions.create') }}"
                                        class="btn btn-primary">Add new</a></h3>
                                @endcan

                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center" id='permissions'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Route</th>
                                            <th>Garud</th>
                                            @canany(['dashboard.permissions.edit', 'dashboard.permissions.destroy'])
                                            <th>Action</th>
                                            @endcanany

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                               @canany(['dashboard.permissions.edit', 'dashboard.permissions.destroy'])
                                               <td>
                                                   <a href="{{ route('dashboard.permissions.edit', $permission->id) }}"
                                                       class="btn btn-outline-success">Edit</a>
                                                   <a href="{{ route('dashboard.permissions.destroy', $permission->id) }}"
                                                       class="btn btn-outline-danger btn-destroy">Delete</a>
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
                                            <th>
                                                <input type="text" placeholder="Search Name" />
                                            </th>
                                            <th>
                                                <input type="text" placeholder="Search Guard" />
                                            </th>
                                          
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class=" d-flex justify-content-center">

                                </div>
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
    <div class="modal fade" id="delete-recored" tabindex="-1" role="dialog" aria-labelledby="delete-recoredLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-recoredLabel">Remove recored</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure of deleteing this recored</h5>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DElETE</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
            $("#permissions").DataTable({
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
            }).buttons().container().appendTo('#permissions_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
