@extends('frontend.layouts.main')

@section('title', 'Donate - Mental Health Frontline')

@section('footer-class', 'donate-footer')

@section('styles')
<style>
/* ══ DONATE HERO ══ */
.donate-page {
    min-height: 100vh;
    background-image: url('{{ asset("reachout/img/hero2.png") }}');
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center; 
    padding: 80px 40px 40px 40px; 
}
.donate-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35); 
}
.donate-inner {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
    width: 100%;
    display: flex;
    align-items: center; 
    justify-content: space-between;
    gap: 50px;
}

/* ══ LEFT SECTION ══ */
.donate-left { 
    flex: 1; 
    color: #fff; 
    padding-right: 20px;
}
.donate-left-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
}
.donate-logo {
    display: block; 
    width: 180px; 
    height: 180px;
    border-radius: 50%; 
    object-fit: contain;
    margin: 0 0 20px 0;
    border: 2px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.08); 
    padding: 6px;
    transform: translate(100px, 0px);
}
.donate-title {
    display: block;
    font-family: 'Caprasimo', cursive;
    font-size: clamp(26px, 2.8vw, 38px); 
    line-height: 1.2; 
    margin-top: 0; 
    margin-bottom: 15px; 
    color: #fff;
    max-width: 440px; 
}
.donate-desc {
    display: block;
    font-size: 16.5px; 
    line-height: 1.6;
    color: rgba(255,255,255,0.9);
    max-width: 440px;
    font-family: 'Nunito', sans-serif;
    margin-top: 0;
}

