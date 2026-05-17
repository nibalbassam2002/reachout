@extends('frontend.layouts.main')

@section('title', 'Donate - Mental Health Frontline')

@section('footer-class', 'donate-footer')

@section('styles')
<style>
/* ══ DONATE HERO ══ */
.donate-page {
    min-height: 130vh;
    background-image: url('{{ asset("reachout/img/hero2.png") }}');
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    padding: 10px 40px 60px 40px;
}

.donate-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
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
    gap: 60px;
}

/* ══ LEFT SIDE ══ */
.donate-left {
    flex: 1;
    color: #fff;
    
}

.donate-logo {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    object-fit: contain;
    margin-bottom: 28px;
    margin-left: 130px;
    border: 2px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.08);
    padding: 6px;
}

.donate-title {
    font-family: 'Caprasimo', cursive;
    font-size: clamp(28px, 3.5vw, 44px);
    line-height: 1.2;
    margin-bottom: 0px;
    color: #fff;
}

.donate-desc {
    font-size: 26px;
    line-height: 1.75;
    color: rgba(255,255,255,0.88);
    max-width: 420px;
    font-family: 'Nunito', sans-serif;
}

/* ══ FORM CARD ══ */
.donate-card {
    background: rgba(255,255,255,0.96);
    border-radius: 16px;
    padding: 45px 32px;
    width: 400px;
    flex-shrink: 0;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}

/* Toggle buttons */
.donate-toggle {
    display: flex;
    gap: 10px;
    margin-bottom: 18px;
}

.toggle-btn {
    flex: 1;
    padding: 10px;
    border: 1.5px solid #ccc;
    border-radius: 8px;
    background: #fff;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    color: #333;
    transition: all 0.2s;
}

.toggle-btn.active {
    border-color: #1a4fa0;
    background: #fff;
    color: #1a4fa0;
}

.donate-support-text {
    font-size: 13px;
    color: #555;
    margin-bottom: 16px;
    font-family: 'Inter', sans-serif;
}

/* Amount grid */
.amount-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 14px;
}

.amount-btn {
    padding: 10px 6px;
    border: 1.5px solid #ccc;
    border-radius: 8px;
    background: #fff;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    color: #333;
    transition: all 0.2s;
    text-align: center;
}

.amount-btn:hover,
.amount-btn.selected {
    border-color: #1a4fa0;
    color: #1a4fa0;
    background: #eef2ff;
}

/* Custom amount row */
.custom-amount-row {
    display: flex;
    align-items: center;
    border: 1.5px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 14px;
}

.custom-amount-input {
    flex: 1;
    padding: 11px 14px;
    border: none;
    outline: none;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
    color: #333;
}

.currency-select {
    padding: 11px 12px;
    border: none;
    border-left: 1.5px solid #ccc;
    background: #f9f9f9;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Inter', sans-serif;
    color: #333;
    cursor: pointer;
    outline: none;
}

/* Dedicate checkbox */
.dedicate-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
}

.dedicate-row input[type="checkbox"] {
    width: 15px;
    height: 15px;
    accent-color: #1a4fa0;
}

.dedicate-row label {
    font-size: 13px;
    color: #555;
    font-family: 'Inter', sans-serif;
}

/* Donate button */
.btn-donate-main {
    width: 100%;
    padding: 15px;
    background: #1a4fa0;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: background 0.2s, transform 0.2s;
}

.btn-donate-main:hover {
    background: #163d82;
    transform: translateY(-2px);
}

/* ══ FOOTER WIRE WHITE ══ */
.donate-footer .footer-wire {
    filter: invert(1);
}

/* ══ RESPONSIVE ══ */
@media (max-width: 768px) {
    .donate-inner {
        flex-direction: column;
        align-items: flex-start;
        gap: 36px;
    }
    .donate-card {
        width: 100%;
    }
}
</style>
@endsection

@section('content')
<section class="donate-page">
    <div class="donate-inner">

        <!-- Left -->
        <div class="donate-left">
            <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Logo" class="donate-logo">
            <h1 class="donate-title">Support Those on the<br>Frontline Today.</h1>
            <p class="donate-desc">Your support provides immediate, confidential care to people facing crisis, stress, and overwhelming situations.</p>
        </div>

        <!-- Form Card -->
        <div class="donate-card">

            <!-- One-time / Monthly -->
            <div class="donate-toggle">
                <button class="toggle-btn active" onclick="setToggle(this)">One-time</button>
                <button class="toggle-btn" onclick="setToggle(this)">Monthly</button>
            </div>

            <p class="donate-support-text">Support inclusive humanitarian aid.</p>

            <!-- Amounts -->
            <div class="amount-grid">
                <button class="amount-btn" onclick="selectAmount(this)">₪ 3000</button>
                <button class="amount-btn" onclick="selectAmount(this)">₪ 1500</button>
                <button class="amount-btn" onclick="selectAmount(this)">₪ 750</button>
                <button class="amount-btn" onclick="selectAmount(this)">₪ 300</button>
                <button class="amount-btn selected" onclick="selectAmount(this)">₪ 160</button>
                <button class="amount-btn" onclick="selectAmount(this)">₪ 75</button>
            </div>

            <!-- Custom Amount -->
            <div class="custom-amount-row">
                <span style="padding: 0 8px 0 14px; font-size:13px; color:#888;">₪</span>
                <input type="text" class="custom-amount-input" value="160" id="customAmount">
                <select class="currency-select">
                    <option>ILS</option>
                    <option>USD</option>
                    <option>EUR</option>
                </select>
            </div>

            <!-- Dedicate -->
            <div class="dedicate-row">
                <input type="checkbox" id="dedicate">
                <label for="dedicate">Dedicate this donation</label>
            </div>

            <!-- Button -->
            <button class="btn-donate-main">Donate</button>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
function setToggle(btn) {
    document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

function selectAmount(btn) {
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    // استخراج الرقم بدون ₪
    const val = btn.textContent.replace('₪', '').trim();
    document.getElementById('customAmount').value = val;
}
</script>
@endsection