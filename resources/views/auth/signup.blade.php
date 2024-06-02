<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | ANC Securities Ltd.</title>
    <link rel="shortcut icon" href="{{ asset('auth/customer-service.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f5f7fa;
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .form-control {
            border-radius: 5px;
        }
        .container {
            margin-top: 50px;
        }
        .card-footer p {
            margin: 0;
        }
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 10px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Register</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('regisation.store') }}" id="signUpform">
                            @csrf
                            <!-- Name Field -->
                            <div class="form-group mb-3">
                                <label for="name">Name <span class="text-danger"> * </span></label>
                                <input type="text" id="name" name="name" class="form-control">
                                <small class="nameerror-message text-danger"></small>
                            </div>
                            <!-- Email Field -->
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger"> * </span></label>
                                <input type="email" id="email" name="email" class="form-control">
                                <small class="emailerror-message text-danger"></small>
                            </div>
                            <!-- Mobile Field -->
                            <div class="form-group mb-3">
                                <label for="mobile">Mobile Number <span class="text-danger"> * </span></label>
                                <input type="tel" id="mobile" name="mobile" class="form-control">
                                <small class="mobileerror-message text-danger"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mobile">Trading Code <span class="text-danger"> * </span></label>
                                <input type="text" id="tradingCode" name="trading_code" class="form-control">
                                <small class="tradingerror-message text-danger"></small>
                            </div>
                            <!-- Password Field -->
                            <div class="form-group mb-3">
                                <label for="password">Password <span class="text-danger"> * </span></label>
                                <input type="password" id="password" name="password" class="form-control">
                                <small class="passworderror-message text-danger"></small>
                            </div>
                            <!-- Confirm Password Field -->
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password <span class="text-danger"> * </span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                <small class="conpassworderror-message text-danger"></small>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block" id="submitBtn">Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        @php
                            $url = md5('login');
                        @endphp
                        <p class="mb-0">Already have an account? <a href="{{ route($url) }}" class="text-primary">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(){
            $('#submitBtn').on('click', function(e){
                e.preventDefault();

                var nameValue             = $('#name').val().trim();
                var email                 = $('#email').val().trim();
                var mobile                = $('#mobile').val().trim();
                var tradingCode           = $('#tradingCode').val().trim();
                var password              = $('#password').val().trim();
                var password_confirmation = $('#password_confirmation').val().trim();

                // Check if the trimmed value is empty
                if (nameValue === '') {
                    $('.nameerror-message').html('Name field is empty!');
                    return;
                }

                if (email === '') {
                    $('.emailerror-message').html('Email field is empty!');
                    return;
                }

                if (mobile === '') {
                    $('.mobileerror-message').html('Mobile field is empty!');
                    return;
                }

                if (tradingCode === '') {
                    $('.tradingerror-message').html('Trading Code field is empty!');
                    return;
                }

                if (password === '') {
                    $('.passworderror-message').html('Password field is empty!');
                    return;
                }

                if (password_confirmation === '') {
                    $('.conpassworderror-message').html('Password field is empty!');
                    return;
                }

                if(password != password_confirmation){
                    $('.conpassworderror-message').html('Password doesn"t match!');
                }

                // Add loader to the submit button
                $(this).attr('disabled', true);
                $(this).html('Registering <span class="loader"></span>');

                // Gather form data
                var formData = $('#signUpForm').serialize();

                // AJAX request
                $.ajax({
                    url: $('#signUpForm').attr('action'),
                    method: $('#signUpForm').attr('method'),
                    data: formData,
                    success: function(response) {
                        alert(7654);
                        // Handle success response
                        if(response && response.success == true){
                           var loginRouteName = "{{ md5('login') }}";
                            var baseUrl = "{{ url('') }}";
                            var loginUrl = baseUrl + '/' + loginRouteName;
                            window.location.href = loginUrl;
                        }

                        // Reset the form and button
                        $('#submitBtn').attr('disabled', false);
                        $('#submitBtn').html('Register');
                        $('#signUpForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert('An error occurred. Please try again.');
                        // Reset the button
                        $('#submitBtn').attr('disabled', false);
                        $('#submitBtn').html('Register');
                    }
                });
            });
        });
    </script>
</body>
</html>
