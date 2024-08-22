<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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

        .forgot-password-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .forgot-password-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .forgot-password-form p {
            color: #666;
            margin-bottom: 20px;
        }

        .forgot-password-form .form-group label {
            color: #555;
        }

        .forgot-password-form .form-control {
            border-radius: 20px;
            padding: 10px;
        }

        .forgot-password-form .btn {
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
        }

        .forgot-password-form .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
        }

        .forgot-password-form .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #003f7f);
        }

        .forgot-password-form .text-center a {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password-form .text-center a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-form">
            <h2 class="text-center">Forgot Password</h2>
            <p class="text-center">Enter your email address to reset your password.</p>
            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
