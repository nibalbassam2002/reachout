<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Mental Health Frontline')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta property="og:title" content="Mental Health Frontline" />
    
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="You deserve to be heard. You don't have to go through this alone." />
    <meta property="og:image" content="{{ asset('reachout/img/logo3.png') }}" />
<meta property="og:description" content="You deserve to be heard. You don't have to go through this alone." />

<meta property="og:image" content="{{ secure_asset('reachout/img/logo3.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Inter:wght@400;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('reachout/css/styleee.css') }}">
    @yield('styles')
</head>
<body>
<div class="nav-overlay" id="navOverlay"></div>
    <header class="main-header">
        <nav class="navbar">
            <a href="{{ url('/') }}" class="nav-logo">
                <img src="{{ asset('reachout/img/logo3.png') }}" alt="Mental Health Frontline">
            </a>
            <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
            <ul class="nav-links" id="navLinks">
                <div class="nav-drawer-logo hide-on-desktop">
                        <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Logo">
                        <span>Mental Health<br>Frontline</span>
                    </div>
                <li><a href="{{ route('home') }}" class="{{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
    <i class="fas fa-house"></i> Home
</a></li>

<li><a href="{{ route('home') }}#about">
    <i class="fas fa-circle-info"></i> About Us
</a></li>

<li><a href="{{ route('home') }}#get-help">
    <i class="fas fa-phone"></i> Contact Us
</a></li>

<li><a href="{{ route('news') }}" class="{{ request()->routeIs('news') ? 'active' : '' }}">
    <i class="fas fa-newspaper"></i> News
</a></li>

<li><a href="{{ route('policies') }}" class="{{ request()->routeIs('policies') ? 'active' : '' }}">
    <i class="fas fa-scale-balanced"></i> Policies
</a></li>

<li><a href="{{ route('donate.page') }}" class="donate-btn-nav">
    <i class="fas fa-hand-holding-heart"></i> Donate
</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <!-- ══ FOOTER ══ -->
    <footer class="main-footer @yield('footer-class')">
        <div class="footer-wire"></div>
        <img class="footer-flag" src="{{ asset('reachout/img/pal-flag-wavy.png') }}" alt="Palestine Flag">
        <div class="footer-inner">
            <div class="footer-palestine-badge">
                <img src="{{ asset('reachout/img/pal-text.png') }}" alt="Palestine">
            </div>
            <h2 class="footer-heading">Empowering resilience and<br>healing hearts amidst the crisis</h2>
            <ul class="footer-nav-links">
                <li><a href="#">Hope</a></li>
                <li><a href="#">Healing</a></li>
                <li><a href="#">Empathy</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
            <div class="footer-socials">
                <a href="https://wa.me/972568200088" target="_blank" class="footer-social-btn wa"><i class="fab fa-whatsapp"></i></a>
                
                <a href="https://www.instagram.com/mental_health_frontline?igsh=djBpaHNkY2E3Nnp6" target="_blank" class="footer-social-btn ig"><i class="fab fa-instagram"></i></a>
                
                <a href="mailto:info@mentalhealthfrontline.org" class="footer-social-btn em"><i class="fas fa-envelope"></i></a>
                
                <a href="https://www.facebook.com/share/1M1ZfM3BjV/" target="_blank" class="footer-social-btn fb"><i class="fab fa-facebook-f"></i></a>
                <a href="https://x.com/MHF_Frontline" target="_blank" class="footer-social-btn tw">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
        <img class="footer-kite-kids" src="{{ asset('reachout/img/kite-kids.png') }}" alt="Kite Kids">
    </footer>

    <script src="{{ asset('reachout/js/miann.js') }}" defer></script>
    @yield('scripts')

</body>
</html>
