@extends('admin.layout.app')

@section('content')

    <div class="content-wrapper">
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
                <a class="btn btn-sm btn-primary" href="{{ route('staff.create') }}">
                    Add Staff
                </a>
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

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Staff</h3>
                </div>
                <div class="box-body">
                    <form id="staffForm" action="{{ route('staff.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                        <!-- Step 1 -->
                        <div class="form-step form-step-active">
                            <div class="step-header">
                                <i style="padding: 15px;border-radius: 50%;background-color: cornflowerblue;color: #fff;" class="fa fa-user"></i>
                                <h3>Basic Information</h3>
                            </div>

                            <div class="form-group">
                                <label for="image">Staff Image</label>
                                <div class="current-image">
                                    @if($staff->staff_image && $staff->staff_image != 'noimage.jpg')
                                        <img style="width: 80px;height:80px;border-radius:4px;box-shadow:0 0 10px;" src="{{ asset('storage/user_photo/profile/' . $staff->staff_image) }}" alt="Staff Image" style="width: 150px; height: auto;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Signature</label>
                                <div class="current-image">
                                    @if($staff->signature && $staff->signature != 'noimage.jpg')
                                        <img style="width: 80px;height:80px;border-radius:4px;box-shadow:0 0 10px;" src="{{ asset('storage/user_photo/signature/' . $staff->signature) }}" alt="Staff Image" style="width: 150px; height: auto;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
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
                                <input class="form-control" name="name" type="text" value="{{ $staff->name }}" placeholder="Enter name"/>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ $staff->email }}" placeholder="Enter email"/>
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
                                <label for="designationId">Designation</label>
                                <select name="designation_id" id="designationId" class="form-control">
                                    <option value="">Nothing selected</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}"
                                            {{ $designation->id == $staff->designation_id ? 'selected' : '' }}>
                                            {{ $designation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" name="mobile" placeholder="Enter Mobile" value="{{ $staff->mobile }}" type="text"/>
                                @error('mobile')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="permanent_address">Permanent Address</label>
                                <input class="form-control" name="permanent_address" value="{{ $staff->permanent_address }}" type="text"/>
                                @error('permanent_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="present_address">Present Address</label>
                                <input class="form-control" name="present_address" value="{{ $staff->present_address }}" type="text"/>
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
                                <input class="form-control" name="basic_salary" value="{{ $staff->basic_salary }}" type="text"/>
                                @error('basic_salary')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nid">NID</label>
                                <input class="form-control" name="nid" value="{{ $staff->nid }}" type="text"/>
                                @error('nid')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="birth_certificate">Birth Certificate</label>
                                <input class="form-control" name="birth_certificate" value="{{ $staff->birth_certificate }}" type="text"/>
                                @error('birth_certificate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <select name="nationality" id="nationality" class="form-control">
                                    <option value="bangladeshi" selected>Bangladeshi</option>
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
                                        <option style="text-transform: uppercase;" {{ $roll->name === $userRole ? 'selected' : '' }} value="{{ $roll->name }}">{{ strtoupper($roll->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option>Select Status</option>
                                    <option value="1" {{ $staff->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $staff->status == '0' ? 'selected' : '' }}>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" value="1" class="custom-control-input" tabindex="3" id="remember-me" {{ ($userRole == '') ? '' : 'checked' }}>
                                    <label class="custom-control-label" for="remember-me">Are you sure you want to create a user?</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-prev">Previous</button>
                            <button type="submit" class="btn btn-primary">Update Staff</button>
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
    <script src="{{ asset('admin/assets/js/staff.js') }}"></script>
@endsection