/* ══ CARD ══ */
.donate-card {
    width: 100%;
    max-width: 480px; 
    flex-shrink: 0;
    background: #fff; 
    border-radius: 16px;
    overflow: hidden; 
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

/* Header */
.dc-head {
    background: #1a3a6b; 
    padding: 14px 20px; 
    display: flex; 
    align-items: center; 
    gap: 12px;
}
.dc-head-ico {
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 15px; flex-shrink: 0;
}
.dc-head-t { font-size: 14.5px; font-weight: 700; color: #fff; font-family: 'Inter', sans-serif; }
.dc-head-s { font-size: 11.5px; color: rgba(255,255,255,0.65); font-family: 'Inter', sans-serif; }

/* Shared fields block */
.dc-shared {
    padding: 0 20px;
    border-bottom: 1px solid #f0f2f7;
}
.dc-grid {
    display: grid; 
    grid-template-columns: 1.2fr 1fr; 
}
.dc-cell { 
    padding: 10px 0; 
    border-bottom: 1px solid #f0f2f7; 
}
.dc-cell.left-col {
    border-right: 1px solid #f0f2f7;
    padding-right: 12px;
}
.dc-cell.right-col {
    padding-left: 12px;
}
.dc-grid .dc-cell:nth-last-child(1),
.dc-grid .dc-cell:nth-last-child(2) {
    border-bottom: none;
}

.dc-cell-lbl {
    font-size: 9.5px; color: #a0aec0;
    text-transform: uppercase; letter-spacing: 0.5px;
    margin-bottom: 2px; display: flex; align-items: center; gap: 4px;
    font-family: 'Inter', sans-serif;
}
.dc-cell-lbl i { font-size: 9px; color: #b0bac8; }
.dc-cell-val {
    font-size: 12px; font-weight: 700;
    color: #1a3a6b; font-family: 'Inter', sans-serif;
    white-space: normal; 
    word-break: break-word;
}
.dc-cell-val.sm  { font-size: 11.5px; line-height: 1.3; }
.dc-cell-val.mono { font-family: 'Courier New', monospace; letter-spacing: 0.5px; }

/* إخفاء حقل الجوال المدمج للشاشات الكبيرة */
.mobile-location-cell {
    display: none;
}

/* Currency toggle */
.dc-cur-row {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 12px; padding: 12px 20px; border-bottom: 1px solid #f0f2f7;
}
.dc-cur-btn {
    border: 1.5px solid #e2e8f5; border-radius: 10px;
    padding: 8px 0; text-align: center; cursor: pointer;
    background: #f8faff; transition: all 0.18s; user-select: none;
}
.dc-cur-btn:hover { border-color: #1a3a6b; }
.dc-cur-btn.active { border-color: #1a3a6b; background: #eef2fb; }
.dc-cur-sym { font-size: 18px; font-weight: 700; color: #1a3a6b; line-height: 1; font-family: 'Inter', sans-serif; }
.dc-cur-name { font-size: 10.5px; color: #6b7a99; margin-top: 2px; font-family: 'Inter', sans-serif; }
.dc-cur-btn.active .dc-cur-name { color: #1a3a6b; font-weight: 600; }

/* IBAN reveal */
.dc-iban { padding: 10px 20px; border-bottom: 1px solid #f0f2f7; background: #f8faff; }
.dc-iban-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
.dc-iban-lbl { font-size: 9.5px; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 4px; font-family: 'Inter', sans-serif; }
.dc-iban-badge { font-size: 9.5px; font-weight: 700; background: #1a3a6b; color: #fff; padding: 2px 8px; border-radius: 20px; font-family: 'Inter', sans-serif; }
.dc-iban-box {
    background: #fff; border: 1px solid #e2e8f5; border-radius: 8px; padding: 8px 12px; 
    font-size: clamp(10.5px, 2.9vw, 13px); font-weight: 700; color: #1a3a6b;
    letter-spacing: 0.3px; font-family: 'Courier New', monospace;
    display: flex; align-items: center; justify-content: space-between; gap: 10px;
}
#ibanText { white-space: normal; word-break: break-all; }
.dc-copy-btn {
    font-size: 10.5px; font-weight: 700; color: #1a3a6b; background: #e8eef7; border: none; border-radius: 5px;
    padding: 5px 10px; cursor: pointer; display: flex; align-items: center; gap: 4px; font-family: 'Inter', sans-serif; transition: background 0.2s; white-space: nowrap;
}
.dc-copy-btn:hover { background: #d4dff0; }

/* Tips */
.dc-tips { padding: 10px 20px; display: flex; flex-direction: column; gap: 6px; border-bottom: 1px solid #f0f2f7; }
.dc-tip { display: flex; align-items: flex-start; gap: 8px; }
.dc-tip-ico { width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 9px; margin-top: 1px; }
.dc-tip-ico.blue  { background: #e8eef7; color: #1a3a6b; }
.dc-tip-ico.green { background: #e6f9ee; color: #1a6b3a; }
.dc-tip-text { font-size: 11px; color: #555; line-height: 1.4; font-family: 'Inter', sans-serif; }
.dc-tip-text strong { color: #1a3a6b; font-weight: 700; }

/* WhatsApp Style */
.dc-wa-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 10px;
    width: auto; margin: 14px auto; padding: 10px 26px; background: #25D366; color: #fff; border-radius: 30px; 
    text-decoration: none; font-size: 14px; font-weight: 700; font-family: 'Nunito', sans-serif;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25); transition: all 0.25s ease;
}
.dc-wa-btn:hover { background: #1fba59; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4); }
.dc-wa-btn i { font-size: 16px; }

/* ══ FOOTER ══ */
.donate-footer .footer-wire { filter: invert(1); }

/* ══ RESPONSIVE TABLET ══ */
@media (max-width: 1024px) {
    .donate-page { padding: 100px 30px 40px 30px; }
    .donate-inner { gap: 30px; justify-content: center; }
    .donate-card { max-width: 440px; }
    .donate-logo { transform: translate(40px, 0px); } 
}

@media (max-width: 850px) {
    .donate-page { padding: 110px 20px 45px; min-height: 100vh; }
    .donate-inner { flex-direction: column; gap: 35px; align-items: center; }
    .donate-left { padding-right: 0; width: 100%; margin-top: 0; }
    .donate-left-content { align-items: center; text-align: center; }
    .donate-logo { width: 120px; height: 120px; margin: 0 auto 16px auto; transform: none; }
    .donate-title { font-size: clamp(26px, 5vw, 36px); margin-bottom: 12px; max-width: 100%; }
    .donate-desc { font-size: 16px; line-height: 1.6; max-width: 100%; }
    .donate-card { max-width: 500px; width: 100%; }
    .donate-page::before { background: rgba(0,0,0,0.35) !important; }
}

/* ══ 📱 شاشات الجوال الصغيرة (تحت 480px) ══ */
@media (max-width: 480px) {
    .donate-page { padding: 95px 10px 40px !important; }
    .donate-page::before { background: rgba(0,0,0,0.35) !important; }

    .dc-head { padding: 10px 14px; gap: 8px; }
    .dc-head-ico { width: 28px; height: 28px; font-size: 13px; }
    .dc-head-t { font-size: 13px; }
    .dc-head-s { font-size: 10px; }
    
    .dc-shared { padding: 0 12px; }
    
    .dc-grid { 
        display: grid !important; 
        grid-template-columns: 1.2fr 1fr !important; 
    }
    
    .dc-cell { padding: 8px 0; }
    .dc-cell.left-col { padding-right: 8px; border-right: 1px solid #f0f2f7; }
    .dc-cell.right-col { padding-left: 8px; }

    .desktop-country-cell, .desktop-city-cell { display: none !important; }
    
    .mobile-location-cell { 
        display: block !important; 
        grid-column: span 2; 
        border-bottom: none !important;
        padding-top: 8px;
    }

    .dc-cell-lbl { font-size: 8.5px; margin-bottom: 1px; }
    .dc-cell-val { font-size: 11.5px; }
    
    .dc-cur-row { gap: 8px; padding: 10px 14px; }
    .dc-cur-btn { padding: 6px 0; border-radius: 8px; }
    .dc-cur-sym { font-size: 15px; }
    .dc-cur-name { font-size: 9px; }
    
    .dc-iban { padding: 8px 14px; }
    .dc-iban-box { padding: 6px 10px; }
    
    .dc-tips { padding: 8px 14px; gap: 4px; }
    .dc-tip-text { font-size: 10px; }
    
    /* 🛠 تعديل زر الواتس أب: إلغاء التمدد ليكون ملموماً ومتناسقاً */
    .dc-wa-btn { 
        width: auto !important; 
        padding: 8px 24px !important; 
        margin: 8px auto !important; 
        font-size: 12.5px; 
    }
}
</style>
@endsection

@section('content')
<section class="donate-page">
    <div class="donate-inner">

        <div class="donate-left">
            <div class="donate-left-content">
                <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Logo" class="donate-logo">
                <h1 class="donate-title">Support Those on the Frontline Today.</h1>
                <p class="donate-desc">Your support provides immediate, confidential care to people facing crisis, stress, and overwhelming situations.</p>
            </div>
        </div>

        <div class="donate-card">
            <div class="dc-head">
                <div class="dc-head-ico"><i class="fas fa-university"></i></div>
                <div>
                    <div class="dc-head-t">Bank Transfer Details</div>
                    <div class="dc-head-s">International wire — all fields required</div>
                </div>
            </div>

            <div class="dc-shared">
                <div class="dc-grid">
                    <div class="dc-cell left-col">
                        <div class="dc-cell-lbl"><i class="fas fa-user"></i> Account name</div>
                        <div class="dc-cell-val sm">{{ $bank->account_name }}</div> 
                    </div>
                    <div class="dc-cell right-col">
                        <div class="dc-cell-lbl"><i class="fas fa-building"></i> Bank</div>
                        <div class="dc-cell-val sm">{{ $bank->bank_name }}</div> 
                    </div>

                    <div class="dc-cell left-col">
                        <div class="dc-cell-lbl"><i class="fas fa-globe"></i> SWIFT / BIC</div>
                        <div class="dc-cell-val mono">{{ $bank->swift_code }}</div> 
                    </div>
                    <div class="dc-cell right-col">
                        <div class="dc-cell-lbl"><i class="fas fa-code-branch"></i> Branch</div>
                        <div class="dc-cell-val sm">{{ $bank->branch }}</div> 
                    </div>

                    <div class="dc-cell left-col desktop-country-cell">
                        <div class="dc-cell-lbl"><i class="fas fa-flag"></i> Country</div>
                        <div class="dc-cell-val sm">{{ $bank->country ?? 'Palestine 🇵🇸' }}</div> 
                    </div>
                    <div class="dc-cell right-col desktop-city-cell">
                        <div class="dc-cell-lbl"><i class="fas fa-map-marker-alt"></i> City</div>
                        <div class="dc-cell-val sm">{{ $bank->city }}</div>
                    </div>

                    <div class="dc-cell mobile-location-cell">
                        <div class="dc-cell-lbl"><i class="fas fa-map-marker-alt"></i> Location</div>
                        <div class="dc-cell-val sm">{{ $bank->city }}, {{ $bank->country ?? 'Palestine 🇵🇸' }}</div>
                    </div>
                </div>
            </div>

            <div class="dc-cur-row">
                <div class="dc-cur-btn active" id="btn-usd" onclick="switchCur('usd')">
                    <div class="dc-cur-sym">$</div>
                    <div class="dc-cur-name">US Dollar (USD)</div>
                </div>
                <div class="dc-cur-btn" id="btn-ils" onclick="switchCur('ils')">
                    <div class="dc-cur-sym">₪</div>
                    <div class="dc-cur-name">Israeli Shekel (ILS)</div>
                </div>
            </div>

            <div class="dc-iban">
                <div class="dc-iban-top">
                    <span class="dc-iban-lbl"><i class="fas fa-credit-card"></i> IBAN</span>
                    <span class="dc-iban-badge" id="ibanBadge">USD $</span>
                </div>
                <div class="dc-iban-box">
                    <span id="ibanText">{{ $bank->iban_usd }}</span>
                    <button class="dc-copy-btn" id="copyBtn" onclick="copyIBAN()">
                        <i class="fas fa-copy"></i> Copy
                    </button>
                </div>
            </div>

            <div class="dc-tips">
                <div class="dc-tip">
                    <div class="dc-tip-ico blue"><i class="fas fa-dollar-sign"></i></div>
                    <div class="dc-tip-text"><strong>Fee type: OUR</strong> — intermediary fees are covered by your bank.</div>
                </div>
                <div class="dc-tip">
                    <div class="dc-tip-ico green"><i class="fas fa-file-alt"></i></div>
                    <div class="dc-tip-text"><strong>Purpose:</strong> write <strong>"Charitable Donation"</strong> for processing.</div>
                </div>
            </div>

            <div style="text-align: center; width: 100%;">
                <a href="https://wa.me/{{ $bank->whatsapp_number }}" class="dc-wa-btn">
                    <i class="fab fa-whatsapp"></i>
                    Confirm via WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
var ibans = {
    usd: '{{ $bank->iban_usd }}',
    ils: '{{ $bank->iban_ils }}'
};

function switchCur(cur) {
    document.getElementById('btn-usd').classList.toggle('active', cur === 'usd');
    document.getElementById('btn-ils').classList.toggle('active', cur === 'ils');
    document.getElementById('ibanText').textContent = ibans[cur];
    document.getElementById('ibanBadge').textContent = cur === 'usd' ? 'USD $' : 'ILS ₪';
    var btn = document.getElementById('copyBtn');
    btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
    btn.style.background = '#e8eef7';
    btn.style.color = '#1a3a6b';
}

function copyIBAN() {
    var iban = document.getElementById('ibanText').textContent.replace(/\s/g, '');
    navigator.clipboard.writeText(iban).then(function () {
        var btn = document.getElementById('copyBtn');
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.style.background = '#d4f5e2';
        btn.style.color = '#1a6b3a';
        setTimeout(function () {
            btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
            btn.style.background = '#e8eef7';
            btn.style.color = '#1a3a6b';
        }, 2000);
    });
}
</script>
@endsection