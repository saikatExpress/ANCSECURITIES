@extends('admin.layout.app')
<link rel="stylesheet" href="{{ asset('admin/css/user.css') }}">
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
                <a class="btn btn-sm btn-primary" href="{{ route('user.list') }}">
                    User List
                </a>
                <a class="btn btn-sm btn-success" href="{{ route('active.user') }}">
                    Active User List
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" id="errorAlert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create User</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <strong class="text-danger fw-bold ml-3" id="accountExits"></strong>
                        <strong style="display: none;" id="avaiable" class="text-success fw-bold ml-3"><i class="fas fa-solid fa-check"></i> Avaiable</strong>
                        <strong style="display: none;" id="notavaiable" class="text-danger fw-bold ml-3"><i class="fas fa-solid fa-circle-exclamation"></i> Not found</strong>

                        <div class="box-body">
                            <form id="user-form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="wizard">
                                    <!-- Step 1 -->
                                    <div class="step" id="step-1">
                                        <h3 class="step_header">Account Information</h3>
                                        <div class="form-group">
                                            <label for="trading_code">Trading Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="trading_code" id="trading_code">
                                            <span class="error-message" id="error-trading_code"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name">
                                            <span class="error-message" id="error-name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email">
                                            <span class="error-message" id="error-email"></span>
                                        </div>
                                    </div>

                                    <!-- Step 2 -->
                                    <div class="step" id="step-2" style="display: none;">
                                        <h3 class="step_header">Contact Details</h3>
                                        <div class="form-group">
                                            <label for="fathername">Father Name</label>
                                            <input type="text" class="form-control" name="father_name" id="father_name">
                                            <span class="error-message" id="error-father_name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="mothername">Mother Name</label>
                                            <input type="text" class="form-control" name="mother_name" id="mother_name">
                                            <span class="error-message" id="error-mother_name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile">
                                            <span class="error-message" id="error-mobile"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Whatsapp <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="whatsapp" id="whatsapp">
                                            <span class="error-message" id="error-whatsapp"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <textarea name="address" class="form-control" id="address"></textarea>
                                            <span class="error-message" id="error-address"></span>
                                        </div>
                                    </div>

                                    <!-- Step 3 -->
                                    <div class="step" id="step-3" style="display: none;">
                                        <h3 class="step_header">Bank Info</h3>
                                        <div class="form-group">
                                            <label for="bank">Bank Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="bank_name" id="bank_name">
                                            <span class="error-message" id="error-bank"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="bankac">Bank A/C No <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="bank_account_no" id="bank_account_no">
                                            <span class="error-message" id="error-bank_account_no"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="bankac">Branch Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="branch_name" id="branch_name">
                                            <span class="error-message" id="error-branch"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="bankac">Routing Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="routing_number" id="routing_number">
                                            <span class="error-message" id="error-routing"></span>
                                        </div>
                                    </div>

                                    <!-- Step 4 -->
                                    <div class="step" id="step-4" style="display: none;">
                                        <h3 class="step_header">Additional Information</h3>
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password">
                                            <span class="error-message" id="error-password"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="profile_image">Upload Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                                            <span class="error-message" id="error-profile_image"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="signature">Signature</label>
                                            <input type="file" name="signature" id="signature" class="form-control">
                                            <span class="error-message" id="error-signature"></span>
                                        </div>
                                    </div>

                                    <!-- Step 5 -->
                                    <div class="step" id="step-5" style="display: none;">
                                        <h3 class="step_header">Review & Submit</h3>
                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <select name="role" class="form-control" id="role">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="checkBo" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Are you want to create an Trading Code...?
                                            </label>
                                        </div>

                                        <p class="text-success">Review your information before submission.</p>
                                        <button type="submit" class="btn btn-sm btn-primary" id="submit-button">Submit</button>
                                    </div>

                                    <div class="wizard-nav">
                                        <button type="button" class="btn btn-sm btn-primary" id="prev-btn" class="nav-btn" style="display: none;">Previous</button>
                                        <button type="button" class="btn btn-sm btn-primary" id="next-btn" class="nav-btn">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/user.js') }}"></script>
    <script src="{{ asset('admin/assets/js/step.js') }}"></script>
@endsection
