@php
    use App\Models\Setting;

    $setting = Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ANC Securities Ltd.</title>
    <link rel="shortcut icon" href="{{ asset('auth/security.png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @if ($setting->login_background_image != NULL)
        <style>
            body {
                background-image: url('{{ asset('storage/' . $setting->login_background_image) }}');
                background-size: cover;
                background-position: center;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
        </style>
    @else
        <style>
            body {
                background: #f5f7fa;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
        </style>
    @endif
    <style>
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-form .form-group label {
            color: #555;
        }

        .login-form .form-control {
            border-radius: 20px;
            padding: 10px;
        }

        .login-form .btn {
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
        }

        .login-form .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
        }

        .login-form .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #003f7f);
        }

        .login-form .text-center a {
            color: #007bff;
            text-decoration: none;
        }

        .login-form .text-center a:hover {
            text-decoration: underline;
        }

        .authErrorMessage{
            color: #fff !important;
            background-color: darkred;
            padding: 5px 8px 5px;
            margin: 5px 5px 5px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .authErrorMessage a {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <p id="authErrorMessage"></p>

            <form method="POST" action="{{ route('log.store') }}" id="logForm">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    <strong id="emailerror-message" class="text-danger"></strong>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    <strong id="passworderror-message" class="text-danger"></strong>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="submitBtn">Login</button>
                <div class="text-center mt-3">
                    @php
                        $url = md5('forgot.password');
                    @endphp
                    <a href="{{ route($url) }}">Forgot Password?</a>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <p class="mb-0">Do you haven't an account? <a href="{{ route('sign.up') }}" class="text-primary">Registation</a></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault(); // Disable right-click context menu
        });

        document.addEventListener('keydown', function(e) {
            // Disable F12 (DevTools), Ctrl+Shift+I (DevTools), Ctrl+U (View Source)
            if (e.keyCode === 123 ||
                (e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
                (e.ctrlKey && e.keyCode === 85)) {
                e.preventDefault();
            }
        });
    </script>

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
            $('#logForm').on('submit', function(e){
                e.preventDefault();

                var email    = $('#email').val().trim();
                var password = $('#password').val().trim();
                var userStatusUrl = "{{ route('user.status') }}";

                $('#emailerror-message').html('');
                $('#passworderror-message').html('');

                if (email === '') {
                    $('#emailerror-message').html('Email field is empty!');
                    return;
                }

                if (password === '') {
                    $('#passworderror-message').html('Password field is empty!');
                    return;
                }

                $('#submitBtn').attr('disabled', true);
                $('#submitBtn').html('Login <span class="loader"></span>');

                var formData   = $(this).serialize();
                var csrfToken  = $('input[name="_token"]').val();
                    formData  += '&_token=' + csrfToken;

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response){
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response.success,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location.href = response.redirect;
                            });
                        } else if (response.validationerror) {
                            $('#authErrorMessage').html(response.validationerror).addClass('authErrorMessage');
                        } else {
                            var errorMessage = response.error;
                            var linkHtml = `<a href="${userStatusUrl}" class="btn btn-info">Go Here</a>`;
                            $('#authErrorMessage').html(errorMessage + '<br>' + linkHtml).addClass('authErrorMessage');
                        }

                    },
                    error: function(xhr, status, error){
                        alert('An error occurred. Please try again.');
                        // Reset the button
                        $('#submitBtn').attr('disabled', false);
                        $('#submitBtn').html('Login');
                    }
                });
            });
        });
    </script>
</body>
</html>
