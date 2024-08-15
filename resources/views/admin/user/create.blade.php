@extends('admin.layout.app')
<style>
    .wizard {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.step {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.error-message {
    color: red;
    font-size: 0.875em;
}

.wizard-nav {
    margin-top: 20px;
    text-align: center;
}

.nav-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    color: #fff;
    background-color: #007bff;
    cursor: pointer;
    font-size: 16px;
}

.nav-btn:disabled {
    background-color: #aaa;
    cursor: not-allowed;
}
</style>
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
                            {{-- <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Trading Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="trading_code" id="trading_code">
                                    @error('trading_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile" id="mobile">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" id=""></textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="password" id="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="fileInputsContainer">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                                        @error('profile_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Signature</label>
                                    <input type="file" name="signature" id="signature" class="form-control">
                                    @error('signature')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </div>
                            </form> --}}
                            <div class="wizard">
                                <!-- Step 1 -->
                                <div class="step" id="step-1">
                                    <h3>Step 1: Account Information</h3>
                                    <form id="user-form">
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
                                    </form>
                                </div>

                                <!-- Step 2 -->
                                <div class="step" id="step-2" style="display: none;">
                                    <h3>Step 2: Contact Details</h3>
                                    <form id="user-form">
                                        <div class="form-group">
                                            <label for="mobile">Mobile <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile">
                                            <span class="error-message" id="error-mobile"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <textarea name="address" class="form-control" id="address"></textarea>
                                            <span class="error-message" id="error-address"></span>
                                        </div>
                                    </form>
                                </div>

                                <!-- Step 3 -->
                                <div class="step" id="step-3" style="display: none;">
                                    <h3>Step 3: Additional Information</h3>
                                    <form id="user-form">
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
                                    </form>
                                </div>

                                <!-- Step 4 -->
                                <div class="step" id="step-4" style="display: none;">
                                    <h3>Step 4: Review & Submit</h3>
                                    <p>Review your information before submission.</p>
                                    <button type="button" id="submit-button">Submit</button>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="wizard-nav">
                                    <button type="button" id="prev-btn" class="nav-btn" style="display: none;">Previous</button>
                                    <button type="button" id="next-btn" class="nav-btn">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        $(document).ready(function(){
            $('#trading_code').on('input', function(){
                var code = $(this).val();

                if(code){
                    $.ajax({
                        url: '/get/trade/code/' + code,
                        type: 'GET',
                        success: function(response){
                            if(response && response.warning === false){
                                $('#accountExits').html('Sorry : This account already registered..!');
                                $('#notavaiable').hide();
                                $('#name, #email, #mobile').val('');
                                return false;
                            }

                            if (response && response.success === true) {
                                $('#avaiable, .instructions, #register_form').show();
                                $('#notavaiable').hide();
                                $('#accountExits').hide();
                                $('#name').val(response.traderInfo.name);
                                $('#email').val(response.traderInfo.email);
                                $('#mobile').val(response.traderInfo.cell_no);
                            } else {
                                $('#notavaiable').show();
                                $('#name, #email, #mobile').val('');
                            }
                        },
                        error: function(error){
                            console.error('An error occurred:', error);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentStep = 1;
            const totalSteps = 4;

            const showStep = (step) => {
                for (let i = 1; i <= totalSteps; i++) {
                    document.getElementById(`step-${i}`).style.display = (i === step) ? 'block' : 'none';
                }
                document.getElementById('prev-btn').style.display = (step === 1) ? 'none' : 'inline-block';
                document.getElementById('next-btn').textContent = (step === totalSteps) ? 'Submit' : 'Next';
            };

            document.getElementById('next-btn').addEventListener('click', function() {
                if (currentStep < totalSteps) {
                    if (validateStep(currentStep)) {
                        currentStep++;
                        showStep(currentStep);
                    }
                } else {
                    document.getElementById('user-form').submit();
                }
            });

            document.getElementById('prev-btn').addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            const validateStep = (step) => {
                let isValid = true;
                document.querySelectorAll(`#step-${step} .form-control`).forEach(input => {
                    const errorId = `error-${input.id}`;
                    const errorMessage = document.getElementById(errorId);
                    if (input.value.trim() === '') {
                        errorMessage.textContent = 'This field is required';
                        isValid = false;
                    } else {
                        errorMessage.textContent = '';
                    }
                });
                return isValid;
            };

            showStep(currentStep);
        });
    </script>
@endsection
