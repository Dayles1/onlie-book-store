<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .email-wrapper {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .email-header h1 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        .email-content {
            font-size: 16px;
            line-height: 1.7;
            color: #555;
            text-align: center;
        }

        .email-content p {
            margin: 0 0 20px;
        }

        .btn {
            display: inline-block;
            background-color: #000000; /* Qora rang */
            color: #ffffff; /* Oq yozuv */
            padding: 14px 30px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 20px auto;
            text-align: center;
        }

        .btn:hover {
            background-color: #333333; /* Hover uchun biroz ochiqroq qora */
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 13px;
            color: #999;
        }

        /* Linkni ko‘rinmas qilish uchun */
        .raw-link {
            display: none;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1>Email Verification</h1>
        </div>
        <div class="email-content">
            <p>Hello {{ $user->name }},</p>
            <p>Thank you for registering with us. Please click the button below to verify your email address and complete your registration:</p>
            <a href="{{ $link }}" class="btn">Verify Email</a>
            <p>If you did not register, please ignore this email.</p>
        </div>
        <div class="raw-link">{{ $link }}</div> <!-- Linkni yashirish uchun div -->
        <div class="footer">
            <p>© {{ date('Y') }} OnlieBookStore</p>
        </div>
    </div>
</body>
</html>