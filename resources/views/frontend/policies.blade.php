@extends('frontend.layouts.main')

@section('title', 'Policies - Mental Health Frontline')

@section('content')
    <!-- ══ HERO SECTION ══ -->
<section class="policy-hero-detailed">

    <!-- مستندات يسار -->
    <div class="ph-doc ph-doc-1"></div>
    <div class="ph-doc ph-doc-2"></div>
    <div class="ph-doc ph-doc-3"></div>

    <!-- مستندات يمين -->
    <div class="ph-doc ph-doc-4"></div>
    <div class="ph-doc ph-doc-5"></div>
    <div class="ph-doc ph-doc-6"></div>

    <!-- موجة سفلية -->
    <svg class="ph-wave-bottom" viewBox="0 0 1440 70" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height:70px;">
        <path d="M0,35 C300,70 600,0 900,40 C1100,65 1300,20 1440,35 L1440,70 L0,70 Z" fill="rgba(0,0,0,0.12)"/>
    </svg>

    <div class="policy-container-main" style="position:relative; z-index:2;">
        <div class="policy-hero-logo">
            <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Mental Health Frontline">
        </div>
        <h1 class="policy-main-title">
            Our Commitment to <br>
            <span class="orange-text">Safeguarding</span> and <span class="orange-text">Accountability</span>.
        </h1>
        <div class="policy-hero-text">
            <p>We operate in high-risk, conflict-affected environments where children and families face significant vulnerability. In this context, safeguarding, ethical practice, and accountability are not optional, they are fundamental.</p>
            <p>As a locally led organization, we are deeply embedded in the communities we serve. This proximity strengthens our responsibility to uphold the highest standards of protection, confidentiality, and professional conduct.</p>
            <p>The following policies define how we ensure safety, manage risk, and maintain trust across all our services.</p>
        </div>
    </div>

</section>

    <!-- ══ POLICIES CONTENT ══ -->
    <section class="policy-body-content">
        <div class="policy-container-narrow">

            <!-- 1. Safeguarding Policy -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon1.png') }}" alt="Icon">
                    <h2>Safeguarding Policy</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>We maintain a zero-tolerance approach to all forms of abuse, exploitation, and harm. Safeguarding is central to all our operations and applies to all staff, volunteers, and representatives. We are committed to protecting children and vulnerable individuals from:</p>
                    <ul class="policy-bullets">
                        <li>Abuse, neglect, or exploitation.</li>
                        <li>Psychological or emotional harm.</li>
                        <li>Misuse of power or trust.</li>
                    </ul>
                    <p>All personnel are required to:</p>
                    <ul class="policy-bullets">
                        <li>Adhere to safeguarding procedures at all times.</li>
                        <li>Immediately report any safeguarding concerns.</li>
                        <li>Prioritize the safety and dignity of beneficiaries in all interactions.</li>
                    </ul>
                    <p>Failure to comply will result in immediate action.</p>
                </div>
            </div>

            <!-- 2. Child Protection Policy -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon2.png') }}" alt="Icon">
                    <h2>Child Protection Policy</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>The best interests of the child are the primary consideration in all our work. We ensure that:</p>
                    <ul class="policy-bullets">
                        <li>All communication with children is safe, respectful, and age-appropriate.</li>
                        <li>Interactions are conducted within clear professional boundaries.</li>
                        <li>Caregivers are involved when appropriate and in the child's best interest.</li>
                    </ul>
                    <p>We are committed to creating a safe environment where children are protected from harm and supported in their recovery.</p>
                </div>
            </div>

            <!-- 3. Code of Conduct -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon3.png') }}" alt="Icon">
                    <h2>Code of Conduct</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>All staff and representatives are expected to uphold the highest standards of professional and ethical behavior. They must:</p>
                    <ul class="policy-bullets">
                        <li>Treat all individuals with dignity, respect, and impartiality.</li>
                        <li>Maintain clear professional boundaries at all times.</li>
                        <li>Refrain from any form of discrimination, harassment, or exploitation.</li>
                        <li>Avoid conflicts of interest and misuse of authority.</li>
                    </ul>
                    <p>Any breach of this Code will result in disciplinary measures.</p>
                </div>
            </div>

            <!-- 4. Confidentiality & Data Protection -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon4.png') }}" alt="Icon">
                    <h2>Confidentiality & Data Protection</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>We are committed to protecting the privacy and confidentiality of all individuals we serve.</p>
                    <ul class="policy-bullets">
                        <li>There is a risk of serious harm.</li>
                        <li>Safeguarding obligations require disclosure.</li>
                    </ul>
                    <p>Exceptions apply only when:</p>
                    <ul class="policy-bullets">
                        <li>All personal information is handled securely and accessed only when necessary.</li>
                        <li>Information is not shared without informed consent.</li>
                    </ul>
                    <p>All data is managed in accordance with recognized data protection standards.</p>
                </div>
            </div>

            <!-- 5. Online Safety Policy -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon5.png') }}" alt="Icon">
                    <h2>Online Safety Policy</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>As a fully remote service operating via WhatsApp and email, we enforce strict digital safety protocols. We ensure that:</p>
                    <ul class="policy-bullets">
                        <li>All communications remain professional, secure, and appropriate.</li>
                        <li>Clear boundaries are maintained in communication timing and conduct.</li>
                        <li>Personal data is protected during all interactions.</li>
                        <li>No sessions are recorded or shared without explicit consent.</li>
                    </ul>
                    <p>We actively mitigate risks associated with remote service delivery.</p>
                </div>
            </div>

            <!-- 6. Do No Harm & Ethical Practice -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon6.png') }}" alt="Icon">
                    <h2>Do No Harm & Ethical Practice</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>We are committed to ensuring that our services do not cause harm. We:</p>
                    <ul class="policy-bullets">
                        <li>Deliver evidence-based and trauma-informed interventions.</li>
                        <li>Operate within our professional competencies.</li>
                        <li>Refer cases requiring specialized or higher-level care.</li>
                        <li>Prioritize psychological safety in all interactions.</li>
                    </ul>
                    <p>Ethical practice is non-negotiable in all aspects of our work.</p>
                </div>
            </div>

            <!-- 7. Accountability & Transparency -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon7.png') }}" alt="Icon">
                    <h2>Accountability & Transparency</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>We are accountable to the communities we serve, our partners, and stakeholders. We:</p>
                    <ul class="policy-bullets">
                        <li>Monitor and evaluate the quality of our services.</li>
                        <li>Encourage feedback from beneficiaries.</li>
                        <li>Continuously improve based on evidence and learning.</li>
                    </ul>
                    <p>Transparency and responsibility guide all our actions.</p>
                </div>
            </div>

            <!-- 8. Zero Tolerance Policy -->
            <div class="policy-item-block">
                <div class="policy-item-header">
                    <img src="{{ asset('reachout/img/icon8.png') }}" alt="Icon">
                    <h2>Zero Tolerance Policy</h2>
                </div>
                <div class="policy-blue-border-content">
                    <p>Mental Health Frontline enforces a strict zero-tolerance policy toward all forms of abuse, exploitation, harassment, discrimination, and any misuse of power or position of trust across all its operations. Recognizing the heightened vulnerability of the individuals and communities we serve, all staff, volunteers, and representatives are required to adhere to the highest standards of ethical, professional, and trauma-informed practice at all times. Any alleged breach of this policy is taken with the utmost seriousness and will prompt immediate protective measures, followed by a fair, confidential, and thorough investigation in line with established safeguarding procedures. Confirmed violations will result in decisive disciplinary action, including immediate removal from duties and potential termination of engagement. Mental Health Frontline is firmly committed to safeguarding the dignity, safety, and psychological wellbeing of all beneficiaries, ensuring accountability at every level.</p>
                </div>
            </div>

            <!-- 9. Reporting & Complaints Mechanism -->
