<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ANC Securities Ltd.</title>
    <link rel="shortcut icon" href="{{ asset('auth/security.png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
            @if(session('message'))
                <div class="alert alert-success" sid="succesAlert">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
</body>
</html>
