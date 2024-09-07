<!DOCTYPE html>
<html lang="en">
    <title>Verify User</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .email-header {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .email-body {
            font-size: 16px;
            color: #555555;
            margin-bottom: 20px;
        }
        .email-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color:rgba(108, 233, 25, 0.7);
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .email-button:hover {
            background-color: rgba(255, 181, 36, 0.7);
        }
        .email-footer {
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Verify Your Email Address
        </div>
        <div class="email-body">
            Hi {{ $user }},
            <br><br>
            Thank you for registering with us! To complete your registration, please verify your email address by clicking the button below.
            <br><br>
            
            <a href="{{ route('user.show', ['token' => $token,'task' => $task]) }}" class="email-button">Verify Email Address</a>
            <br><br>
            If you did not create an account, no further action is required.
        </div>
        <div class="email-footer">
            Thanks,<br>
            {{ config('app.name') }}
        </div>
    </div>
</body>
</html>
