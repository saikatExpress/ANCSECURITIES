@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <x-sub-header/>
        <h1>
            Project Settings
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

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Project Settings</h3>
            </div>
            <form id="projectSettingsForm" action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-wizard">
                        <!-- Step 1: Basic Information -->
                        <div class="form-wizard-step form-wizard-step-active" data-step="1">
                            <h3>Step 1: Basic Information</h3>
                            <div class="form-group">
                                <label for="project-name">Project Name</label>
                                <input type="text" id="project-name" name="project_name" class="form-control" value="{{ old('project_name', $setting->project_name) }}">
                                @error('project_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-description">Project Description</label>
                                <textarea id="project-description" name="project_description" class="form-control">{{ old('project_description', $setting->project_description) }}</textarea>
                                @error('project_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-url">Project URL</label>
                                <input type="url" id="project-url" name="project_url" class="form-control" value="{{ old('project_url', $setting->project_url) }}">
                                @error('project_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-email">Project Email</label>
                                <input type="email" id="project-email" name="project_email" class="form-control" value="{{ old('project_email', $setting->project_email) }}">
                                @error('project_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-phone">Project Phone</label>
                                <input type="tel" id="project-phone" name="project_phone" class="form-control" value="{{ old('project_phone', $setting->project_phone) }}">
                                @error('project_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-phone1">Project Phone 1</label>
                                <input type="tel" id="project-phone1" name="project_phone1" class="form-control" value="{{ old('project_phone1', $setting->project_phone1) }}">
                                @error('project_phone1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-phone2">Project Phone 2</label>
                                <input type="tel" id="project-phone2" name="project_phone2" class="form-control" value="{{ old('project_phone2', $setting->project_phone2) }}">
                                @error('project_phone2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-phone3">Project Phone 3</label>
                                <input type="tel" id="project-phone3" name="project_phone3" class="form-control" value="{{ old('project_phone3', $setting->project_phone3) }}">
                                @error('project_phone2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 2: Advanced Settings -->
                        <div class="form-wizard-step" data-step="2" style="display: none;">
                            <h3>Step 2: Advanced Settings</h3>

                            <div class="form-group">
                                <label for="project-address">Project Address</label>
                                <textarea id="project-address" name="project_address" class="form-control">{{ old('project_address', $setting->project_address) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="body-background-color">Body Background Color</label>
                                <input type="color" id="body-background-color" name="body_background_color" class="form-control" value="{{ old('body_background_color', $setting->body_background_color) }}">
                                @error('body_background_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="facebook-url">Facebook URL</label>
                                <input type="url" id="facebook-url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $setting->facebook_url) }}">
                            </div>
                            <div class="form-group">
                                <label for="twiter-url">Twitter URL</label>
                                <input type="url" id="twiter-url" name="twiter_url" class="form-control" value="{{ old('twiter_url', $setting->twiter_url) }}">
                            </div>
                            <div class="form-group">
                                <label for="instagram-url">Instagram URL</label>
                                <input type="url" id="instagram-url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $setting->instagram_url) }}">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">WhatsApp Number</label>
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp', $setting->whatsapp) }}">
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 3: Privacy Settings -->
                        <div class="form-wizard-step" data-step="3" style="display: none;">
                            <h3>Step 3: Privacy Settings</h3>
                            <div class="form-group">
                                <label for="sub-header">Sub Header : </label>
                                <input type="checkbox" id="sub-header" name="sub_header" value="1" {{ old('sub_header', $setting->sub_header) ? 'checked' : '' }}>
                                <label for="sub-header">Enable</label>
                            </div>
                            <div class="form-group">
                                <label for="registration-status">Registration Status : </label>
                                <input type="checkbox" id="registration-status" name="registration_status" value="1" {{ old('registration_status', $setting->registration_status) ? 'checked' : '' }}>
                                <label for="registration-status">Enable</label>
                            </div>

                            <div class="form-group">
                                <label for="otp-status">OTP Status : </label>
                                <input type="checkbox" id="otp-status" name="otp_status" value="1" {{ old('otp_status', $setting->otp_status) ? 'checked' : '' }}>
                                <label for="otp-status">Enable</label>
                            </div>

                            <div class="form-group">
                                <label for="registation-male">Registration Male : </label>
                                <input type="checkbox" id="registation-male" name="registation_male" value="1" {{ old('registation_male', $setting->registation_male) ? 'checked' : '' }}>
                                <label for="registation-male">Enable</label>
                            </div>

                            <div class="form-group">
                                <label for="deposite-male">Deposit Male : </label>
                                <input type="checkbox" id="deposite-male" name="deposite_male" value="1" {{ old('deposite_male', $setting->deposite_male) ? 'checked' : '' }}>
                                <label for="deposite-male">Enable</label>
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                        <!-- Step 4: Images -->
                        <div class="form-wizard-step" data-step="4" style="display: none;">
                            <h3>Step 3: Images</h3>
                            <div class="form-group">
                                <label for="project-logo">Project Logo</label>
                                <input type="file" id="project-logo" name="project_logo" class="form-control" value="{{ old('project_logo', $setting->project_logo) }}">
                            </div>
                            <div class="form-group">
                                <label for="login-background-image">Login Background Image</label>
                                <input type="file" id="login-background-image" name="login_background_image" class="form-control" value="{{ old('login_background_image', $setting->login_background_image) }}">
                            </div>
                            <div class="form-group">
                                <label for="signup-background-image">Signup Background Image</label>
                                <input type="file" id="signup-background-image" name="signup_background_image" class="form-control" value="{{ old('signup_background_image', $setting->signup_background_image) }}">
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/watch.js') }}"></script>

<script>
    $(document).ready(function() {
        // Function to navigate to the next step
        $('.next-step').on('click', function() {
            var currentStep = $(this).closest('.form-wizard-step');
            var nextStep = currentStep.next('.form-wizard-step');

            currentStep.removeClass('form-wizard-step-active').hide();
            nextStep.addClass('form-wizard-step-active').show();
        });

        // Function to navigate to the previous step
        $('.prev-step').on('click', function() {
            var currentStep = $(this).closest('.form-wizard-step');
            var prevStep = currentStep.prev('.form-wizard-step');

            currentStep.removeClass('form-wizard-step-active').hide();
            prevStep.addClass('form-wizard-step-active').show();
        });

        // Show the success alert message
        $('#successAlert').show();
        setTimeout(function() {
            $('#successAlert').fadeOut('slow');
        }, 3000);
    });
</script>

@endsection
