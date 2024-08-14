<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f2f2f2;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 6em;
            margin: 0;
            color: #ff6b6b;
        }
        h2 {
            font-size: 2em;
            margin: 0;
            color: #333;
        }
        p {
            font-size: 1.2em;
            color: #666;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #ff6b6b;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a:hover {
            background: #ff3b3b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Security Alert</h2>
        <p>Sorry, Registration system stop now for security issues..!</p>
        <a href="{{ url('/') }}">Go Back to Homepage</a>
    </div>
</body>
</html>
