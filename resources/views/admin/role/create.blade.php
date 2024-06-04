@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('role.list') }}">
                    Role List
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Role</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Role Name <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name...">
                            <small class="text-danger"></small> <br>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" style="display: flex; flex-wrap: wrap;">
                            <label style="flex-basis: 100%;">Select Permissions</label>
                            @foreach ($permissions as $permission)
                                <div class="checkbox" style="flex-basis: 50%;">
                                    <label style="width: 100%;text-transform: uppercase;">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"> {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                            @error('permissions.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-sm btn-primary">Create Role</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Show the alert message
            $('#successAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>
@endsection
