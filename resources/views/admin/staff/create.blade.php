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
                    Staff List
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
                    <h3 class="box-title">Create Staff</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">Staff Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="">Branch</label>
                            <select name="branch-slug" id="branchSlug" class="form-control">
                                <option value="">Nothing select</option>
                                @foreach ($branches as $key => $branch)
                                    <option value="{{ $branch->slug }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>

                            @error('branch-slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div> --}}

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter name"/>

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Enter email"/>

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Designation</label>
                            <select name="designation_id" id="designationId" class="form-control">
                                <option value="">Nothing select</option>
                                @foreach ($designations as $key => $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                @endforeach
                            </select>

                            @error('designation_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="form-group">
                            <label>Mobile</label>
                            <input class="form-control" name="mobile" placeholder="Enter Mobile" type="text"/>

                            @error('mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Permanent Address</label>
                            <input class="form-control" name="permanent_address" placeholder="Enter permanent address" type="text"/>

                            @error('permanent_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Present Address</label>
                            <input class="form-control" name="present_address" placeholder="Enter present address" type="text"/>

                            @error('present_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Basic Salary</label>
                            <input class="form-control" name="basic_salary" placeholder="Enter present address" type="text"/>

                            @error('basic_salary')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NID</label>
                            <input class="form-control" name="nid" placeholder="Enter NID" type="text"/>

                            @error('nid')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Birth Certificate</label>
                            <input class="form-control" name="birth_certificate" placeholder="Enter birth certificate" type="text"/>

                            @error('birth_certificate')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Nationality</label>
                            <select name="nationality" id="designationId" class="form-control">
                                <option value="">Nothing select</option>
                                <option value="bangladeshi">Bangladeshi</option>
                                <option value="others">Others</option>
                            </select>

                            @error('nationality')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option>Select Role</option>
                                <option value="">Admin</option>
                                <option value="">Customer</option>
                                <option value="">Executive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Non Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" value="1" class="custom-control-input"
                                    tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Are you want to create user...?</label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">
                            Save Staff
                        </button>

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
