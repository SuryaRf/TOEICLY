<!-- filepath: d:\laragon\www\TOEICLY\resources\views\emails\user_message.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message from TOEICLY</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&display=swap');
        body {
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            color: #22223b;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
        }
        h1 {
            color: #4c1d95;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 20px;
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        p {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.95rem;
            color: #7c3aed;
            text-align: center;
        }
        .message-box {
            background: #f3e8ff;
            padding: 20px;
            border-left: 4px solid #7c3aed;
            border-radius: 0.5rem;
            margin-bottom: 20px;
            color: #4c1d95;
            font-weight: 600;
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