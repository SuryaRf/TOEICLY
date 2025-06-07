<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message from TOEICLY</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #5b21b6;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
        .message-box {
            background: #f9fafb;
            padding: 20px;
            border-left: 4px solid #7c3aed;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $username }}!</h1>
        <p>You have received a new message from the TOEICLY Admin.</p>
        <div class="message-box">
            <p>{{ $messageContent }}</p>
        </div>
        <p>If an attachment is included, you can find it with this email.</p>
        <div class="footer">
            <p>Thank you for using TOEICLY!</p>
            <p>&copy; {{ date('Y') }} TOEICLY. All rights reserved.</p>
        </div>
    </div>
</body>
</html>