/* ══ HERO SLIDESHOW ══ */
(function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
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
    const total = track.querySelectorAll('.s-slide').length;
    let current = 0;
    function goTo(index) {
        current = (index + total) % total;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
    }
    setInterval(function () { goTo(current + 1); }, 3000);
})();

/* ══ HAMBURGER ══ */
document.getElementById('hamburger').addEventListener('click', function () {
    document.getElementById('navLinks').classList.toggle('open');
});

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
// ══ Scroll-based Active Nav ══
const contactLink = document.querySelectorAll('.nav-links a')[2];

function updateActiveNav() {
    const scrollY = window.scrollY + 100;

    const aboutSection   = document.getElementById('about');
    const contactSection = document.getElementById('get-help');

    const aboutStart    = aboutSection?.offsetTop ?? 0;
    const contactBegin  = contactSection?.offsetTop ?? 999999;

    document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));

    if (scrollY >= contactBegin) {
        contactLink?.classList.add('active');
    } else if (scrollY >= aboutStart) {
        document.querySelector('.nav-links li:nth-child(2) a')?.classList.add('active');
    } else {
    document.querySelector('.nav-links li:first-child a')?.classList.add('active');
}
}

window.addEventListener('scroll', updateActiveNav);
updateActiveNav();