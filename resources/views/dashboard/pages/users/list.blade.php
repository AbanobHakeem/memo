@extends('layouts.dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>users Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">users</li>
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
                                @can('dashboard.users.create')
                                <h3 class="card-title"> <a href="{{ route('dashboard.users.create') }}"
                                        class="btn btn-primary">Add new</a></h3>
                                @endcan

                                <div class="card-tools">
                                    <form class="d-flex" method="GET"
                                        action="{{ route('dashboard.users.index') }}">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="search" class="form-control float-right"
                                                placeholder="Search" value="{{ request('search') ?? '' }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Avatar</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            @canany(['dashboard.users.toggle'])
                                            <th>Active</th>
                                            @endcan
                                            @canany(['dashboard.users.edit','dashboard.users.destroy'])
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td> <img src="{{ Storage::url("public/users/").$user->avatar }}"  class="img-thumbnail" alt="{{ $user->name }}" srcset=""></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                @can('dashboard.users.toggle')
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-status" data-url="{{ route('dashboard.users.toggle',$user->id) }}"
                                                            data-id="{{ $user->id }}"
                                                            @if ($user->active) checked @endif
                                                            id="customSwitch{{ $user->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                @endcan
                                                    @canany(['dashboard.users.edit','dashboard.users.destroy'])
                                                    <td>
                                                        @can('dashboard.users.edit')
                                                        <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                            class="btn btn-outline-success">Edit</a> 
                                                        @endcan
                                                     @can('dashboard.users.destroy')
                                                     <a href="{{ route('dashboard.users.destroy', $user->id) }}"
                                                        class="btn btn-outline-danger btn-destroy">Delete</a> 
                                                     @endcan
                                                    </td>
                                                    @endcan
                                               
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class=" d-flex justify-content-center">

                                    {{ $users->appends($_GET)->links('pagination::bootstrap-4') }}
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
