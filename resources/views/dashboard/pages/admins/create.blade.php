@extends('layouts.dashboard')
@push('css')
    <!-- textarea -->
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('control') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>admin Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">admin</li>
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
                            <h3 class="card-title">Add new Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dashboard.admins.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body row">
                               
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                                        value="{{ old('name') }}" id="name" placeholder="Enter name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                        <label class="custom-file-label" for="avatar">Choose file</label>
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">email</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror "
                                        value="{{ old('email') }}" id="email" placeholder="Enter email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror "
                                        value="{{ old('password') }}" id="password" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 text-primray">
                                    <label>Roels</label>
                                    <select name="roles[]" class="form-control select2 @error('roles') is-invalid @enderror " multiple
                                        style="width: 100%">
                                        @foreach ($roles as  $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>                                        
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="active"> Active the admin</label>
                                    <div class="custom-control custom-switch ">
                                        <input type="checkbox" name="active"
                                            class="custom-control-input @error('active') is-invalid @enderror " id="active">
                                        <label class="custom-control-label" for="active"></label>
                                    </div>
                                    @error('active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- /.card-body -->
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
        <!-- Summernote -->
<script src="{{ asset('control') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            // Summernote
              $('#summernote').summernote()
        })
    </script>
     <!-- Select2 -->
     <script src="{{ asset('control') }}/plugins/select2/js/select2.full.min.js"></script>
     <script>
         $(function() {
             //Initialize Select2 Elements
             $('.select2').select2()
 
             //Initialize Select2 Elements
             $('.select2bs4').select2({
                 theme: 'bootstrap4'
             })
         })
     </script>
@endpush
