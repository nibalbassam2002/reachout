<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practitioner Portal | Mental Health Frontline</title>
    <link rel="icon" type="image/png" href="{{ asset('reachout/img/logogrope.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #cee3f8; }
        .bg-navy { background-color: #154e86; }
        .text-navy { color: #0F3963; }
        .btn-action { background-color: #1A63AD; transition: 0.3s; }
        .btn-action:hover { background-color: #0F3963; transform: translateY(-1px); }

        .card-animate {
            animation: cardEntrance 0.85s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(40px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .slide-left { animation: slideLeft 0.85s cubic-bezier(0.16,1,0.3,1) 0.1s both; }
        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-25px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .slide-right { animation: slideRight 0.85s cubic-bezier(0.16,1,0.3,1) 0.15s both; }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(25px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .fade-down-1 { animation: fadeDown 0.6s ease 0.40s both; }
        .fade-down-2 { animation: fadeDown 0.6s ease 0.55s both; }
        .fade-down-3 { animation: fadeDown 0.6s ease 0.70s both; }
        .fade-down-4 { animation: fadeDown 0.6s ease 0.85s both; }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up-1 { animation: fadeUp 0.5s ease 0.50s both; }
        .fade-up-2 { animation: fadeUp 0.5s ease 0.60s both; }
        .fade-up-3 { animation: fadeUp 0.5s ease 0.70s both; }
        .fade-up-4 { animation: fadeUp 0.5s ease 0.80s both; }
        .fade-up-5 { animation: fadeUp 0.5s ease 0.90s both; }
        .fade-up-6 { animation: fadeUp 0.5s ease 1.00s both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .deco-circle {
            position: absolute; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.07);
        }

        .status-dot {
            display: inline-block;
            width: 7px; height: 7px;
            border-radius: 50%; background: #2ecc71;
            vertical-align: middle;
            animation: blink 2s ease infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.2; }
        }

        .progress-bar {
            height: 2px; background: #e2eaf3;
            border-radius: 2px; overflow: hidden;
            margin-bottom: 1.25rem;
        }
        .progress-fill {
            height: 100%; width: 0%;
            background: #1A63AD; border-radius: 2px;
            transition: width 0.4s ease;
        }

        .field-input:focus {
            box-shadow: 0 0 0 3px rgba(26,99,173,0.12);
        }

        .btn-action { position: relative; overflow: hidden; }
        .btn-action::before {
            content: '';
            position: absolute; top: 50%; left: 50%;
            width: 0; height: 0;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease;
        }
        .btn-action:hover::before { width: 500px; height: 500px; }

        /* الجانب الأزرق */
        .left-panel {
            background-color: #154e86;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px 26px;
            position: relative;
            overflow: hidden;
        }

        .logo-circle {
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            border: 1.5px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .panel-divider {
            border: none;
            border-top: 0.5px solid rgba(255,255,255,0.12);
            margin: 28px 0;
        }

        .quote-block {
            border-left: 3px solid #e74c3c;
            padding-left: 14px;
        }

        .security-block {
            background: rgba(255,255,255,0.06);
            border: 0.5px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            padding: 16px 18px;
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-top: 24px;
        }
        @keyframes custom-pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }
    70% {
        transform: scale(1.05);
        box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
}

.real-pulse {
    animation: custom-pulse 2s infinite;
}
    </style>
</head>
<body class="min-h-screen flex items-center justify-center md:p-4">

    <div class="max-w-4xl w-full md:bg-white md:rounded-3xl md:shadow-2xl overflow-hidden flex flex-col md:flex-row card-animate min-h-screen md:min-h-0">

        <!-- ===== الجانب الأزرق ===== -->
        <div class="hidden md:flex md:w-1/2 left-panel text-white slide-left">

            <!-- دوائر زخرفية -->
            <div class="deco-circle" style="width:220px;height:220px;bottom:-70px;left:-70px;"></div>
            <div class="deco-circle" style="width:130px;height:130px;top:-35px;right:-35px;"></div>

            <!-- المحتوى الرئيسي -->
            <div class="relative z-10 flex flex-col items-center justify-center h-full">

                <!-- اللوقو + الاسم -->
                <div class="fade-down-1" style="display:flex; align-items:center; gap:14px; padding-bottom:28px; border-bottom:0.5px solid rgba(255,255,255,0.12); margin-bottom:28px;">
                    <div class="logo-circle">
                        <div class="logo-circle real-pulse">
                        <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Logo" style="width:200px; height:200px; object-fit:contain;">
                   </div>
                    </div>
  
                </div>

                      <div class="text-center">
        <h1 class="text-2xl font-bold tracking-tight text-white mb-2">Mental Health Frontline</h1>
        <p class="text-lg text-white/70 font-light ">The Expert’s Hub for Mental Health Frontliners</p>
    </div>
            </div>

            <!-- شريط الحالة السفلي -->
        <div class="relative z-10 fade-down-4 flex items-center justify-center gap-2 mt-auto pb-4">
            <span class="status-dot"></span>
            <span style="font-size:10px; color:rgba(255,255,255,0.35); letter-spacing:2px; text-transform:uppercase;">Authorized Practitioner Access Only</span>
        </div>

        </div>

        <!-- ===== الجانب الأيمن: الفورم ===== -->
        <div class="w-full md:w-1/2 p-6 pt-10 md:p-12 slide-right flex flex-col justify-center min-h-screen md:min-h-0">
            <div class="mb-8 fade-up-1">
                <h2 class="text-2xl font-bold">Welcome Back !</h2>
                <p class="text-gray-500 text-sm mt-1">Please enter your credentials to access the dashboard.</p>
            </div>

            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div class="fade-up-2">
                    <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Professional Email</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="doctor@mhfrontline.com"
                           oninput="updateProgress()"
                           class="field-input w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} focus:outline-none focus:border-navy transition-all" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="fade-up-3">
                    <div class="flex justify-between mb-2">
                        <label class="block text-xs font-bold text-gray-800 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs text-navy font-bold hover:underline">Forgot?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="passwordInput"
                               placeholder="••••••••••"
                               oninput="updateProgress()"
                               class="field-input w-full px-4 py-3 rounded-xl border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} focus:outline-none focus:border-navy transition-all" required>
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 hover:text-navy">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center fade-up-4">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded text-navy focus:ring-navy border-gray-300">
                    <label for="remember" class="ml-2 text-sm text-gray-800">Keep me logged in</label>
                </div>

                <div class="fade-up-5">
                    <button type="submit" class="w-full btn-action text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-sm">
                        Secure Login
                    </button>
                </div>
            </form>

            <div class="mt-10 pt-6 border-t border-gray-50 fade-up-6">
                <div class="flex items-center justify-center gap-2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="text-[10px] uppercase tracking-tighter">End-to-End Encrypted System</span>
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        function updateProgress() {
            const email = document.querySelector('input[name="email"]').value;
            const pass  = document.getElementById('passwordInput').value;
            let pct = 0;
            if (email.length > 3) pct += 50;
            if (pass.length  > 4) pct += 50;
            document.getElementById('progressFill').style.width = pct + '%';
        }
    </script>
</body>
</html>