@extends('layouts.dashboard')
@push('css')
    <!-- textarea -->
    <link rel="stylesheet" href="{{ asset('control') }}/plugins/summernote/summernote-bs4.min.css">

@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>user Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">user</li>
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
                            <h3 class="card-title">Add new Laguage</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
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
                                @can('dashboard.users.toggle')
                                    <div class="form-group col-md-12 ">
                                        <label for="active"> Active the user</label>
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
                                @endcan
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
@endpush
