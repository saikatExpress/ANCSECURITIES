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
                <a class="btn btn-sm btn-primary" href="{{ route('form.list') }}">
                    Form List
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
                    <h3 class="box-title">Create Banner</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputFile">File upload</label>
                            <input type="file" name="form_file" id="exampleInputFile">
                            @error('form_file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Form Name <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="form_name" placeholder="Enter name...">
                            <small class="text-danger">Maximum 100 words</small> <br>
                            @error('form_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Form Title <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="form_title" placeholder="Enter title...">
                            <small class="text-danger">Maximum 100 words</small> <br>
                            @error('form_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Form Description</label>
                            <textarea class="form-control" rows="3" name="form_description" placeholder="Enter description..."></textarea>
                            @error('form_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Upload Form</button>
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
