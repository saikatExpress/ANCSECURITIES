@extends('admin.layout.app')
<style>
    .step-header h3{
        margin-top: 0;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('staff.list') }}">Staff List</a>
            </p>
        </section>

        <section class="content">

            @if ($errors->any())
                <div class="alert alert-danger errorAlert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
            @endif

            @if(session('errors'))
                <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
            @endif

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Staff</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form id="staffForm" action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1 -->
                        <div class="form-step form-step-active">
                            <div class="step-header">
                                <i style="padding: 15px;border-radius: 50%;background-color: cornflowerblue;color: #fff;" class="fa fa-user"></i>
                                <h3>Basic Information</h3>
                            </div>
                            <div class="form-group">
                                <label for="image">Staff Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Signature</label>
                                <input type="file" name="signature" class="form-control">
                                @error('signature')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="branchSlug">Branch</label>
                                <select name="branch-slug" id="branchSlug" class="form-control">
                                    <option value="">Nothing selected</option>
                                    {{-- @foreach ($branches as $branch) --}}
                                    {{-- <option value="{{ $branch->slug }}">{{ $branch->branch_name }}</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                                @error('branch-slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter name"/>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Enter email"/>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>

                        <!-- Step 2 -->
                        <div class="form-step">
                            <div class="step-header">
                                <i class="fa fa-phone" style="padding: 15px;border-radius: 50%;background-color: cornflowerblue;color: #fff;"></i>
                                <h3>Contact Information</h3>
                            </div>
                            <div class="form-group">
                                <label for="designationId">Department</label>
                                <select name="department_id" id="departmentId" class="form-control">
                                    <option value="">Nothing selected</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="designationId">Designation</label>
                                <select name="designation_id" id="designationId" class="form-control">
                                    <option value="">Nothing selected</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" name="mobile" placeholder="Enter Mobile" type="text"/>
                                @error('mobile')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address</label>
                                <input class="form-control" name="permanent_address" placeholder="Enter permanent address" type="text"/>
                                @error('permanent_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="present_address">Present Address</label>
                                <input class="form-control" name="present_address" placeholder="Enter present address" type="text"/>
                                @error('present_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-secondary btn-prev">Previous</button>
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>

                        <!-- Step 3 -->
                        <div class="form-step">
                            <div class="step-header">
                                <i class="fa fa-money" style="padding: 15px;border-radius: 50%;background-color: cornflowerblue;color: #fff;"></i>
                                <h3>Additional Information</h3>
                            </div>
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input class="form-control" name="basic_salary" placeholder="Enter basic salary" type="text"/>
                                @error('basic_salary')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nid">NID</label>
                                <input class="form-control" name="nid" placeholder="Enter NID" type="text"/>
                                @error('nid')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="birth_certificate">Birth Certificate</label>
                                <input class="form-control" name="birth_certificate" placeholder="Enter birth certificate" type="text"/>
                                @error('birth_certificate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <select name="nationality" id="nationality" class="form-control">
                                    <option value="">Nothing selected</option>
                                    <option value="bangladeshi">Bangladeshi</option>
                                    <option value="others">Others</option>
                                </select>
                                @error('nationality')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-secondary btn-prev">Previous</button>
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>

                        <!-- Step 4 -->
                        <div class="form-step">
                            <div class="step-header">
                                <i class="fa fa-check-circle" style="padding: 15px;border-radius: 50%;background-color: cornflowerblue;color: #fff;"></i>
                                <h3>Role & Status</h3>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <option selected disabled>Select Role</option>
                                    @foreach ($roles as $roll)
                                        <option style="text-transform: uppercase;" value="{{ $roll->name }}">{{ $roll->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" value="1" class="custom-control-input" tabindex="3" id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Are you sure you want to create a user?</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-prev">Previous</button>
                            <button type="submit" class="btn btn-primary">Save Staff</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>

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
    <script>
        $(document).ready(function() {
            // Show the alert message
            $('.errorAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('.errorAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        $(document).ready(function() {
            let currentStep = 0;
            const steps = $('.form-step');
            const totalSteps = steps.length;

            function showStep(stepIndex) {
                steps.hide();
                $(steps[stepIndex]).show();
            }

            function validateStep(stepIndex) {
                let isValid = true;
                $(steps[stepIndex]).find('input, select').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return isValid;
            }

            $('.btn-next').on('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    if (currentStep >= totalSteps) {
                        currentStep = totalSteps - 1;
                    }
                    showStep(currentStep);
                }
            });

            $('.btn-prev').on('click', function() {
                currentStep--;
                if (currentStep < 0) {
                    currentStep = 0;
                }
                showStep(currentStep);
            });

            showStep(currentStep);
        });
    </script>
@endsection
