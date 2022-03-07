@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>role Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">

                    <!-- general form elements -->
                    <div class="card card-primary col-12">
                        <div class="card-header">
                            <h3 class="card-title">Add new Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dashboard.roles.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body row">
                               
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                                        value="{{ old('name') }}" id="name" placeholder="Enter name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                    <!-- Bootstrap Switch -->
                                <div class="card card-secondary  col-12">
                                    <div class="card-header">
                                        <h3 class="card-title">Role Permitions</h3>
                                    </div>
                                    <div class="card-body row">
                                        @foreach ($permissions as $permisiion)
                                        <div class="col-md-4">
                                            <label for="">
                                                <input type="checkbox" name="permissions[]" value="{{ $permisiion->name}}"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            <span class="ml-1"> </span>{{ $permisiion->name}}
                                            </label>

                                        </div>
                                        @endforeach
                                        </div>
                                    </div>
                                
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
  <!-- Bootstrap Switch -->
<script src="{{ asset('control') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
        $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>
@endpush
