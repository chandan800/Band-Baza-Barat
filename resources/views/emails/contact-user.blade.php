<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        a{
        	color: #fff !important;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #8B0000;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .body {
            padding: 25px;
            color: #333333;
        }
        .body h2 {
            font-size: 20px;
            margin-top: 0;
        }
        .body p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            background-color: #f1f1f1;
            color: #555555;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            margin: 20px 0;
            background-color: #8B0000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .container {
                margin: 15px;
            }
            .body p {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Contacting Us!</h1>
        </div>
        <div class="body">
            <h2>Hi {{ $data['fullName'] }},</h2>
            <p>We have successfully received your message. Our team will review your query and respond within 24 hours.</p>
            <p>If you have any urgent questions, feel free to reach out to our support team directly.</p>
            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} BandBazaBarat. All rights reserved.
        </div>
    </div>
</body>
</html>
