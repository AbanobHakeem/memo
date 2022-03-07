@extends('layouts.dashboard')
@push('css')
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
                        <h1>Languages Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Languages</li>
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
                        <form method="POST" action="{{ route('dashboard.languages.store') }}">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-md-6">
                                    <label for="prefix">Prefix</label>
                                    <input type="text" name="prefix"
                                        class="form-control @error('prefix') is-invalid @enderror " id="prefix"
                                        value="{{ old('prefix') }}" placeholder="Enter prefix">
                                    @error('prefix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                                        value="{{ old('name') }}" id="name" placeholder="Enter name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="script">script</label>
                                    <input type="text" name="script"
                                        class="form-control @error('script') is-invalid @enderror " id="script"
                                        value="{{ old('script') }}" placeholder="Enter script">
                                    @error('script')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="native">native</label>
                                    <input type="text" name="native"
                                        class="form-control @error('native') is-invalid @enderror " id="native"
                                        value="{{ old('native') }}" placeholder="Enter native">
                                    @error('native')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="regional">regional</label>
                                    <input type="text" name="regional"
                                        class="form-control @error('regional') is-invalid @enderror " id="regional"
                                        value="{{ old('regional') }}" placeholder="Enter regional">
                                    @error('regional')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Direction</label>
                                    <select name="dir" class="form-control select2 @error('dir') is-invalid @enderror "
                                        style="width: 100%">
                                        <option selected="selected" value="rtl">RTL</option>
                                        <option selected="selected" value="ltr">LTR</option>
                                    </select>
                                    @error('dir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @can('dashboard.languages.toggle')
                                <div class="form-group col-md-6 ">
                                    <label for="active"> Active the language</label>
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
