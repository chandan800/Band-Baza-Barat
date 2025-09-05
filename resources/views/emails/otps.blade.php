<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: #ffffff;
            text-align: center;
            padding: 25px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        .content {
            padding: 30px 25px;
            text-align: center;
            color: #333333;
        }
        .otp {
            display: inline-block;
            background: #f1f5f9;
            color: #111827;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .note {
            font-size: 14px;
            color: #6b7280;
            margin-top: 15px;
        }
        .footer {
            background: #f9fafb;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 Secure Login OTP</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello,</p>
            <p>Use the following One-Time Password (OTP) to complete your login:</p>

            <div class="otp">{{ $otp }}</div>

            <p class="note">This OTP is valid for 5 minutes. Please do not share it with anyone.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} YourApp. All rights reserved.
        </div>
    </div>
</body>
</html>
