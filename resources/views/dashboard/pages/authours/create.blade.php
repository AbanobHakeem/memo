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
                        <h1>authour Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">authour</li>
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
                        <form method="POST" action="{{ route('dashboard.authours.store') }}" enctype="multipart/form-data">
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
                                    
                                @enderror
                                  </div>
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                      <div class="card-header">
                                        <h3 class="card-title">
                                          Bio
                                        </h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body">
                                        <textarea  class=" @error('bio') is-invalid @enderror " id="summernote" name="bio" >
                                        </textarea>
                                      </div>
                                      <div class="card-footer">
                                        @error('bio')
                                        <span class="d-block invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                      </div>
                                    </div>
                                  </div>    
                                <div class="form-group col-md-6 ">
                                    <label for="active"> Active the authour</label>
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
@endpush
