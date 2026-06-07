@extends('frontend.layouts.main')

@section('title', 'Mental Health Frontline')

@section('content')

    <!-- ══ HERO ══ -->
    <section class="hero-section" id="hero">
        <div class="hero-slides">
            <div class="hero-slide active" style="background-image: url('{{ asset('reachout/img/hero1.jpeg') }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('reachout/img/hero2.jpeg') }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('reachout/img/hero3.jpeg') }}');"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-content-inner">
                <h1 class="hero-title">Psychological First Aid for Children Under Fire</h1>
                <p class="hero-sub">In conflict zones trauma spreads faster than the news.</p>
                <p class="hero-sub">Your support delivers immediate mental health care when it matters most.</p>
                <a href="{{ route('donate.page') }}" class="hero-btn">Donate Now</a>
            </div>
        </div>
        <div class="hero-dots">
            <button class="hero-dot active" data-index="0"></button>
            <button class="hero-dot" data-index="1"></button>
            <button class="hero-dot" data-index="2"></button>
        </div>
    </section>

    <!-- ══ ABOUT ══ -->
    <section class="about-refined" id="about">
        <div class="about-container">
            <h2 class="about-title reveal-left">About us</h2>
            <p class="about-subtitle reveal-left" style="transition-delay: 0.1s;">We are here.. living the reality, understanding the pain, and leading the support.</p>
            <div class="about-body-area">
                <p class="lead-para reveal" style="transition-delay: 0.2s;">We are a team of local mental health professionals living and working in <strong>Gaza</strong>, understanding the reality of war from daily life, not from a distance.</p>
                <div class="crisis-callout reveal" style="transition-delay: 0.3s;">
                    <p>When services collapse, children are left with fear, aggression, and trauma. Families are left without support.</p>
                    <span class="action-badge">We step in immediately.</span>
                </div>
                <p class="footer-para reveal" style="transition-delay: 0.4s;">Through free, confidential consultations via WhatsApp and email, we provide practical, culturally grounded psychological support to reach those no one else can reach.</p>
            </div>
        </div>
    </section>

    <!-- ══ SERVICES ══ -->
    <section class="services-section" id="services">
        <h2 class="services-heading reveal-left">Our Services :</h2>
        <div class="services-container">
            <div class="services-left">
                <div class="service-item reveal-left" style="transition-delay: 0.05s;">
                    <span class="service-num">1.</span>
                    <h3 class="service-title">Step-by-Step Guide</h3>
                    <p class="service-desc">Guide parents step-by-step to manage trauma-related behaviors in children.</p>
                </div>
                <div class="service-item reveal-left" style="transition-delay: 0.15s;">
                    <span class="service-num">2.</span>
                    <h3 class="service-title">Accessible Support</h3>
                    <p class="service-desc">Provide ongoing psychological support through simple, accessible online channels.</p>
                </div>
                <div class="service-item reveal-left" style="transition-delay: 0.25s;">
                    <span class="service-num">3.</span>
                    <h3 class="service-title">Practical Strategies</h3>
                    <p class="service-desc">Offer practical strategies that improve daily functioning at home.</p>
                </div>
                <div class="service-item reveal-left" style="transition-delay: 0.35s;">
                    <span class="service-num">4.</span>
                    <h3 class="service-title">Continuity of Care</h3>
                    <p class="service-desc">Ensure continuity of care through consistent follow-up.</p>
                </div>
            </div>
            <div class="services-right reveal-right">
                <div class="wire-img-box">
                    <div class="slider-track" id="servicesTrack">
                        <img class="s-slide" src="{{ asset('reachout/img/services1.png') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services2.png') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services3.jpg') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services4.png') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services5.png') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services6.png') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services7.jpeg') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services8.jpeg') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services9.jpeg') }}"  alt="">
                        <img class="s-slide" src="{{ asset('reachout/img/services10.jpg') }}" alt="">
                    </div>
                </div>
                <div class="wire-layer wire-h top"></div>
                <div class="wire-layer wire-h bottom"></div>
                <div class="wire-v-fixed"></div>
                <div class="wire-layer wire-c tl"></div>
                <div class="wire-layer wire-c bl"></div>
            </div>
        </div>
    </section>

    <!-- ══ IMPACT STATS ══ -->
    <section class="impact-section" id="impact">
        <div class="impact-header">
            <h2 class="impact-title reveal">The Impact Of Wars In Numbers</h2>
            <p class="impact-sub reveal" style="transition-delay: 0.15s;">Key figures from international organizations and UN bodies on the humanitarian crisis and its effect on children and families.</p>
        </div>
        <div class="impact-grid">
            <div class="impact-card reveal-scale" style="transition-delay: 0s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact1.jpeg') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" lang="en" translate="no" data-target="450000" data-suffix="" data-prefix="+ ">
    + 450,000
