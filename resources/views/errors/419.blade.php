<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #002b5c; --text-gray: #64748b; --bg-light: #f8fafc; }
        body { margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: var(--bg-light); font-family: 'Poppins', sans-serif; color: var(--primary-blue); }
        .container { text-align: center; padding: 20px; max-width: 600px; }
        .logo { max-width: 140px; margin-bottom: 40px; }
        .error-code { font-size: 150px; font-weight: 900; margin: 0; line-height: 1; letter-spacing: -5px; color: var(--primary-blue); }
        .divider-container { display: flex; align-items: center; justify-content: center; margin: 30px 0; }
        .line { height: 2px; background: #e2e8f0; flex-grow: 1; }
        .dot { width: 8px; height: 8px; background: orange; border-radius: 50%; margin: 0 15px; animation: pulse 2s infinite; }
        h2 { font-size: 28px; font-weight: 700; margin-bottom: 15px; }
        p { color: var(--text-gray); font-size: 16px; line-height: 1.6; margin-bottom: 40px; }
        .btn-home { display: inline-block; background-color: var(--primary-blue); color: #fff; padding: 16px 45px; border-radius: 12px; text-decoration: none; font-weight: 600; }
        @keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Logo" class="logo">
        <div class="error-code">419</div>
        <div class="divider-container">
            <div class="line"></div>
            <div class="dot"></div>
            <div class="line"></div>
        </div>
        <h2>Access Denied</h2>
        <p>Sorry, you don't have the necessary permissions to access this page. If you believe this is an error, please contact the administrator.</p>
        <a href="{{ url('/') }}" class="btn-home">Go back Home</a>
    </div>
</body>
</html>