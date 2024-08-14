<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            padding: 20px;
            color: #ffffff;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #333333;
            font-size: 20px;
        }
        .content p {
            color: #666666;
            line-height: 1.6;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            color: #888888;
            font-size: 12px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, {{ $name }}!</h1>
        </div>
        <div class="content">
            <p>Thank you for registering with us. Your registration was successful.</p>
            <p>We look forward to providing you with our services.</p>
            <p>Please insert the OTP and verify your account.</p>
            <a href="{{ $verificationUrl }}" class="button">Verify Your Account</a>
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:support@example.com">contact us</a>.</p>
            <p>&copy; {{ date('Y') }} Anc Securities Limited. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