</div>
                    <p class="impact-desc">children in Gaza are facing devastating psychological consequences, with the majority experiencing severe distress, including sleep disturbances.</p>
                    <span class="impact-source">UNICEF</span>
                </div>
            </div>
            <div class="impact-card reveal-scale" style="transition-delay: 0.1s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact2.png') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" data-target="100" data-suffix="%">100%</div>
                    <p class="impact-desc">All children in Gaza are now in need of mental health and psychosocial support.</p>
                    <span class="impact-source">United Nations</span>
                </div>
            </div>
            <div class="impact-card reveal-scale" style="transition-delay: 0.2s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact3.jpg') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" data-target="80" data-suffix="%">80%</div>
                    <p class="impact-desc">Save the Children reports that over 80% of children in Gaza show signs of emotional distress and anxiety.</p>
                    <span class="impact-source">UNFPA</span>
                </div>
            </div>
            <div class="impact-card reveal-scale" style="transition-delay: 0.3s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact4.jpg') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" data-target="96" data-suffix="%">96%</div>
                    <p class="impact-desc">of children in Gaza feel their death is imminent due to ongoing trauma.</p>
                    <span class="impact-source">UN Report</span>
                </div>
            </div>
            <div class="impact-card reveal-scale" style="transition-delay: 0.4s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact5.png') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" data-target="80" data-suffix="%">80%</div>
                    <p class="impact-desc">4 in 5 children show signs of severe emotional distress, depression, or anxiety due to ongoing conflict.</p>
                    <span class="impact-source">IMC</span>
                </div>
            </div>
            <div class="impact-card reveal-scale" style="transition-delay: 0.5s;">
                <img class="impact-card-img" src="{{ asset('reachout/img/impact6.png') }}" alt="">
                <div class="impact-card-body">
                    <div class="impact-stat" data-target="1000000" data-suffix="">1 million</div>
                    <p class="impact-desc">Almost every child in Gaza, over 1 million children is in need of mental health and psychosocial support.</p>
                    <span class="impact-source">UNICEF</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ PATH OF HEALING ══ -->
    <section class="healing-section" id="healing">
        <h2 class="healing-title reveal">The Path of Healing</h2>
        <div class="healing-wrapper">
            <img class="healing-img reveal" style="transition-delay: 0.15s;" src="{{ asset('reachout/img/Group 1000006520.png') }}" alt="Crisis images">
            <img class="healing-img reveal" style="transition-delay: 0.3s;" src="{{ asset('reachout/img/path-of-healing.png') }}" alt="The Path of Healing diagram">
        </div>
    </section>

    <!-- ══ GET HELP SECTION ══ -->
    <section class="get-help-section" id="get-help">
        <div class="get-help-container">
            <h2 class="get-help-title reveal-left">Get help</h2>
            <p class="get-help-subtitle reveal-left" style="transition-delay: 0.1s;">To get support, follow these steps</p>
            <div class="steps-wrapper">
                <div class="step-item reveal" style="transition-delay: 0.1s;">
                    <div class="step-header">
                        <i class="fas fa-lock"></i>
                        <h3>Choose Your Secure Gateway.</h3>
                    </div>
                    <p class="step-desc">Select the method that brings you comfort WhatsApp or email to start supporting your child instantly without any complicated registration.</p>
                </div>
                <div class="step-item reveal" style="transition-delay: 0.2s;">
                    <div class="step-header">
                        <i class="fas fa-comment-dots"></i>
                        <h3>Speak Freely and Privately.</h3>
                    </div>
                    <p class="step-desc">Connect with a specialist who understands your reality, in a space that guarantees absolute confidentiality and emotional support for you and your family.</p>
                </div>
                <div class="step-item reveal" style="transition-delay: 0.3s;">
                    <div class="step-header">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Practical Steps Toward Recovery.</h3>
                    </div>
                    <p class="step-desc">You won't leave the conversation alone; you will receive practical techniques to calm your child and manage panic and stress, strengthening your family's resilience.</p>
                </div>
            </div>
            <div class="policy-container reveal" style="transition-delay: 0.2s;">
                <div class="policy-info">
                    <i class="fas fa-file-shield"></i>
                    <p class="policy-text">
                        <strong>Service Usage Policies & Disclaimer</strong>
                        Please take a moment to review our terms. they are designed to protect your privacy and ensure clear, safe communication. You can contact us anytime for support. By reaching out, you confirm your understanding and acceptance of these guidelines.
                    </p>
                </div>
                <a href="policies.pdf" class="btn-download" download title="Download Usage Policies">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
            <div class="get-help-footer reveal" style="transition-delay: 0.3s;">
                <p class="footer-text">Don't hesitate to contact us to protect your child.</p>
                <div class="contact-buttons">
                   <div class="contact-buttons">
                    <a href="#" class="btn-contact btn-whatsapp" 
                    onclick="openPopupWithChannel('whatsapp'); return false;">
                        <i class="fab fa-whatsapp"></i> Whatsapp
                    </a>
                    <a href="#" class="btn-contact btn-email" 
                    onclick="openPopupWithChannel('email'); return false;">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ BRIDGE SECTION ══ -->
    <section class="bridge-section" id="donate">
        <div class="bridge-container">
            <h2 class="bridge-title reveal">From Trauma to Resilience: Your Support is the Bridge</h2>
            <div class="bridge-grid">
                <div class="bridge-card reveal" style="transition-delay: 0.05s;">
                    <img src="{{ asset('reachout/img/bridge1.png') }}" alt="Preventing chronic trauma">
                    <div class="bridge-card-overlay"><p class="bridge-card-text">Preventing chronic<br>trauma</p></div>
                </div>
                <div class="bridge-card reveal" style="transition-delay: 0.15s;">
                    <img src="{{ asset('reachout/img/bridge2.png') }}" alt="Secure digital sanctuary">
                    <div class="bridge-card-overlay"><p class="bridge-card-text">Secure digital<br>sanctuary</p></div>
                </div>
                <div class="bridge-card reveal" style="transition-delay: 0.25s;">
                    <img src="{{ asset('reachout/img/bridge3.jpg') }}" alt="Building cognitive resilience">
                    <div class="bridge-card-overlay"><p class="bridge-card-text">Building cognitive<br>resilience</p></div>
                </div>
            </div>
            <p class="bridge-desc reveal" style="transition-delay: 0.1s;">Every donation ensures the continuity of professional psychological support for children in conflict zones.</p>
            <a href="{{ route('donate.page') }}" class="hero-btn reveal" style="transition-delay: 0.2s;">Donate Now</a>
            <p class="bridge-footer-text reveal" style="transition-delay: 0.3s;">Your generosity is the bridge between trauma and recovery</p>
        </div>
    </section>

    <!-- ══ PARTNERSHIPS SECTION ══ -->
    <section class="partners-section">
        <div class="partners-container">
            <div class="ps-top reveal">
                <h2 class="ps-title">Partnerships & Funding Opportunities</h2>
                <p class="ps-sub">We welcome collaboration with donors, grant officers, and partner organizations who share our commitment.</p>
            </div>
            <div class="ps-body">
    <!-- النص أولاً -->
    <div class="partners-content reveal-right" style="transition-delay: 0.25s;">
        <h2>Let's build something meaningful together.</h2>
        <p>Please use the form to connect with us regarding funding opportunities, partnerships, or joint initiatives.</p>
        <p>Our team will review your inquiry promptly and respond with the relevant information to move forward efficiently.</p>
        <div class="ps-features">
            <div class="ps-feature"><div class="ps-feature-dot"></div><span>Funding & grant collaboration opportunities</span></div>
            <div class="ps-feature"><div class="ps-feature-dot"></div><span>Joint mental health initiatives in conflict zones</span></div>
            <div class="ps-feature"><div class="ps-feature-dot"></div><span>Organizational partnerships & program support</span></div>
        </div>
    </div>
    <!-- الفورم ثانياً -->
    <div class="partners-form-card reveal" style="transition-delay: 0.15s;">
        <div class="partners-form-card reveal" style="transition-delay: 0.15s;">
    <form id="partnerForm">
        <div class="form-row">
            <input type="text" id="p_fname" placeholder="First Name*" required>
            <input type="text" id="p_lname" placeholder="Last Name*" required>
        </div>
        <input type="email" id="p_email" placeholder="Email*" required>
        <input type="tel" id="p_phone" placeholder="Phone Number*">
        <textarea id="p_message" placeholder="Your message..."></textarea>
        <button type="button" class="btn-send" onclick="sendPartnerEmail()">Send Message</button>
    </form>
</div>
    </div>
</div>
        </div>
    </section>

    @include('frontend.popup')
<script>
function openPopupWithChannel(channel) {
    const popup = document.getElementById('welcomePopup');
    if (!popup) return;
    popup.style.display = 'flex';
    setTimeout(function() {
        const btn = channel === 'whatsapp' 
            ? document.getElementById('btnOpenFormWa') 
            : document.getElementById('btnOpenFormEmail');
        if (btn) btn.click();
    }, 100);
}
function sendPartnerEmail() {
    const fname   = document.getElementById('p_fname').value.trim();
    const lname   = document.getElementById('p_lname').value.trim();
    const email   = document.getElementById('p_email').value.trim();
    const phone   = document.getElementById('p_phone').value.trim();
    const message = document.getElementById('p_message').value.trim();

    if (!fname || !email || !message) {
        alert('Please fill in all required fields.');
        return;
    }

    const body = `Name: ${fname} ${lname}\nEmail: ${email}\nPhone: ${phone}\n\nMessage:\n${message}`;
    const url  = `https://mail.google.com/mail/?view=cm&to=info@mentalhealthfrontline.org&su=New+Partnership+Inquiry&body=${encodeURIComponent(body)}`;
    window.open(url, '_blank');
}
</script>
@endsection