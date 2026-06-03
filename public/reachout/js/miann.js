/* ══ HERO SLIDESHOW ══ */
/* ══ HERO SLIDESHOW ══ */
(function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    
    // 🛡️ شرط الأمان: إذا لم تكن السلايدات موجودة في الصفحة الحالية، توقف فوراً ولا تسبب خطأ
    if (slides.length === 0) return;

    let current  = 0, timer;
    function goTo(index) {
        slides[current].classList.remove('active');
        slides[current].classList.add('leaving');
        dots[current].classList.remove('active');
        const prev = slides[current];
        setTimeout(() => prev.classList.remove('leaving'), 1200);
        current = index;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goTo(parseInt(dot.dataset.index));
            clearInterval(timer);
            startTimer();
        });
    });
    function startTimer() { timer = setInterval(() => goTo((current + 1) % slides.length), 5000); }
    startTimer();
})();

/* ══ SERVICES IMAGE SLIDER ══ */
(function () {
    const track = document.getElementById('servicesTrack');
    if (!track) return;
    const total = track.querySelectorAll('.s-slide').length;
    let current = 0;
    function goTo(index) {
        current = (index + total) % total;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
    }
    setInterval(function () { goTo(current + 1); }, 3000);
})();

/* ══ MOBILE NAV DRAWER ══ */
(function () {
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.getElementById('navLinks');
    const overlay   = document.getElementById('navOverlay');

    if (!hamburger || !navLinks || !overlay) return;

    function openNav() {
        navLinks.classList.add('open');
        hamburger.classList.add('open');
        overlay.classList.add('active');
        document.body.classList.add('nav-open');
    }

    function closeNav() {
        navLinks.classList.remove('open');
        hamburger.classList.remove('open');
        overlay.classList.remove('active');
        document.body.classList.remove('nav-open');
    }

    hamburger.addEventListener('click', () => {
        navLinks.classList.contains('open') ? closeNav() : openNav();
    });

    overlay.addEventListener('click', closeNav);

    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeNav);
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 860) closeNav();
    });
})();

/* ══ SCROLL REVEAL ══ */
(function () {
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale')
        .forEach(function (el) { observer.observe(el); });
})();

/* ══ NUMBER COUNTER ANIMATION ══ */
(function () {
    function animateCounter(el, target, suffix, prefix, duration) {
        let start = 0;
        const steps = duration / 16;
        const increment = target / steps;
        const timer = setInterval(function () {
            start += increment;
            if (start >= target) {
                start = target;
                clearInterval(timer);
            }
            let display;
            if (target >= 1000000) {
                display = (start / 1000000).toFixed(1) + ' million';
            } else if (target >= 1000) {
                display = prefix + Math.round(start).toLocaleString('en-US');
            } else {
                display = prefix + Math.round(start) + suffix;
            }
            el.textContent = display;
        }, 16);
    }

    const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            counterObserver.unobserve(el);
            const target = parseInt(el.dataset.target);
            const suffix = el.dataset.suffix || '';
            const prefix = el.dataset.prefix || '';
            animateCounter(el, target, suffix, prefix, 1600);
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.impact-stat[data-target]')
        .forEach(function (el) { counterObserver.observe(el); });
})();

/* ══ ACTIVE NAV ══ */
(function () {
    const path     = window.location.pathname;
    const navItems = document.querySelectorAll('.nav-links li a');

    if (path.includes('news') || path.includes('policies') || path.includes('donate')) return;

    if (!document.getElementById('about')) return;

    const map = {
        'hero':     navItems[0],
        'about':    navItems[1],
        'get-help': navItems[2],
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const id = entry.target.id;
            if (!map[id]) return;
            navItems.forEach(a => a.classList.remove('active'));
            map[id].classList.add('active');
        });
    }, { rootMargin: '-40% 0px -55% 0px' });

    Object.keys(map).forEach(id => {
        const el = document.getElementById(id);
        if (el) observer.observe(el);
    });

    navItems[0]?.classList.add('active');
})();