<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            font-size: 0.9em;
            color: #555;
        }
        a.button {
            display: inline-block;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Application!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $first_name }},</p>
            <p>Thank you for registering with us. Please click the link below to verify your email address and activate your account:</p>
            <p>
                <a href="{{ $verificationUrl }}" class="button">Verify Email</a>
            </p>
            <p>If you did not create an account, no further action is required.</p>
            <p>Best regards,<br>The Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Our Application. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