<div class="policy-item-block reporting-full-section">
    <div class="policy-item-header">
        <img src="{{ asset('reachout/img/icon9.png') }}" alt="Icon">
        <h2>Reporting & Complaints Mechanism</h2>
    </div>

    <div class="reporting-main-container">
        <!-- الفقرة العلوية مع خطها الخاص -->
        <div class="reporting-top-part">
            <p>We provide a safe, confidential, and accessible mechanism for reporting concerns, including safeguarding issues, misconduct or inappropriate behavior, breaches of confidentiality, and any risks to safety or wellbeing, with all reports treated in strict confidence, acted upon immediately in cases of risk, promptly reviewed and investigated, and with individuals reporting in good faith protected from retaliation.</p>
        </div>

        <!-- الجزء السفلي: العنوان والفورم -->
        <div class="reporting-bottom-flex">
            <div class="reporting-text-col">
                <div class="complaint-text-bottom">
                    <h2>Submit a Complaint or <br> Report a Concern</h2>
                    <p>Please use the form to submit your concern.<br> All submissions are handled securely and in<br> accordance with our safeguarding and confidentiality policies. <br>Safeguarding is at the core of everything we do. <br>We are committed to protecting every child and family we serve<br> without exception.</p>
                </div>
            </div>

            <div class="reporting-form-col">
                <div class="form-card-inner figma-final-box">
                    <div class="form-card-title">
                        <i class="fa-regular fa-file-lines"></i> <span>submit a concern</span>
                    </div>
                    <form action="#">
                        <div class="policy-form-group">
                            <label>Your contact info</label>
                            <input type="text" placeholder="Name or Email">
                        </div>
                        <div class="policy-form-group">
                            <label>Type of Concern</label>
                            <input type="text" placeholder="Subject of concern">
                        </div>
                        <div class="policy-form-group">
                            <label>Details</label>
                            <textarea rows="4" placeholder="Describe your concern"></textarea>
                        </div>
                        <button type="submit" class="btn-submit-policy-final">Secure Submission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </section>

@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ══ انميشن الهيرو عند تحميل الصفحة ══
    const heroElements = [
        { el: document.querySelectorAll('.ph-doc-1, .ph-doc-2, .ph-doc-3, .ph-doc-4, .ph-doc-5, .ph-doc-6'), delay: 0 },
        { el: document.querySelectorAll('.policy-hero-logo'), delay: 200 },
        { el: document.querySelectorAll('.policy-main-title'), delay: 450 },
        { el: document.querySelectorAll('.policy-hero-text p'), delay: 700 },
        { el: document.querySelectorAll('.ph-wave-bottom'), delay: 900 },
    ];

    heroElements.forEach(({ el, delay }) => {
        el.forEach((item, i) => {
            setTimeout(() => {
                item.classList.add('anim-visible');
            }, delay + (i * 80));
        });
    });

    // ══ انميشن باقي الصفحة عند الـ Scroll ══
    const scrollElements = document.querySelectorAll(
        '.policy-item-block, .policy-item-header, .policy-blue-border-content, .reporting-top-part, .reporting-bottom-flex'
    );

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('anim-visible');
                }, i * 100);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    scrollElements.forEach(el => observer.observe(el));

});
</script>