<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Frontline — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;700&family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f0f7ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        .glow-point {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }
        .glow-1 { width: 400px; height: 400px; background: rgba(59, 130, 246, 0.15); top: 20%; left: 30%; }
        .glow-2 { width: 150px; height: 150px; background: rgba(59, 130, 246, 0.3); top: 30%; left: 10%; filter: blur(40px); }
        .glow-3 { width: 250px; height: 250px; background: rgba(59, 130, 246, 0.12); bottom: 10%; right: 15%; }
        .glow-4 { width: 300px; height: 300px; background: #ffffff; top: 10%; right: 10%; opacity: 0.5; }

        .card {
            background: #ffffff;
            border-radius: 32px;
            padding: 20px 40px 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(30, 58, 138, 0.08);
            position: relative;
            margin-top: 40px;
            border: 1px solid rgba(255, 255, 255, 0.9);
            z-index: 10;
        }

        .logo-box {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 220px;
            z-index: 20;
            display: flex;
            justify-content: center;
        }
        .logo-box img {
            width: 100%;
            height: auto;
            display: block;
            filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.12));
            transition: transform 0.4s ease;
        }
        .logo-box:hover img { transform: scale(1.05); }

        .logo-title {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
            line-height: 1.2;
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo-title .main-brand {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(to right, #1e3a8a, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo-title .sub-brand {
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 6px;
            color: #64748b;
            margin-top: 2px;
            margin-right: -6px;
        }

        .welcome {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
        }

        .field { margin-bottom: 15px; }
        .field label {
            display: block;
            text-align: left;
            font-size: 13.5px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }
        .input-wrap input:focus {
            border-color: #184B89;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.08);
        }

        /* حقل فيه خطأ */
        .input-wrap input.is-error {
            border-color: #ef4444;
            background: #fff5f5;
        }

        .icon-side {
            position: absolute;
            left: 14px;
            color: #184B89;
            opacity: 0.8;
            display: flex;
            align-items: center;
        }

        .toggle-pass {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            display: flex;
            align-items: center;
        }

        /* رسالة الخطأ تحت الحقل */
        .error-msg {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .forgot { text-align: right; margin-top: -8px; margin-bottom: 20px; }
        .forgot a { font-size: 12.5px; color: #184B89; text-decoration: none; font-weight: 600; }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #184B89;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Tajawal';
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: 0.3s;
        }
        .btn-login:hover { transform: translateY(-1px); }
        .btn-login:disabled { opacity: 0.7; cursor: not-allowed; }
    </style>
</head>
<body>

    <div class="glow-point glow-1"></div>
    <div class="glow-point glow-2"></div>
    <div class="glow-point glow-3"></div>
    <div class="glow-point glow-4"></div>

    <div class="card">
        <div class="logo-box">
            <img src="{{ asset('reachout/img/logo2.png') }}" alt="Mental Health Logo">
        </div>

        <div class="logo-title">
            <span class="main-brand">Mental Health</span>
            <span class="sub-brand">Frontline</span>
        </div>

        <div class="welcome">Welcome Back!</div>

        {{-- ✅ action يروح للـ LoginController --}}
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="field">
                <label>Email Address</label>
                <div class="input-wrap">
                    <span class="icon-side">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </span>
                    <input
                        type="email"
                        name="email"
                        placeholder="dr.ahmed@mhfrontline.com"
                        value="{{ old('email') }}"
                        class="{{ $errors->has('email') ? 'is-error' : '' }}"
                        required
                    >
                </div>
                {{-- رسالة خطأ الإيميل --}}
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label>Password</label>
                <div class="input-wrap">
                    <span class="icon-side">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        placeholder="••••••••••"
                        class="{{ $errors->has('password') ? 'is-error' : '' }}"
                        required
                    >
                    <button type="button" class="toggle-pass" onclick="togglePassword()">
                        <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                {{-- رسالة خطأ كلمة المرور --}}
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="forgot"><a href="#">Forgot Password?</a></div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>