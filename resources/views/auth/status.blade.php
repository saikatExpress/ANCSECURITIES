<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('auth/shield.png') }}" type="image/x-icon">
    <title>Update User Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .authErrorMessage {
            color: red;
        }
        .btn-info {
            margin-top: 10px;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
        }
        #loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure loader is on top of other content */
        }

        .loader-container {
            text-align: center;
        }

        .loader {
            border: 8px solid #f3f3f3; /* Light grey background */
            border-top: 8px solid darkgreen; /* Green color for the spinner */
            border-radius: 50%;
            width: 50px; /* Adjust size as needed */
            height: 50px; /* Adjust size as needed */
            animation: spin 1s linear infinite;
            margin-bottom: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="tradingCodeForm" class="form-container">

                    <div id="loader" style="display: none;">
                        <div class="loader-container">
                            <div class="loader"></div>
                            <p style="font-size: 0.8rem; font-weight: 600; color: darkgreen;">Please Wait...</p>
                        </div>
                    </div>


                    <h2 class="text-center">Enter Trading Code</h2>
                    <form id="tradingCodeForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="trading_code">Trading Code:</label>
                            <input type="text" class="form-control" name="trading_code" id="trading_code" placeholder="Enter your trading code" required>
                            <small class="form-text text-success">Enter your trading code to receive an OTP via email.</small>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="submitTradingCode">Submit</button>
                        <p id="authErrorMessage" class="authErrorMessage"></p>
                    </form>
                </div>

                <div id="otpForm" class="form-container" style="display: none;">
                    <h2 class="text-center">Enter OTP</h2>
                    <form id="otpForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="otp">OTP:</label>
                            <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter the OTP sent to your email" required>
                            <small class="form-text text-muted">Check your email for the OTP and enter it here.</small>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="submitOtp">Submit</button>
                        <p id="authErrorMessageOtp" class="authErrorMessage"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#submitTradingCode').on('click', function() {
                var tradingCode = $('#trading_code').val();
                if (!tradingCode) {
                    $('#authErrorMessage').text('Please enter a trading code.');
                    return;
                }

                $.ajax({
                    url: '{{ route("user.sendOtp") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        trading_code: tradingCode
                    },
                    beforeSend: function(){
                        $('#loader').show();
                    },
                    complete: function(){
                        $('#loader').hide();
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#tradingCodeForm').hide();
                            $('#otpForm').show();

                            Swal.fire({
                                icon: 'info',
                                title: 'OTP Sent!',
                                text: 'An OTP has been sent to your registered email. Please check your email and enter the OTP below.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            $('#authErrorMessage').text(response.error);
                        }
                    },
                    error: function(xhr) {
                        $('#authErrorMessage').text('An error occurred. Please try again.');
                    }
                });
            });

            $('#submitOtp').on('click', function() {
                var otp = $('#otp').val();
                if (!otp) {
                    $('#authErrorMessageOtp').text('Please enter the OTP.');
                    return;
                }

                $.ajax({
                    url: '{{ route("user.verifyOtp") }}', // Define a route to verify OTP
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        otp: otp
                    },
                    success: function(response) {
                        if (response && response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'OTP Verified!',
                                text: 'You will be redirected to the login page.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location.href = response.redirect;
                            });
                        } else {
                            $('#authErrorMessageOtp').text(response.error);
                        }
                    },
                    error: function(xhr) {
                        $('#authErrorMessageOtp').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
