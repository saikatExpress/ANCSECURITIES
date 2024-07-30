@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
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
            <form id="projectSettingsForm" action="" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-wizard">
                        <div class="form-wizard-step form-wizard-step-active" data-step="1">
                            <h3>Step 1: Basic Information</h3>
                            <div class="form-group">
                                <label for="project-name">Project Name</label>
                                <input type="text" id="project-name" name="project_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="project-description">Project Description</label>
                                <textarea id="project-description" name="project_description" class="form-control" required></textarea>
                            </div>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <div class="form-wizard-step" data-step="2" style="display: none;">
                            <h3>Step 2: Advanced Settings</h3>
                            <div class="form-group">
                                <label for="project-url">Project URL</label>
                                <input type="url" id="project-url" name="project_url" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="project-email">Project Email</label>
                                <input type="email" id="project-email" name="project_email" class="form-control" required>
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <div class="form-wizard-step" data-step="3" style="display: none;">
                            <h3>Step 3: Additional Information</h3>
                            <div class="form-group">
                                <label for="project-phone">Project Phone</label>
                                <input type="tel" id="project-phone" name="project_phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="project-address">Project Address</label>
                                <textarea id="project-address" name="project_address" class="form-control" required></textarea>
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

        // Handle form submission via AJAX
        $('#projectSettingsForm').on('submit', function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Settings saved successfully!',
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to save settings. Please try again.',
                    });
                }
            });
        });
    });
</script>

@endsection
