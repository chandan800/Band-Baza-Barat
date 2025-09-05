<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
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
            font-size: 22px;
        }
        .body {
            padding: 25px;
            color: #333333;
        }
        .body h2 {
            font-size: 18px;
            margin-top: 0;
        }
        .body p {
            font-size: 16px;
            line-height: 1.5;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            color: #fff;
            background-color: #8B0000;
        }
        .footer {
            background-color: #f1f1f1;
            color: #555555;
            text-align: center;
            padding: 15px;
            font-size: 14px;
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
            <h1>New Contact Form Submission</h1>
        </div>
        <div class="body">
            <p><strong>Name:</strong> {{ $data['fullName'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
            <p><strong>Message:</strong> {{ $data['message'] }}</p>

            @if(!empty($data['profileId']))
                <p><strong>Profile ID:</strong> {{ $data['profileId'] }}</p>
            @endif

            @if(!empty($data['subject']))
                <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
            @endif

            @if(!empty($data['priority']))
                <p><strong>Priority Level:</strong> <span class="badge">{{ strtoupper($data['priority']) }}</span></p>
            @endif
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} BandBazaBarat. All rights reserved.
        </div>
    </div>
</body>
</html>
