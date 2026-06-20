<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <!-- خط Poppins احترافي -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #002b5c; /* نفس لون شعارك */
            --accent-red: #c0392b;   /* اللون الأحمر من موقعك */
            --text-gray: #64748b;
            --bg-light: #f8fafc;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: var(--bg-light);
            font-family: 'Poppins', sans-serif;
            color: var(--primary-blue);
        }

        .container {
            text-align: center;
            padding: 20px;
            max-width: 600px;
        }

        /* اللوجو */
        .logo {
            max-width: 140px;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease-out;
        }

        /* رقم 404 - نظيف وعصري */
        .error-code {
            font-size: 150px;
            font-weight: 900;
            margin: 0;
            line-height: 1;
            letter-spacing: -5px;
            color: var(--primary-blue);
            position: relative;
            display: inline-block;
            animation: scaleIn 0.5s ease-out;
        }

        /* خط الـ Wire بشكل أنيق */
        .divider-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px 0;
        }

        .line {
            height: 2px;
            background: #e2e8f0;
            flex-grow: 1;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: var(--primary-blue);
            border-radius: 50%;
            margin: 0 15px;
            box-shadow: 0 0 10px rgba(0, 43, 92, 0.3);
            animation: pulse 2s infinite;
        }

        /* النصوص */
        h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        p {
            color: var(--text-gray);
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* الزر */
        .btn-home {
            display: inline-block;
            background-color: var(--primary-blue);
            color: #fff;
            padding: 16px 45px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 43, 92, 0.15);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 43, 92, 0.25);
            background-color: #001f42;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 480px) {
            .error-code { font-size: 100px; }
            h2 { font-size: 22px; }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- اللوجو الخاص بك -->
        <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Mental Health Frontline" class="logo">
        
        <!-- رقم الخطأ -->
        <div class="error-code">404</div>

        <!-- فاصل عصري -->
        <div class="divider-container">
            <div class="line"></div>
            <div class="dot"></div>
            <div class="line"></div>
        </div>

        <!-- الرسالة -->
        <h2>Page Not Found</h2>
        <p>
            The link you followed might be broken, or the page may have been removed.<br>
            Don't worry, we're here to help you get back.
        </p>

        <!-- زر العودة -->
        <a href="{{ url('/') }}" class="btn-home">Go back Home</a>
    </div>

</body>
</html>