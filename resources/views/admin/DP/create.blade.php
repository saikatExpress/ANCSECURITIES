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
                <a class="btn btn-sm btn-primary" href="{{ route('dp.list') }}">
                    DP List
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
                    <h3 class="box-title">Create DP</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('dp.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>DP Name <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="dp_name" placeholder="Enter title...">
                            <small class="text-danger">Maximum 100 words</small> <br>
                            @error('dp_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DP Email <span class="text-danger"> * </span> </label>
                            <input type="email" class="form-control" name="dp_email" placeholder="Enter title...">
                            @error('dp_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone Number <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="phone_number">
                            <small class="text-danger">Maximum 20 numbers</small> <br>
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fax </label>
                            <input type="text" class="form-control" name="fax">
                            @error('fax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Authority Name </label>
                            <input type="text" class="form-control" name="employee_name">
                            @error('employee_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Authority Designation </label>
                            <input type="text" class="form-control" name="employee_designation">
                            @error('employee_designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Address <span class="text-danger"> * </span></label>
                            <textarea class="form-control" rows="3" name="address" placeholder="Enter description..."></textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Website Link </label>
                            <input type="text" class="form-control" name="website_link">
                            @error('website_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status </label>
                            <select name="status" id="status" class="form-control">
                                <option value="full-service">Full service</option>
                                <option value="custodian">Custodian</option>
                                <option value="treasury">Treasury</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Create DP</button>
                    </form>
                </div>
                <!-- /.box-body -->
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
