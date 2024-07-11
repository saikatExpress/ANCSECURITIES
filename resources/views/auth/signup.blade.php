<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | ANC Securities Ltd.</title>
    <link rel="shortcut icon" href="{{ asset('auth/customer-service.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: url(https://as1.ftcdn.net/v2/jpg/08/65/07/42/1000_F_865074249_9YQovnbaHiIJ7Sbj2EpKR1As2YDpsX4B.jpg) no-repeat center center fixed;
            background-size: cover;
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
         /* New styles for the instruction list */
        .instructions {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .instructions ul {
            list-style: none;
            padding: 0;
        }
        .instructions ul li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .instructions ul li:last-child {
            border-bottom: none;
        }
        .instructions ul li::before {
            content: '✔';
            color: #007bff;
            margin-right: 10px;
            font-size: 16px;
        }
        #loadingIndicator {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
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
                        <h3 id="modalTitle" class="mb-0">Register</h3>
                    </div>
                    <div id="reg_form" class="card-body">
                        <form method="POST" action="{{ route('regisation.store') }}" id="signUpform">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="mobile">
                                    Trading Code
                                    <span class="text-danger"> * </span>
                                    <strong style="display: none;" id="avaiable" class="text-success fw-bold ml-3"><i class="fas fa-solid fa-check"></i> Avaiable</strong>
                                    <strong style="display: none;" id="notavaiable" class="text-danger fw-bold ml-3"><i class="fas fa-solid fa-circle-exclamation"></i> Not found</strong>
                                </label>
                                <input type="text" id="tradingCode" name="trading_code" class="form-control" placeholder="Enter your trading code...">
                                <small class="tradingerror-message text-danger"></small>
                                @error('trading_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div id="loadingIndicator" style="display: none;">
                                Please wait...
                            </div>


                            <div class="instructions mt-4" style="display: none;">
                                <ul>
                                    <li>আপনার BO একাউন্টের ইমেইল দিয়ে একাউন্ট ওপেন করুন।</li>
                                    <li>আপনার BO একাউন্টের নাম ব্যাবহার করুন</li>
                                    <li>ছয় ডিজিটের বেশি সংখ্যা দিয়ে পাসওর্য়াড লিখুন</li>
                                    <li>আপনার BO একাউন্টের মেইলে OTP কোড যাবে,উক্ত কোড দিয়ে রেজিস্টেশন সম্পন্ন করুন।</li>
                                    <li>রেজিস্টেশনজনিত সমস্যার জন্য ০১৭১৩৫২৭১২ - এই নাম্বারে যোগাযোগ করুন।</li>
                                </ul>
                            </div>

                            <div id="register_form" style="display: none;">
                                <!-- Name Field -->
                                <div class="form-group mb-3">
                                    <label for="name">Name <span class="text-danger"> * </span></label>
                                    <input type="text" id="name" name="name" class="form-control">
                                    <small class="nameerror-message text-danger"></small>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Email Field -->
                                <div class="form-group mb-3">
                                    <label for="email">Email <span class="text-danger"> * </span></label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    <small class="emailerror-message text-danger"></small>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Mobile Field -->
                                <div class="form-group mb-3">
                                    <label for="mobile">Mobile Number <span class="text-danger"> * </span></label>
                                    <input type="tel" id="mobile" name="mobile" class="form-control">
                                    <small class="mobileerror-message text-danger"></small>
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="form-group mb-3">
                                    <label for="password">Password <span class="text-danger"> * </span></label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <small class="passworderror-message text-danger"></small>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Confirm Password Field -->
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger"> * </span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                    <small class="conpassworderror-message text-danger"></small>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                    </div>
                    <div id="otp_form" class="card-body" style="display: none;">
                        <form method="POST" action="{{ route('otp.store') }}" id="otpForm">
                            @csrf
                                <input type="hidden" name="otpEmail" id="otpEmail">
                                <!-- Confirm Password Field -->
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">
                                        Your Otp <span class="text-danger"> * </span>
                                        <strong class="text-success fw-bold" id="otpSuucessMsg"></strong>
                                        <strong class="text-danger fw-bold" id="otpInvalidMsg"></strong>
                                    </label>
                                    <input type="text" id="otp_confirmation" name="otp_confirmation" class="form-control">
                                    <small class="otperror-message text-danger"></small>
                                    @error('otp_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary btn-block">Confirm Otp</button>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#signUpform').on('submit', function(e) {
                e.preventDefault();

                $('#loadingIndicator').show();

                var nameValue             = $('#name').val().trim();
                var email                 = $('#email').val().trim();
                var mobile                = $('#mobile').val().trim();
                var tradingCode           = $('#tradingCode').val().trim();
                var password              = $('#password').val().trim();
                var password_confirmation = $('#password_confirmation').val().trim();

                // Clear previous error messages
                $('.nameerror-message').html('');
                $('.emailerror-message').html('');
                $('.mobileerror-message').html('');
                $('.tradingerror-message').html('');
                $('.passworderror-message').html('');
                $('.conpassworderror-message').html('');

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
                    $('.conpassworderror-message').html('Confirm Password field is empty!');
                    return;
                }

                if(password !== password_confirmation){
                    $('.conpassworderror-message').html('Password doesn\'t match!');
                    return;
                }

                // Disable the button and show loading text
                $('#submitBtn').attr('disabled', true);
                $('#submitBtn').html('Registering <span class="loader"></span>');

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');
                var csrfToken = $('input[name="_token"]').val();

                // Append CSRF token to the form data
                formData += '&_token=' + csrfToken;

                // AJAX request
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,

                    success: function(response) {
                        $('#loadingIndicator').hide();
                        if(response && response.error == false){
                            $('.tradingerror-message').html(response.message);
                            $('#register_form').hide();
                            return false;
                        }

                        // Handle success response
                        if(response && response.success === true){
                            // var loginRouteName = "{{ md5('login') }}";
                            // var baseUrl = "{{ url('') }}";
                            // var loginUrl = baseUrl + '/' + loginRouteName;
                            // window.location.href = loginUrl;
                            $('#reg_form').hide();
                            $('#otp_form').show();
                            $('#modalTitle').html('Otp Form');
                            $('#otpEmail').val(email);
                        }

                        // Reset the form and button
                        $('#submitBtn').attr('disabled', false);
                        $('#submitBtn').html('Register');
                        $('#signUpform')[0].reset();
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

    <script>
        $(document).ready(function() {
            $('#otpForm').on('submit', function(e) {
                e.preventDefault();

                var otp_confirmation = $('#otp_confirmation').val().trim();

                // Clear previous error messages
                $('.otperror-message').html('');

                // Check if the trimmed value is empty
                if (otp_confirmation === '') {
                    $('.otperror-message').html('Code field is empty!');
                    return;
                }

                var formData = $(this).serialize();
                var actionUrl = $(this).attr('action');
                var csrfToken = $('input[name="_token"]').val();

                // Append CSRF token to the form data
                formData += '&_token=' + csrfToken;

                // AJAX request
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,

                    success: function(response) {
                        // Handle success response
                        if(response && response.success === true){
                            var loginRouteName = "{{ md5('login') }}";
                            var baseUrl = "{{ url('') }}";
                            var loginUrl = baseUrl + '/' + loginRouteName;
                            window.location.href = loginUrl;
                        }else{
                            alert(response.success.message);
                        }

                        $('#otpForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                $('.otperror-message').html(errors.join('<br>'));
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#otp_confirmation').on('input', function(){
                const email = $('#otpEmail').val();
                const otp = $('#otp_confirmation').val();

                $.ajax({
                    url: '/otp/check',
                    method: 'GET',
                    data: {
                        email: email,
                        otp: otp
                    },
                    success: function(response) {
                        if(response && response.valid == true){
                            $('#otpSuucessMsg').html('Otp Matched..!');
                            $('#otpInvalidMsg').hide();
                        }

                        if(response && response.valid == false){
                            $('#otpInvalidMsg').html('Otp not Matched..!');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error:', error);
                        // You can show an error message or handle the error as needed
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tradingCode').on('input', function() {
                var id = $(this).val();

                // Hide all elements initially
                $('#avaiable, .instructions, #register_form, #notavaiable').hide();

                if (id == '') return; // Exit if tradingCode is empty

                $.ajax({
                    url: '/get/trade/code/' + id,
                    method: 'GET',
                    success: function(response) {
                        if (response && response.success) {
                            $('#avaiable, .instructions, #register_form').show();
                            $('#notavaiable').hide();

                        } else {
                            $('#notavaiable').show();
                            $('#name, #email, #mobile').val('');
                        }
                    },
                    error: function(error) {
                        console.error('An error occurred:', error);
                    }
                });
            });

            $('#name').on('input', function() {
                var name = $('#name').val().trim();
                var tradingCode = $('#tradingCode').val().trim();

                $.ajax({
                    url: '/get/name/check',
                    method: 'GET',
                    data: {
                        name: name,
                        tradingCode: tradingCode
                    },
                    success: function(response){
                        if(response && response.success === true){
                            $('.nameerror-message')
                                .removeClass('text-danger')
                                .addClass('text-success')
                                .html('Name matched');
                        } else if(response && response.error === false){
                            $('.nameerror-message')
                                .removeClass('text-success')
                                .addClass('text-danger')
                                .html('Name not matched');
                        }
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            $('#email').on('input', function() {
                var email = $('#email').val().trim();
                var tradingCode = $('#tradingCode').val().trim();

                $.ajax({
                    url: '/get/email/check',
                    method: 'GET',
                    data: {
                        email: email,
                        tradingCode: tradingCode
                    },
                    success: function(response){
                        if(response && response.success === true){
                            $('.emailerror-message')
                                .removeClass('text-danger')
                                .addClass('text-success')
                                .html('Email matched');
                        } else if(response && response.error === false){
                            $('.emailerror-message')
                                .removeClass('text-success')
                                .addClass('text-danger')
                                .html('Email not matched');
                        }
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            $('#mobile').on('input', function() {
                var mobile = $('#mobile').val().trim();
                var tradingCode = $('#tradingCode').val().trim();

                $.ajax({
                    url: '/get/mobile/check',
                    method: 'GET',
                    data: {
                        mobile: mobile,
                        tradingCode: tradingCode
                    },
                    success: function(response){
                        if(response && response.success === true){
                            $('.mobileerror-message')
                                .removeClass('text-danger')
                                .addClass('text-success')
                                .html('Mobile number matched');
                        } else if(response && response.error === false){
                            $('.mobileerror-message')
                                .removeClass('text-success')
                                .addClass('text-danger')
                                .html('Mobile number not matched');
                        }
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

</body>
</html>
