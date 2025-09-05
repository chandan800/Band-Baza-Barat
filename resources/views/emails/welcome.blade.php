<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome to BandBazaBarat</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .header {
      background: #e63946;
      color: #ffffff;
      padding: 20px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    .content {
      padding: 30px;
      text-align: left;
      color: #333333;
    }
    .content h2 {
      color: #e63946;
      font-size: 20px;
    }
    .button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 25px;
      background: #e63946;
      color: #ffffff !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .footer {
      background: #f4f4f4;
      text-align: center;
      font-size: 12px;
      color: #777777;
      padding: 15px;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <!-- Header -->
    <div class="header">
      <h1>Welcome to BandBazaBarat 🎉</h1>
    </div>

    <!-- Content -->
    <div class="content">
      <h2>Hello {{ $user->first_name }},</h2>
      <p>
        We’re thrilled to have you join <strong>BandBazaBarat</strong>!  
        Your journey to finding the perfect connections starts now.
      </p>
      <p>
        Explore your profile, discover matches, and start connecting today.  
      </p>
      <a href="{{ url('/dashboard') }}" class="button">Go to Dashboard</a>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>&copy; {{ date('Y') }} BandBazaBarat. All rights reserved.</p>
      <p>If you didn’t sign up for this account, please ignore this email.</p>
    </div>
  </div>
</body>
</html>
