@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
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
                <a class="btn btn-sm btn-primary" href="{{ route('staff.create') }}">
                    Add Staff
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Satff List</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>IMAGE</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                        <tr class="list-item">
                            <td>{{ $staff->id }}</td>
                            <td>
                                <img style="width:60px;height:60px;border-radius:50%;" src="{{ asset('storage/staffs/'. $staff->staff_image) }}" alt="Image">
                            </td>
                            <td>
                                {{ $staff->name }}
                            </td>
                            <td>
                                {{ $staff->mobile }}
                            </td>
                            <td>
                                {{ $staff->email }}
                            </td>
                            <td>
                                {{ $staff->created_at->format('d-M-Y') }}
                            </td>
                            <td>
                                <a href="{{ route('staff.edit', ['id' => $staff->id]) }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                                <a href="" class="btn btn-sm btn-warning">
                                    View
                                </a>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $staff->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/form.js') }}"></script>

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
