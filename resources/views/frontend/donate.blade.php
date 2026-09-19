@extends('frontend.layouts.main')

@section('title', 'Back Us - Mental Health Frontline')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
/* ══ REACHOUT BRAND DESIGN SYSTEM ══ */
:root {
    --ro-navy: #0a2a4a;
    --ro-navy-light: #163a66;
    --ro-blue: #184B89;
    --ro-blue-light: #eef4fc;
    --ro-red: #c0392b;
    --ro-red-hover: #a93226;
    --ro-gold: #e88d35;
    --ro-gold-light: #fef6ee;
    --ro-gold-dark: #b45309;
    --ro-bg-soft: #f8fafc;
    --ro-bg-tint: #f3f6fa;
    --ro-border: #e2e8f0;
    --ro-border-blue: #bfdbfe;
    --ro-text: #2c3e50;
    --ro-text-muted: #5a6e85;
    --ro-text-light: #7e91a6;
}

body {
    font-family: 'Nunito', sans-serif;
    color: var(--ro-text);
    background-color: #ffffff;
    overflow-x: hidden;
}

.font-display {
    font-family: 'Caprasimo', cursive;
    letter-spacing: 0.2px;
}

.font-script {
    font-family: 'Caveat', cursive;
}

/* ══ 1. HERO SECTION (FULL-WIDTH BACKGROUND - NATURAL DIRECTION WITH NEW CONTENT) ══ */
.ro-hero-section {
    position: relative;
    margin-top: 80px;
    padding: 80px 24px 80px 24px;
    min-height: 580px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0a1829;
}

/* Background Image Layer & Dark Cinematic Legibility Overlay */
.ro-hero-bg-layer {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    overflow: hidden;
    pointer-events: none;
}

.ro-hero-bg-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 25% 15%;
    filter: brightness(0.95) contrast(1.03);
}

/* Clean gradient: Natural & clear on the left for the girl, rich contrast on the right for text */
.ro-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(0, 0, 0, 0) 0%,
        rgba(0, 0, 0, 0.08) 28%,
        rgba(10, 24, 42, 0.65) 58%,
        rgba(10, 24, 42, 0.90) 80%,
        rgba(10, 24, 42, 0.95) 100%
    );
}

.ro-hero-container {
    max-width: 1320px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    z-index: 3;
    display: flex;
    justify-content: flex-end;
}

.ro-hero-content {
    max-width: 630px;
    width: 100%;
    margin-right: 15px;
}

.ro-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(8px);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 700;
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    margin-bottom: 22px;
}

.ro-live-pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #22c55e;
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
    animation: livePulse 2s infinite;
    flex-shrink: 0;
}

@keyframes livePulse {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

.ro-badge i {
    color: #ff5252;
}

.ro-hero-title {
    font-size: clamp(28px, 3.2vw, 42px);
    font-weight: normal;
    line-height: 1.22;
    color: #ffffff;
    margin-bottom: 16px;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.6);
}

.ro-highlight-red {
    color: #ff5252;
}

.ro-highlight-blue {
    color: #60a5fa;
}

.ro-hero-desc {
    font-size: 16px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.90);
    margin-bottom: 24px;
    max-width: 580px;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
}

/* Frontline Trust Micro-Cards (3 Columns side-by-side) */
.ro-hero-trust-row {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 28px;
    align-items: stretch;
}

.ro-trust-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.22);
    backdrop-filter: blur(10px);
    padding: 10px 12px;
    border-radius: 12px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
    min-width: 0;
    height: 100%;
    box-sizing: border-box;
}

.ro-trust-pill:hover {
    background: rgba(255, 255, 255, 0.20);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-2px);
}

.ro-trust-pill i {
    font-size: 13.5px;
    color: #60a5fa;
    background: rgba(255, 255, 255, 0.16);
    width: 34px;
    height: 34px;
    min-width: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.ro-trust-pill-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
    flex: 1;
}

.ro-trust-pill strong {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    line-height: 1.25;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ro-trust-pill span {
    display: block;
    font-size: 10.5px;
    color: rgba(255, 255, 255, 0.80);
    line-height: 1.25;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* CTA Group */
.ro-hero-cta-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: flex-start;
}

.btn-ro-primary {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: var(--ro-red);
    color: #ffffff;
    padding: 16px 36px;
    border-radius: 50px;
    font-size: 15.5px;
    font-weight: 800;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 8px 22px rgba(192, 57, 43, 0.45);
    font-family: 'Inter', sans-serif;
}

.btn-ro-primary:hover {
    background: var(--ro-red-hover);
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(192, 57, 43, 0.55);
    color: #ffffff;
}

.ro-hero-cta-meta {
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.82);
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
}

.ro-hero-cta-meta i {
    color: #4ade80;
    font-size: 12px;
}



/* ══ 2. PACKAGES SECTION ══ */
.ro-packages-section {
    padding: 60px 24px 70px 24px;
    background-color: #ffffff;
    position: relative;
}

.ro-section-header {
    text-align: center;
    max-width: 760px;
    margin: 0 auto 30px auto;
}

.ro-eyebrow {
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.6px;
    color: var(--ro-red);
    margin-bottom: 10px;
    display: inline-block;
}

.ro-section-title {
    font-size: clamp(26px, 3vw, 36px);
    font-weight: normal;
    color: var(--ro-navy);
    line-height: 1.25;
    margin-bottom: 12px;
}

.ro-section-sub {
    font-size: 15.5px;
    color: var(--ro-text-muted);
    line-height: 1.55;
}

/* Frequency Switcher Pill */
.ro-freq-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 auto 30px auto;
    position: relative;
}

.ro-freq-toggle {
    display: inline-flex;
    align-items: center;
    background: #eef4fc;
    border-radius: 50px;
    padding: 5px;
    border: 1.5px solid #bfdbfe;
    box-shadow: inset 0 2px 5px rgba(10, 42, 74, 0.05);
    gap: 4px;
}

.ro-freq-btn {
    border: none;
    background: transparent;
    padding: 10px 22px;
    border-radius: 40px;
    font-size: 13.5px;
    font-weight: 800;
    color: var(--ro-text-muted);
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    font-family: 'Inter', sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.ro-freq-btn:not(.active):hover {
    color: var(--ro-navy);
    background: rgba(255, 255, 255, 0.7);
    transform: scale(1.02);
}

.ro-freq-btn.active {
    background: var(--ro-blue);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.28);
}

.freq-badge-heart {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
    font-size: 10.5px;
    padding: 3px 8px;
    border-radius: 20px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.25s ease;
}

.ro-freq-btn.active .freq-badge-heart {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
}

.ro-freq-subhint {
    margin-top: 10px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--ro-text-muted);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 18px;
    background: #f8fafc;
    border-radius: 30px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

/* 4 Packages Grid */
.ro-packages-grid {
    max-width: 1140px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    align-items: stretch;
}

.ro-pkg-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 20px;
    padding: 26px 18px 22px 18px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 16px rgba(10, 42, 74, 0.04);
}

.ro-pkg-card:hover {
    border-color: var(--ro-blue);
    transform: translateY(-5px);
    box-shadow: 0 14px 32px rgba(24, 75, 137, 0.12);
}

.ro-pkg-card.featured {
    background: #ffffff;
    border: 2px solid var(--ro-blue);
    box-shadow: 0 8px 28px rgba(24, 75, 137, 0.12);
}

.featured-ribbon {
    position: absolute;
    top: -12px;
    background: linear-gradient(135deg, #e88d35 0%, #c0392b 100%);
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.5px;
    padding: 3px 14px;
    border-radius: 50px;
    box-shadow: 0 4px 10px rgba(232, 141, 53, 0.35);
    text-transform: uppercase;
}

.pkg-icon-circle {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f0f6ff 0%, #e0edff 100%);
    color: var(--ro-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 14px;
    border: 1.5px solid #dbeafe;
    box-shadow: 0 3px 10px rgba(24, 75, 137, 0.06);
    transition: transform 0.25s ease;
}

.ro-pkg-card:hover .pkg-icon-circle {
    transform: scale(1.06);
}

.ro-pkg-card.featured .pkg-icon-circle {
    background: linear-gradient(135deg, var(--ro-navy) 0%, var(--ro-blue) 100%);
    color: #ffffff;
    border-color: var(--ro-blue);
}

.pkg-consultations {
    font-size: 16.5px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-bottom: 6px;
    font-family: 'Nunito', sans-serif;
}

.pkg-price-row {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 5px;
    margin-bottom: 6px;
}

.pkg-price {
    font-size: 38px;
    font-weight: 800;
    color: var(--ro-navy);
    line-height: 1;
    font-family: 'Nunito', sans-serif;
    letter-spacing: -0.5px;
    transition: transform 0.25s ease;
}

.pkg-period {
    font-size: 13px;
    font-weight: 700;
    color: var(--ro-text-muted);
    font-family: 'Inter', sans-serif;
    transition: all 0.25s ease;
}

.pkg-freq-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 10.5px;
    font-weight: 800;
    color: var(--ro-blue);
    background: #eef6ff;
    border: 1px solid #bfdbfe;
    padding: 3px 10px;
    border-radius: 20px;
    margin-bottom: 12px;
    transition: all 0.25s ease;
}

.pkg-freq-pill.one-time {
    color: #475569;
    background: #f1f5f9;
    border-color: #cbd5e1;
}

/* Card morph micro-animation */
@keyframes cardMorph {
    0% {
        opacity: 0.65;
        transform: translateY(8px) scale(0.98);
    }
    60% {
        transform: translateY(-2px) scale(1.006);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.ro-pkg-card.card-morph {
    animation: cardMorph 0.38s cubic-bezier(0.16, 1, 0.3, 1) both;
}

.pkg-save-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fef3c7;
    color: #b45309;
    border: 1px solid #fde68a;
    font-size: 11px;
    font-weight: 800;
    padding: 2px 10px;
    border-radius: 50px;
    margin-bottom: 12px;
    font-family: 'Inter', sans-serif;
}

.pkg-save-placeholder {
    display: none;
}

.btn-pkg-buy {
    width: 100%;
    background: var(--ro-navy);
    color: #ffffff;
    border: none;
    border-radius: 50px;
    padding: 12px 18px;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-top: auto;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 4px 12px rgba(10, 42, 74, 0.10);
}

.btn-pkg-buy:hover {
    background: var(--ro-blue);
    box-shadow: 0 6px 18px rgba(24, 75, 137, 0.25);
    transform: translateY(-2px);
}

.ro-pkg-card.featured .btn-pkg-buy {
    background: var(--ro-red);
    box-shadow: 0 4px 12px rgba(192, 57, 43, 0.25);
}

.ro-pkg-card.featured .btn-pkg-buy:hover {
    background: var(--ro-red-hover);
    box-shadow: 0 6px 18px rgba(192, 57, 43, 0.35);
}

.bop-trust-item i {
    color: var(--ro-blue);
    font-size: 14px;
}

/* Custom grant bar */
.ro-custom-bar {
    max-width: 600px;
    margin: 38px auto 0 auto;
    text-align: center;
    padding: 16px 24px;
    background: var(--ro-bg-soft);
    border: 1.5px dashed var(--ro-border-blue);
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    font-size: 14.5px;
    color: var(--ro-text-muted);
}

.ro-custom-btn-link {
    color: var(--ro-blue);
    font-weight: 800;
    text-decoration: underline;
    cursor: pointer;
}

/* ══ 3. HOW YOUR PURCHASE BECOMES CARE (DYNAMIC ANIMATED PROCESS) ══ */
.ro-process-section {
    padding: 105px 24px;
    background: radial-gradient(circle at 50% 0%, rgba(24, 75, 137, 0.04) 0%, transparent 60%),
                linear-gradient(180deg, #ffffff 0%, #f4f7fb 50%, #ffffff 100%);
    border-top: 1px solid var(--ro-border);
    border-bottom: 1px solid var(--ro-border);
    position: relative;
    overflow: hidden;
}

.ro-process-wrapper {
    max-width: 1140px;
    margin: 0 auto;
    position: relative;
}

/* Connecting Energy Line */
.process-track-line {
    position: absolute;
    top: 90px;
    left: 12%;
    right: 12%;
    height: 3px;
    background: linear-gradient(90deg, rgba(24, 75, 137, 0.1) 0%, rgba(24, 75, 137, 0.2) 50%, rgba(24, 75, 137, 0.1) 100%);
    z-index: 1;
    border-radius: 4px;
    overflow: hidden;
}

.process-pulse-beam {
    position: absolute;
    top: 0;
    left: -25%;
    width: 30%;
    height: 100%;
    background: linear-gradient(90deg, transparent 0%, #184B89 50%, #e88d35 100%);
    box-shadow: 0 0 12px rgba(24, 75, 137, 0.8), 0 0 6px #e88d35;
    border-radius: 4px;
    animation: trackBeamRun 3.2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}

@keyframes trackBeamRun {
    0% { left: -30%; opacity: 0; }
    15% { opacity: 1; }
    85% { opacity: 1; }
    100% { left: 105%; opacity: 0; }
}

.ro-process-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr auto 1fr;
    align-items: stretch;
    gap: 16px;
    position: relative;
    z-index: 2;
}

/* Step Card with Elevated Dynamic Look */
.process-step-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 22px;
    padding: 34px 24px 30px 24px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    box-shadow: 0 4px 20px rgba(10, 42, 74, 0.04);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: default;
}

.process-step-card:hover {
    transform: translateY(-8px);
    border-color: var(--ro-blue);
    box-shadow: 0 20px 45px rgba(24, 75, 137, 0.12);
}

.process-step-card.featured-step {
    border-color: #bfdbfe;
    background: linear-gradient(180deg, #ffffff 0%, #fafcff 100%);
}

.process-step-card.featured-step:hover {
    border-color: var(--ro-red);
    box-shadow: 0 20px 45px rgba(192, 57, 43, 0.12);
}

/* Icon Wrap with Ambient Movement */
.process-icon-wrap {
    position: relative;
    width: 78px;
    height: 78px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffffff 0%, #f0f6ff 100%);
    border: 2px solid #bfdbfe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: var(--ro-blue);
    margin-bottom: 16px;
    box-shadow: 0 8px 24px rgba(24, 75, 137, 0.08);
    transition: all 0.35s ease;
}

.process-step-card:hover .process-icon-wrap {
    transform: scale(1.1);
    border-color: var(--ro-blue);
    box-shadow: 0 12px 28px rgba(24, 75, 137, 0.2);
}

.featured-step .process-icon-wrap {
    color: var(--ro-red);
    border-color: #fecaca;
    background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
}

.featured-step:hover .process-icon-wrap {
    border-color: var(--ro-red);
    box-shadow: 0 12px 28px rgba(192, 57, 43, 0.2);[]
}

/* Unique Icon Floating Animations */
.icon-step-1 {
    animation: cardFloat 3.5s ease-in-out infinite alternate;
}

@keyframes cardFloat {
    0% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-3px) rotate(-4deg); }
    100% { transform: translateY(2px) rotate(3deg); }
}

.icon-step-2 {
    animation: docBreathing 3.5s ease-in-out infinite alternate;
}

@keyframes docBreathing {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.icon-step-3 {
    animation: heartPulseMotion 2s ease-in-out infinite;
}

@keyframes heartPulseMotion {
    0%, 100% { transform: scale(1); }
    14% { transform: scale(1.2); }
    28% { transform: scale(1); }
    42% { transform: scale(1.14); }
    70% { transform: scale(1); }
}

/* Radar Ping Behind Icon on Hover */
.icon-radar-ping {
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid var(--ro-blue);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}

.process-step-card:hover .icon-radar-ping {
    animation: pingRadar 1.6s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.featured-step:hover .icon-radar-ping {
    border-color: var(--ro-red);
}

@keyframes pingRadar {
    0% { transform: scale(0.95); opacity: 0.8; }
    100% { transform: scale(1.45); opacity: 0; }
}

/* Step Number Badge */
.step-badge-num {
    position: absolute;
    top: -4px;
    left: -4px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--ro-gold) 0%, #b45309 100%);
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 4px 10px rgba(232, 141, 53, 0.35);
    z-index: 2;
    transition: transform 0.3s ease;
}

.process-step-card:hover .step-badge-num {
    transform: scale(1.15) rotate(-6deg);
}

/* Step Tag Under Icon */
.step-meta-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 800;
    color: var(--ro-blue);
    background: var(--ro-blue-light);
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-family: 'Inter', sans-serif;
    transition: all 0.25s;
}

.process-step-card:hover .step-meta-pill {
    background: var(--ro-blue);
    color: #ffffff;
}

.step-meta-pill.heart-pill {
    color: var(--ro-red);
    background: #fef2f2;
}

.process-step-card:hover .step-meta-pill.heart-pill {
    background: var(--ro-red);
    color: #ffffff;
}

.process-step-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-bottom: 10px;
    font-family: 'Nunito', sans-serif;
}

.process-step-desc {
    font-size: 13.5px;
    line-height: 1.6;
    color: var(--ro-text-muted);
    margin: 0;
}

/* Flow Connectors with Stream of Traveling Dots */
.process-flow-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    align-self: center;
    padding: 0 6px;
    margin-top: -36px;
}

.arrow-stream {
    display: flex;
    gap: 5px;
}

.stream-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--ro-blue);
    opacity: 0.25;
}

.stream-dot.d1 { animation: streamDotPulse 1.4s infinite 0s; }
.stream-dot.d2 { animation: streamDotPulse 1.4s infinite 0.25s; }
.stream-dot.d3 { animation: streamDotPulse 1.4s infinite 0.5s; }

@keyframes streamDotPulse {
    0%, 100% { transform: scale(0.8); opacity: 0.2; }
    50% { transform: scale(1.4); opacity: 0.9; background: var(--ro-gold); }
}

.arrow-head {
    font-size: 18px;
    color: var(--ro-blue);
    animation: chevronTravel 1.4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
}

@keyframes chevronTravel {
    0%, 100% { transform: translateX(-3px); opacity: 0.4; }
    50% { transform: translateX(5px); opacity: 1; color: var(--ro-gold); }
}

/* ══ 4. WHY MENTAL HEALTH MATTERS (SPLIT SECTION) ══ */
.ro-why-section {
    padding: 100px 24px;
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.ro-why-container {
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 56px;
    align-items: center;
}

/* Left Photo Box */
.ro-wire-box {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(10, 42, 74, 0.12);
    border: 2px solid #e2e8f0;
    height: 480px;
    width: 100%;
    background: #e2e8f0;
}

.ro-wire-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ro-wire-box:hover img {
    transform: scale(1.04);
}

.why-handwritten-badge {
    position: absolute;
    bottom: 22px;
    left: 22px;
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(10px);
    padding: 10px 20px;
    border-radius: 16px;
    font-size: 20px;
    color: var(--ro-navy);
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.18);
    font-weight: 700;
    transform: rotate(-2deg);
    border: 1px solid rgba(255, 255, 255, 0.6);
    pointer-events: none;
    z-index: 2;
}

.ro-why-content h2 {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: normal;
    color: var(--ro-navy);
    line-height: 1.22;
    margin-bottom: 18px;
}

.ro-why-content p {
    font-size: 16.5px;
    line-height: 1.7;
    color: var(--ro-text-muted);
    margin-bottom: 32px;
}

.why-features-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.why-feat-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    padding: 22px 18px;
    text-align: left;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(10, 42, 74, 0.04);
}

.why-feat-card:hover {
    transform: translateY(-5px);
    border-color: var(--ro-blue);
    box-shadow: 0 14px 30px rgba(24, 75, 137, 0.1);
}

.why-feat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: linear-gradient(135deg, #f0f6ff 0%, #e0edff 100%);
    color: var(--ro-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 14px;
    border: 1.5px solid #dbeafe;
    transition: transform 0.3s ease;
}

.why-feat-card:hover .why-feat-icon {
    transform: scale(1.1);
    border-color: var(--ro-blue);
}

.why-feat-card h4 {
    font-size: 15px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-bottom: 6px;
    font-family: 'Nunito', sans-serif;
}

.why-feat-card p {
    font-size: 13px;
    line-height: 1.5;
    color: var(--ro-text-muted);
    margin: 0;
}

/* ══ 5. WHAT YOUR PURCHASE PROVIDES (INTERACTIVE STEP SHOWCASE) ══ */
.ro-system-section {
    padding: 85px 24px;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    border-top: 1px solid var(--ro-border);
    position: relative;
    overflow: hidden;
}

.ro-system-header {
    max-width: 780px;
    margin: 0 auto 36px auto;
    text-align: center;
}

.ro-system-header .ro-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}

.ro-system-header h2 {
    font-size: clamp(28px, 3.2vw, 40px);
    font-weight: normal;
    color: var(--ro-navy);
    line-height: 1.25;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
}

.ro-system-header p {
    font-size: 15.5px;
    line-height: 1.65;
    color: var(--ro-text-muted);
    max-width: 640px;
    margin: 0 auto;
}

/* Horizontal Step Selector Tabs */
.ro-step-tabs {
    max-width: 860px;
    margin: 0 auto 24px auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    position: relative;
}

.ro-step-tab-btn {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: left;
    position: relative;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
    font-family: inherit;
}

.ro-step-tab-btn:hover {
    border-color: #cbd5e1;
    transform: translateY(-2px);
}

.ro-step-tab-btn .tab-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.25s ease;
}

.ro-step-tab-btn .tab-label {
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.ro-step-tab-btn .tab-tag {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #94a3b8;
    line-height: 1;
    margin-bottom: 2px;
}

.ro-step-tab-btn .tab-name {
    font-size: 13.5px;
    font-weight: 700;
    color: #334155;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Active State for Tabs */
.ro-step-tab-btn.active {
    border-color: var(--ro-blue);
    background: #ffffff;
    box-shadow: 0 6px 20px rgba(24, 75, 137, 0.12);
    transform: translateY(-2px);
}

.ro-step-tab-btn.active[data-theme="blue"] {
    border-color: #2563eb;
}
.ro-step-tab-btn.active[data-theme="blue"] .tab-num {
    background: #eff6ff;
    color: #2563eb;
}
.ro-step-tab-btn.active[data-theme="blue"] .tab-name {
    color: #1e3a8a;
}

.ro-step-tab-btn.active[data-theme="red"] {
    border-color: #dc2626;
}
.ro-step-tab-btn.active[data-theme="red"] .tab-num {
    background: #fef2f2;
    color: #dc2626;
}
.ro-step-tab-btn.active[data-theme="red"] .tab-name {
    color: #991b1b;
}

.ro-step-tab-btn.active[data-theme="amber"] {
    border-color: #d97706;
}
.ro-step-tab-btn.active[data-theme="amber"] .tab-num {
    background: #fffbeb;
    color: #d97706;
}
.ro-step-tab-btn.active[data-theme="amber"] .tab-name {
    color: #92400e;
}

.ro-step-tab-btn.active[data-theme="teal"] {
    border-color: #0284c7;
}
.ro-step-tab-btn.active[data-theme="teal"] .tab-num {
    background: #f0f9ff;
    color: #0284c7;
}
.ro-step-tab-btn.active[data-theme="teal"] .tab-name {
    color: #075985;
}

/* Animated Progress Bar under the Active Tab */
.ro-step-tab-btn {
    overflow: hidden;
}

.ro-step-tab-btn .tab-progress-line {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 0%;
    background: transparent;
    border-radius: 2px;
}

.ro-step-tab-btn.active .tab-progress-line {
    width: 100%;
    background: var(--ro-blue);
    animation: tabFill 3.5s linear forwards;
}

.ro-step-tab-btn.active[data-theme="blue"] .tab-progress-line {
    background: #2563eb;
}

.ro-step-tab-btn.active[data-theme="red"] .tab-progress-line {
    background: #dc2626;
}

.ro-step-tab-btn.active[data-theme="amber"] .tab-progress-line {
    background: #d97706;
}

.ro-step-tab-btn.active[data-theme="teal"] .tab-progress-line {
    background: #0284c7;
}

@keyframes tabFill {
    from { width: 0%; }
    to { width: 100%; }
}

/* The Single Active Showcase Stage */
.ro-showcase-stage {
    max-width: 860px;
    margin: 0 auto;
    position: relative;
    background: #ffffff;
    border: 1.5px solid rgba(226, 232, 240, 0.9);
    border-radius: 24px;
    box-shadow: 0 10px 35px -6px rgba(15, 23, 42, 0.06);
    overflow: hidden;
}

/* Slide Panels (One appears, other disappears) */
.ro-showcase-slide {
    display: none;
    padding: 34px 38px 28px 38px;
    animation: fadeInSlide 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.ro-showcase-slide.active {
    display: block;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ro-slide-content {
    display: grid;
    grid-template-columns: 76px 1fr;
    gap: 26px;
    align-items: start;
}

/* Large Icon Badge on the Left */
.ro-slide-icon-box {
    width: 76px;
    height: 76px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.theme-blue .ro-slide-icon-box {
    background: #eff6ff;
    color: #2563eb;
    border: 1.5px solid #dbeafe;
}

.theme-red .ro-slide-icon-box {
    background: #fef2f2;
    color: #dc2626;
    border: 1.5px solid #fee2e2;
}

.theme-amber .ro-slide-icon-box {
    background: #fffbeb;
    color: #d97706;
    border: 1.5px solid #fef3c7;
}

.theme-teal .ro-slide-icon-box {
    background: #f0f9ff;
    color: #0284c7;
    border: 1.5px solid #bae6fd;
}

/* Text details */
.ro-slide-details {
    display: flex;
    flex-direction: column;
}

.ro-slide-top-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.ro-slide-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    padding: 4px 12px;
    border-radius: 100px;
}

.theme-blue .ro-slide-pill { background: #eff6ff; color: #2563eb; }
.theme-red .ro-slide-pill { background: #fef2f2; color: #dc2626; }
.theme-amber .ro-slide-pill { background: #fffbeb; color: #d97706; }
.theme-teal .ro-slide-pill { background: #f0f9ff; color: #0284c7; }

.ro-slide-step-counter {
    font-size: 13px;
    font-weight: 700;
    color: #94a3b8;
    font-family: 'Inter', sans-serif;
}

.ro-slide-title {
    font-size: 22px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-bottom: 10px;
    letter-spacing: -0.01em;
    font-family: 'Inter', sans-serif;
}

.ro-slide-desc {
    font-size: 15px;
    line-height: 1.7;
    color: #4b5563;
    margin-bottom: 18px;
}

/* Feature tags */
.ro-slide-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.ro-slide-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 5px 12px;
}

.ro-slide-tag i {
    font-size: 11px;
    color: #10b981;
}

/* Showcase Bottom Bar: Controls & Dots */
.ro-showcase-nav-bar {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 12px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.ro-nav-dots {
    display: flex;
    align-items: center;
    gap: 8px;
}

.ro-nav-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #cbd5e1;
    cursor: pointer;
    transition: all 0.25s ease;
    border: none;
    padding: 0;
}

.ro-nav-dot.active {
    width: 24px;
    border-radius: 10px;
    background: var(--ro-blue);
}

.ro-nav-arrows {
    display: flex;
    align-items: center;
    gap: 8px;
}

.ro-nav-arrow-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: var(--ro-navy);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.ro-nav-arrow-btn:hover {
    background: var(--ro-blue);
    color: #ffffff;
    border-color: var(--ro-blue);
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .ro-step-tabs {
        grid-template-columns: repeat(2, 1fr);
    }
    .ro-slide-content {
        grid-template-columns: 1fr;
        gap: 18px;
    }
    .ro-slide-icon-box {
        width: 56px;
        height: 56px;
        font-size: 24px;
    }
    .ro-showcase-slide {
        padding: 24px 20px;
    }
}

/* ══ 6. TRANSPARENCY & ACCOUNTABILITY ══ */
.ro-transparency-section {
    padding: 90px 24px;
    background: #ffffff;
    border-top: 1px solid var(--ro-border);
}

.transparency-grid {
    max-width: 1160px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}

.transparency-card {
    text-align: center;
    padding: 10px 22px;
    position: relative;
}

.transparency-card:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 8px;
    bottom: 8px;
    width: 1px;
    background: var(--ro-border, #e2e8f0);
}

.transparency-icon {
    font-size: 28px;
    color: var(--ro-blue);
    margin-bottom: 14px;
}

.transparency-card h4 {
    font-size: 15.5px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-bottom: 6px;
    font-family: 'Inter', sans-serif;
}

.transparency-card p {
    font-size: 13px;
    line-height: 1.5;
    color: var(--ro-text-muted);
    margin: 0;
}

/* ══ 7. BOTTOM CTA BANNER (FLOATING WHITE CARD) ══ */
.ro-bottom-cta {
    position: relative;
    background: #f8fafc;
    padding: 36px 24px 50px 24px;
    border-top: 1px solid var(--ro-border);
}

.ro-bottom-cta-inner {
    max-width: 1100px;
    margin: 0 auto;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 22px;
    padding: 34px 42px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    position: relative;
    z-index: 2;
    box-shadow: 0 16px 45px -10px rgba(10, 42, 74, 0.10), 0 4px 14px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.ro-bottom-cta-inner:hover {
    box-shadow: 0 20px 50px -10px rgba(10, 42, 74, 0.14), 0 6px 18px rgba(0, 0, 0, 0.04);
}

.cta-compact-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--ro-blue);
    background: var(--ro-blue-light);
    border: 1px solid var(--ro-border-blue);
    padding: 3px 10px;
    border-radius: 100px;
    margin-bottom: 8px;
}

.cta-compact-pill i {
    color: var(--ro-red);
}

.cta-left-text {
    max-width: 640px;
}

.cta-left-text h2 {
    font-size: clamp(21px, 2.2vw, 27px);
    font-weight: normal;
    color: var(--ro-navy);
    margin-bottom: 6px;
    line-height: 1.25;
}

.cta-left-text p {
    font-size: 14.5px;
    color: var(--ro-text-muted);
    line-height: 1.5;
    margin: 0;
}

.cta-right-action {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    flex-shrink: 0;
}

.btn-ro-compact {
    padding: 12px 28px;
    font-size: 14px;
    background: var(--ro-red);
    color: #ffffff;
    border-radius: 50px;
    font-weight: 800;
    box-shadow: 0 6px 18px rgba(192, 57, 43, 0.35);
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-ro-compact:hover {
    background: var(--ro-red-hover);
    color: #ffffff;
    box-shadow: 0 8px 24px rgba(192, 57, 43, 0.45);
    transform: translateY(-2px);
}

.cta-handwritten-badge {
    font-size: 20px;
    color: var(--ro-red);
    line-height: 1.2;
    white-space: nowrap;
}

@media (max-width: 768px) {
    .ro-bottom-cta {
        padding: 24px 16px 36px 16px;
    }
    .ro-bottom-cta-inner {
        flex-direction: column;
        text-align: center;
        padding: 26px 20px;
        gap: 20px;
    }
    .cta-right-action {
        align-items: center;
    }
}

/* ══ CHECKOUT & ORDER MODAL (100% BRANDED, NO WHATSAPP) ══ */
.ro-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(10, 42, 74, 0.82);
    backdrop-filter: blur(6px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.ro-modal-backdrop.open {
    display: flex;
    animation: fadeIn 0.25s ease;
}

.ro-checkout-card {
    background: #ffffff;
    max-width: 580px;
    width: 100%;
    border-radius: 22px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.45);
    overflow: hidden;
    position: relative;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    animation: slideUp 0.3s ease;
}

.roc-header {
    background: linear-gradient(135deg, var(--ro-navy) 0%, var(--ro-blue) 100%);
    color: #ffffff;
    padding: 20px 26px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}

.roc-header h3 {
    font-size: 18px;
    font-weight: 800;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Inter', sans-serif;
}

.btn-close-modal {
    background: rgba(255, 255, 255, 0.18);
    border: none;
    color: #ffffff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
}

.btn-close-modal:hover {
    background: rgba(255, 255, 255, 0.35);
}

.roc-scrollable-body {
    padding: 24px 28px;
    overflow-y: auto;
    scrollbar-width: thin;
}

/* Selected Package Summary Box */
.roc-summary-box {
    background: var(--ro-blue-light);
    border: 1.5px solid var(--ro-border-blue);
    border-radius: 14px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.roc-summary-title {
    font-size: 15px;
    font-weight: 800;
    color: var(--ro-navy);
    font-family: 'Inter', sans-serif;
}

.roc-summary-freq {
    font-size: 12px;
    font-weight: 600;
    color: var(--ro-blue);
}

.roc-summary-price {
    font-size: 24px;
    font-weight: 800;
    color: var(--ro-blue);
    font-family: 'Inter', sans-serif;
}

/* Form Groups */
.roc-form-group {
    margin-bottom: 16px;
}

.roc-form-group label {
    display: block;
    font-size: 12px;
    font-weight: 800;
    color: var(--ro-text-muted);
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-family: 'Inter', sans-serif;
}

.roc-form-group input {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid var(--ro-border);
    border-radius: 10px;
    font-size: 13.5px;
    font-family: inherit;
    color: var(--ro-text);
    outline: none;
    transition: border-color 0.2s;
}

.roc-form-group input:focus {
    border-color: var(--ro-blue);
}

/* Payment Method Tabs */
.roc-pay-tabs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 16px;
}

.roc-pay-tab {
    border: 1.5px solid var(--ro-border);
    background: var(--ro-bg-soft);
    border-radius: 10px;
    padding: 10px;
    font-size: 13px;
    font-weight: 700;
    color: var(--ro-text-muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s;
    font-family: 'Inter', sans-serif;
}

.roc-pay-tab.active {
    background: #ffffff;
    border-color: var(--ro-navy);
    color: var(--ro-navy);
    box-shadow: 0 2px 8px rgba(10, 42, 74, 0.08);
}

/* Bank of Palestine Automatic Gateway Branding */
.bop-gateway-banner {
    background: linear-gradient(135deg, #0a2a4a 0%, #184B89 100%);
    color: #ffffff;
    padding: 13px 18px;
    border-radius: 12px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 14px rgba(10, 42, 74, 0.12);
}

.bop-gateway-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    font-weight: 800;
    font-family: 'Inter', sans-serif;
}

.bop-gateway-title i {
    color: #22c55e;
    font-size: 16px;
}

.bop-gateway-badge {
    font-size: 11px;
    background: rgba(255, 255, 255, 0.18);
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Security & Bank Notice */
.roc-bop-secure-note {
    background: #f0fdf4;
    border: 1.5px solid #bbf7d0;
    border-radius: 10px;
    padding: 11px 14px;
    margin-top: 14px;
    font-size: 12px;
    color: #166534;
    display: flex;
    align-items: flex-start;
    gap: 9px;
    line-height: 1.45;
}

.roc-bop-secure-note i {
    font-size: 15px;
    color: #16a34a;
    margin-top: 1px;
    flex-shrink: 0;
}

/* PalPay Direct Payment Panel */
.roc-palpay-box {
    background: var(--ro-bg-soft);
    border: 1.5px solid var(--ro-border);
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 16px;
    text-align: center;
}

.roc-palpay-box p {
    font-size: 13px;
    color: var(--ro-text-muted);
    margin-bottom: 14px;
    line-height: 1.5;
}

.roc-palpay-input-wrap {
    max-width: 320px;
    margin: 0 auto;
}

/* Card Mockup Form */
.roc-card-fields {
    background: var(--ro-bg-soft);
    border: 1.5px solid var(--ro-border);
    border-radius: 12px;
    padding: 14px;
    margin-bottom: 16px;
}

.roc-card-row {
    margin-bottom: 10px;
}

.roc-card-inline {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.btn-submit-purchase {
    width: 100%;
    background: var(--ro-red);
    color: #ffffff;
    border: none;
    border-radius: 50px;
    padding: 15px;
    font-size: 15.5px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(192, 57, 43, 0.35);
    font-family: 'Inter', sans-serif;
}

.btn-submit-purchase:hover {
    background: var(--ro-red-hover);
    box-shadow: 0 6px 20px rgba(192, 57, 43, 0.45);
}

/* ══ RECEIPT CONFIRMATION VIEW ══ */
.receipt-card-view {
    padding: 30px 24px;
    text-align: center;
}

.rc-check-icon {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: #22c55e;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin: 0 auto 16px auto;
}

.rc-view-title {
    font-size: 22px;
    font-weight: normal;
    color: var(--ro-navy);
    margin-bottom: 4px;
}

.rc-view-sub {
    font-size: 13.5px;
    color: var(--ro-text-muted);
    margin-bottom: 22px;
}

.rc-invoice-slip {
    background: var(--ro-bg-soft);
    border: 1px dashed var(--ro-border-blue);
    border-radius: 12px;
    padding: 16px;
    text-align: left;
    margin-bottom: 20px;
    font-size: 13px;
}

.rc-slip-row {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px solid #f1f5f9;
}

.rc-slip-row:last-child {
    border-bottom: none;
    padding-top: 10px;
    font-weight: 800;
    font-size: 15px;
    color: var(--ro-navy);
}

.rc-slip-lbl {
    color: var(--ro-text-light);
}

.rc-slip-val {
    font-weight: 700;
    color: var(--ro-navy);
}

/* Custom Amount Modal Styles */
.ro-custom-presets {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin-bottom: 22px;
    flex-wrap: wrap;
}

.ro-preset-btn {
    border: 1.5px solid var(--ro-border);
    background: #f8fafc;
    color: var(--ro-navy);
    border-radius: 50px;
    padding: 8px 18px;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'Inter', sans-serif;
}

.ro-preset-btn:hover {
    border-color: var(--ro-blue);
    background: var(--ro-blue-light);
    color: var(--ro-blue);
}

.ro-preset-btn.active {
    background: var(--ro-blue);
    border-color: var(--ro-blue);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(24, 75, 137, 0.25);
}

.ro-custom-input-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 2px solid var(--ro-border);
    border-radius: 16px;
    padding: 10px 20px;
    margin-bottom: 16px;
    transition: all 0.2s;
}

.ro-custom-input-wrap:focus-within {
    border-color: var(--ro-blue);
    box-shadow: 0 0 0 4px rgba(24, 75, 137, 0.1);
}

.ro-currency-symbol {
    font-size: 28px;
    font-weight: 800;
    color: var(--ro-navy);
    margin-right: 6px;
    font-family: 'Inter', sans-serif;
}

#customAmountInput {
    border: none;
    outline: none;
    font-size: 38px;
    font-weight: 800;
    color: var(--ro-navy);
    width: 140px;
    text-align: center;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-variant-numeric: tabular-nums lining-nums;
    background: transparent;
    direction: ltr;
}

#customAmountInput::-webkit-outer-spin-button,
#customAmountInput::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

#customAmountInput[type=number] {
  -moz-appearance: textfield;
}

.ro-currency-code {
    font-size: 14px;
    font-weight: 800;
    color: var(--ro-text-light);
    margin-left: 6px;
    font-family: 'Inter', sans-serif;
}

.ro-custom-impact-pill {
    background: #f0fdf4;
    border: 1.5px solid #bbf7d0;
    border-radius: 50px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    color: #166534;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-align: center;
    font-family: 'Inter', sans-serif;
}

/* Modal Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ══ RESPONSIVE BREAKPOINTS ══ */
@media (max-width: 1024px) {
    .ro-hero-container {
        grid-template-columns: 1fr;
        text-align: center;
    }
    .ro-hero-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .ro-hero-desc {
        margin-left: auto;
        margin-right: auto;
    }
    .ro-hero-trust-row {
        justify-content: center;
    }
    .ro-hero-cta-group {
        align-items: center;
    }
    .ro-hero-services-wire-box {
        max-width: 480px;
        margin: 30px auto 0 auto;
    }
    .ro-hero-img-wrap {
        max-width: 550px;
        margin: 0 auto;
    }
    .ro-packages-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .ro-process-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .process-track-line {
        display: none;
    }
    .process-flow-arrow {
        transform: rotate(90deg);
        margin: 0 auto;
    }
    .ro-why-container {
        grid-template-columns: 1fr;
    }
    .transparency-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px 0;
    }
    .transparency-card:nth-child(2n)::after {
        display: none;
    }
    .ro-bottom-cta-inner {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    .cta-right-action {
        align-items: center;
    }
    .cta-left-text p {
        margin: 0 auto;
    }
}

@media (max-width: 860px) {
    .ro-hero-section {
        margin-top: 72px;
    }
}

@media (max-width: 640px) {
    .ro-hero-section {
        padding: 50px 16px 50px 16px;
    }
    .ro-hero-trust-row {
        grid-template-columns: 1fr;
        width: 100%;
        max-width: 340px;
        margin-left: auto;
        margin-right: auto;
    }
    .ro-trust-pill {
        width: 100%;
        justify-content: flex-start;
        text-align: left;
    }
    .ro-hero-overlay {
        background: linear-gradient(
            180deg,
            rgba(10, 24, 42, 0.5) 0%,
            rgba(10, 24, 42, 0.85) 45%,
            rgba(10, 24, 42, 0.96) 100%
        );
    }
    .ro-packages-grid {
        grid-template-columns: 1fr;
    }
    .why-features-row {
        grid-template-columns: 1fr;
    }
    .ro-system-grid {
        grid-template-columns: 1fr;
    }
    .transparency-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    .transparency-card {
        padding: 8px 12px;
    }
    .transparency-card::after {
        display: none;
    }
    .roc-scrollable-body {
        padding: 18px;
    }
}
</style>
@endsection

@section('content')
<!-- ═════════════════════════════════════════════════════════════
     1. HERO SECTION (REACHOUT BRANDING & WIRE MOTIF)
═════════════════════════════════════════════════════════════ -->
<section class="ro-hero-section">
    <!-- Full Background Image using uploaded hero_girl_wide.jpg (Girl on Left, Text on Right) -->
    <div class="ro-hero-bg-layer">
        <img src="{{ asset('reachout/img/hero_girl_wide.jpg') }}" alt="Mental Health Frontline Support" class="ro-hero-bg-img">
        <div class="ro-hero-overlay"></div>
    </div>

    <div class="ro-hero-container">
        <!-- Content written over the photo with optimal contrast & flow -->
        <div class="ro-hero-content">

            <h2 class="ro-hero-title font-display">
                Purchase a <span class="ro-highlight-red">Psychological Consultation</span><br>
                for Someone in <span class="ro-highlight-blue">Gaza</span>
            </h2>

            <p class="ro-hero-desc">
                Your purchase provides children and families in Gaza who have experienced trauma with direct access to free mental health consultations and psychosocial support.
            </p>

            <!-- Frontline Trust Micro-Cards -->
            <div class="ro-hero-trust-row">
                <div class="ro-trust-pill">
                    <i class="fas fa-user-shield"></i>
                    <div class="ro-trust-pill-text">
                        <strong>100% Confidential</strong>
                        <span>Safe, private sessions</span>
                    </div>
                </div>
                <div class="ro-trust-pill">
                    <i class="fas fa-stethoscope"></i>
                    <div class="ro-trust-pill-text">
                        <strong>Qualified Therapists</strong>
                        <span>Compassionate support</span>
                    </div>
                </div>
                <div class="ro-trust-pill">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <div class="ro-trust-pill-text">
                        <strong>Easy to Access</strong>
                        <span>Support a click away</span>
                    </div>
                </div>
            </div>

            <div class="ro-hero-cta-group">
                <a href="#packages" class="btn-ro-primary">
                    <span>Choose a Consultation Package</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <div class="ro-hero-cta-meta">
                    <i class="fas fa-shield-halved"></i> Direct service fee sponsorship · Starting from $5 · 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     2. CHOOSE YOUR CONSULTATION PACKAGE
═════════════════════════════════════════════════════════════ -->
<section class="ro-packages-section" id="packages">
    <div class="ro-section-header">
        <span class="ro-eyebrow">Choose Your Consultation Package</span>
        <h2 class="ro-section-title font-display">Select a package that fits <span class="">your support</span></h2>
        <p class="ro-section-sub">Every package directly sponsors accredited psychological first aid and counseling delivered by local clinicians.</p>
    </div>

    <!-- Frequency Switcher -->
    <div class="ro-freq-wrapper">
        <div class="ro-freq-toggle" id="roFreqToggle">
            <button type="button" class="ro-freq-btn" id="btn-freq-onetime" onclick="setFreq('onetime')">
                <i class="fas fa-bolt"></i> One-time purchase
            </button>
            <button type="button" class="ro-freq-btn active" id="btn-freq-monthly" onclick="setFreq('monthly')">
                <i class="fas fa-arrows-rotate"></i> Monthly support
                <span class="freq-badge-heart"><i class="fas fa-heart"></i> Sustained</span>
            </button>
        </div>
        <div class="ro-freq-subhint" id="roFreqSubhint">
            <i class="fas fa-arrows-rotate" style="color: var(--ro-blue);"></i>
            <span><strong>Monthly Sustained Care:</strong> Recurring grant providing continuous therapy every month. Cancel anytime.</span>
        </div>
    </div>

    <!-- 4 Cards Grid -->
    <div class="ro-packages-grid">
        <!-- Card 1: 1 Consultation -->
        <div class="ro-pkg-card" style="--i: 0;">
            <div class="pkg-icon-circle">
                <i class="fas fa-user"></i>
            </div>
            <div class="pkg-consultations">1 Consultation</div>
            <div class="pkg-price-row">
                <div class="pkg-price">$5</div>
                <span class="pkg-period">/ month</span>
            </div>
            <span class="pkg-freq-pill"><i class="fas fa-arrows-rotate"></i> Monthly Grant</span>
            <button type="button" class="btn-pkg-buy" id="btn-pkg-1" onclick="openCheckoutModal(1, 5, '1 Consultation')">
                <span>Sponsor 1 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>
            </button>
        </div>

        <!-- Card 2: 5 Consultations -->
        <div class="ro-pkg-card" style="--i: 1;">
            <div class="pkg-icon-circle">
                <i class="fas fa-users"></i>
            </div>
            <div class="pkg-consultations">5 Consultations</div>
            <div class="pkg-price-row">
                <div class="pkg-price">$25</div>
                <span class="pkg-period">/ month</span>
            </div>
            <span class="pkg-freq-pill"><i class="fas fa-arrows-rotate"></i> Monthly Grant</span>
            <button type="button" class="btn-pkg-buy" id="btn-pkg-2" onclick="openCheckoutModal(5, 25, '5 Consultations')">
                <span>Sponsor 5 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>
            </button>
        </div>

        <!-- Card 3: 10 Consultations -->
        <div class="ro-pkg-card" style="--i: 2;">
            <div class="pkg-icon-circle">
                <i class="fas fa-user-group"></i>
            </div>
            <div class="pkg-consultations">10 Consultations</div>
            <div class="pkg-price-row">
                <div class="pkg-price">$50</div>
                <span class="pkg-period">/ month</span>
            </div>
            <span class="pkg-freq-pill"><i class="fas fa-arrows-rotate"></i> Monthly Grant</span>
            <button type="button" class="btn-pkg-buy" id="btn-pkg-3" onclick="openCheckoutModal(10, 50, '10 Consultations')">
                <span>Sponsor 10 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>
            </button>
        </div>

        <!-- Card 4: 20 Consultations (Featured) -->
        <div class="ro-pkg-card featured" style="--i: 3;">
            <span class="featured-ribbon">Most Impactful</span>
            <div class="pkg-icon-circle" style="background: var(--ro-blue); color: #ffffff;">
                <i class="fas fa-people-roof"></i>
            </div>
            <div class="pkg-consultations">20 Consultations</div>
            <div class="pkg-price-row">
                <div class="pkg-price">$90</div>
                <span class="pkg-period">/ month</span>
            </div>
            <span class="pkg-save-badge">Save $10</span>
            <button type="button" class="btn-pkg-buy" id="btn-pkg-4" onclick="openCheckoutModal(20, 90, '20 Consultations')">
                <span>Sponsor 20 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>
            </button>
        </div>
    </div>

    <!-- Custom Amount Option -->
    <div class="ro-custom-bar">
        <span>Looking to sponsor an institutional or custom grant?</span>
        <a class="ro-custom-btn-link" onclick="openCustomCheckout()">Enter Custom Amount &rarr;</a>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     3. HOW YOUR PURCHASE BECOMES CARE (DYNAMIC PROCESS)
═════════════════════════════════════════════════════════════ -->
<section class="ro-process-section" id="process">
    <div class="ro-section-header">
        <span class="ro-eyebrow">How Your Purchase Becomes Care</span>
        <h2 class="ro-section-title font-display">From your support to their care</h2>
        <p class="ro-section-sub">A transparent, fully automated journey delivering accredited psychological support directly to individuals and families in Gaza.</p>
    </div>

    <!-- Process Flow Wrapper with Dynamic Energy Track -->
    <div class="ro-process-wrapper">
        <!-- Connecting Energy Track (Behind cards) -->
        <div class="process-track-line">
            <div class="process-pulse-beam"></div>
        </div>

        <div class="ro-process-grid">
            <!-- Step 1 -->
            <div class="process-step-card" data-step="1">
                <div class="process-icon-wrap">
                    <span class="step-badge-num">1</span>
                    <i class="fas fa-credit-card icon-step-1"></i>
                    <div class="icon-radar-ping"></div>
                </div>
                <span class="step-meta-pill"><i class="fas fa-bolt"></i> Instant Sponsorship</span>
                <h3 class="process-step-title">Choose a Package</h3>
                <p class="process-step-desc">Select the number of consultations and complete your direct purchase securely via Bank of Palestine gateway.</p>
            </div>

            <!-- Flow Connector 1 -->
            <div class="process-flow-arrow">
                <div class="arrow-stream">
                    <span class="stream-dot d1"></span>
                    <span class="stream-dot d2"></span>
                    <span class="stream-dot d3"></span>
                </div>
                <i class="fas fa-chevron-right arrow-head"></i>
            </div>

            <!-- Step 2 -->
            <div class="process-step-card" data-step="2">
                <div class="process-icon-wrap">
                    <span class="step-badge-num">2</span>
                    <i class="fas fa-brain icon-step-2"></i>
                    <div class="icon-radar-ping"></div>
                </div>
                <span class="step-meta-pill"><i class="fas fa-brain icon-step-2"></i> QUALIFIED THERAPISTS</span>
                <h3 class="process-step-title">We Arrange the Care</h3>
                <p class="process-step-desc">Your purchase helps children and families in Gaza access free mental health consultations and psychosocial support from qualified therapists</p>
            </div>

            <!-- Flow Connector 2 -->
            <div class="process-flow-arrow">
                <div class="arrow-stream">
                    <span class="stream-dot d1"></span>
                    <span class="stream-dot d2"></span>
                    <span class="stream-dot d3"></span>
                </div>
                <i class="fas fa-chevron-right arrow-head"></i>
            </div>

            <!-- Step 3 -->
            <div class="process-step-card featured-step" data-step="3">
                <div class="process-icon-wrap">
                    <span class="step-badge-num">3</span>
                    <i class="fas fa-hand-holding-heart icon-step-3"></i>
                    <div class="icon-radar-ping"></div>
                </div>
                <span class="step-meta-pill heart-pill"><i class="fas fa-heart"></i> Direct Healing Impact</span>
                <h3 class="process-step-title">They Receive Care</h3>
                <p class="process-step-desc">The person in need receives a confidential psychological consultation, crisis intake, and ongoing emotional support</p>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     4. WHY MENTAL HEALTH SUPPORT MATTERS IN CONFLICT
═════════════════════════════════════════════════════════════ -->
<section class="ro-why-section">
    <div class="ro-why-container">
        <!-- Left Image with Reachout visual frame -->
        <div class="ro-wire-box">
            <img src="{{ asset('reachout/img/imageser.jpg') }}" alt="Children in Gaza supported by mental health care">
            <div class="why-handwritten-badge font-script">
                Protection, Healing & Hope. <i class="fas fa-heart" style="color: #ef4444; font-size: 11px; margin-left: 3px;"></i>
            </div>
        </div>

        <!-- Right Text & 3 Pillars -->
        <div class="ro-why-content">
            <span class="ro-eyebrow">Why Mental Health Support Matters</span>
            <h2 class="font-display">Mental health is an essential part of <span class="">humanitarian care</span></h2>
            <p>
                People affected by war, displacement and ongoing crisis experience deep fear, grief, and emotional distress. Accessible mental health support helps children and families cope, regain emotional stability, and find safe paths to recovery.
            </p>

            <div class="why-features-row">
                <div class="why-feat-card">
                    <div class="why-feat-icon"><i class="fas fa-shield-halved"></i></div>
                    <h4>Immediate Support</h4>
                    <p>Timely access to professional trauma care and crisis first-aid.</p>
                </div>
                <div class="why-feat-card">
                    <div class="why-feat-icon"><i class="fas fa-user-shield"></i></div>
                    <h4>Confidential Care</h4>
                    <p>A safe, ethical, and fully confidential space for every person.</p>
                </div>
                <div class="why-feat-card">
                    <div class="why-feat-icon"><i class="fas fa-people-roof"></i></div>
                    <h4>Easy To Access</h4>
                    <p>Connect with qualified therapists through online consultations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     5. WHAT YOUR PURCHASE PROVIDES (INTERACTIVE STEP SHOWCASE)
═════════════════════════════════════════════════════════════ -->
<section class="ro-system-section" id="purchaseSystemSection">
    <!-- Centered Distinct Section Header -->
    <div class="ro-system-header">
        <span class="ro-eyebrow"><i class="fas fa-hand-holding-heart"></i> What Your Purchase Provides</span>
        <h2 class="font-display">More than a consultation — a <span class="ro-highlight-red">comprehensive support</span> system</h2>
        <p>Your sponsorship funds an integrated circle of care. Tap through the stages below to see how each consultation creates lasting recovery.</p>
    </div>

    <!-- Step Selector Tabs (4 Tabs connected horizontally) -->
    <div class="ro-step-tabs">
        <button type="button" class="ro-step-tab-btn active" data-step="0" data-theme="blue" onclick="switchShowcaseStep(0, true)">
            <span class="tab-num">01</span>
            <div class="tab-label">
                <span class="tab-tag">Intake</span>
                <span class="tab-name">Consultation</span>
            </div>
            <span class="tab-progress-line"></span>
        </button>
        <button type="button" class="ro-step-tab-btn" data-step="1" data-theme="red" onclick="switchShowcaseStep(1, true)">
            <span class="tab-num">02</span>
            <div class="tab-label">
                <span class="tab-tag">Coping</span>
                <span class="tab-name">Psychosocial</span>
            </div>
            <span class="tab-progress-line"></span>
        </button>
        <button type="button" class="ro-step-tab-btn" data-step="2" data-theme="amber" onclick="switchShowcaseStep(2, true)">
            <span class="tab-num">03</span>
            <div class="tab-label">
                <span class="tab-tag">Resilience</span>
                <span class="tab-name">Family Guidance</span>
            </div>
            <span class="tab-progress-line"></span>
        </button>
        <button type="button" class="ro-step-tab-btn" data-step="3" data-theme="teal" onclick="switchShowcaseStep(3, true)">
            <span class="tab-num">04</span>
            <div class="tab-label">
                <span class="tab-tag">Network</span>
                <span class="tab-name">Referral Care</span>
            </div>
            <span class="tab-progress-line"></span>
        </button>
    </div>

    <!-- The Single Active Showcase Stage (One appears, others disappear) -->
    <div class="ro-showcase-stage" id="roShowcaseStage">
        <!-- Slide 0: Psychological Consultation -->
        <div class="ro-showcase-slide active theme-blue" data-index="0">
            <div class="ro-slide-content">
                <div class="ro-slide-icon-box">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="ro-slide-details">
                    <div class="ro-slide-top-meta">
                        <span class="ro-slide-pill"><i class="fas fa-circle-check"></i> Clinical Intake</span>
                        <span class="ro-slide-step-counter">Stage 01 of 04</span>
                    </div>
                    <h3 class="ro-slide-title">Psychological Consultation</h3>
                    <p class="ro-slide-desc">Direct confidential intake and clinical evaluation conducted by accredited Gaza-based mental health clinicians, focusing on acute trauma triage and immediate emotional stabilization.</p>
                    <div class="ro-slide-tags">
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Accredited Gaza Clinicians</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> 100% Confidential Space</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Acute Trauma Triage</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 1: Psychosocial Support -->
        <div class="ro-showcase-slide theme-red" data-index="1">
            <div class="ro-slide-content">
                <div class="ro-slide-icon-box">
                    <i class="fas fa-shield-heart"></i>
                </div>
                <div class="ro-slide-details">
                    <div class="ro-slide-top-meta">
                        <span class="ro-slide-pill"><i class="fas fa-circle-check"></i> Emotional Coping</span>
                        <span class="ro-slide-step-counter">Stage 02 of 04</span>
                    </div>
                    <h3 class="ro-slide-title">Psychosocial Support & Coping</h3>
                    <p class="ro-slide-desc">Practical psychoeducational coping tools, panic de-escalation methods, and targeted support designed to help children and adults manage acute distress in crisis environments.</p>
                    <div class="ro-slide-tags">
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Panic De-escalation</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Child-Friendly Techniques</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Practical Stress Tools</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: Caregiver Guidance -->
        <div class="ro-showcase-slide theme-amber" data-index="2">
            <div class="ro-slide-content">
                <div class="ro-slide-icon-box">
                    <i class="fas fa-people-roof"></i>
                </div>
                <div class="ro-slide-details">
                    <div class="ro-slide-top-meta">
                        <span class="ro-slide-pill"><i class="fas fa-circle-check"></i> Household Healing</span>
                        <span class="ro-slide-step-counter">Stage 03 of 04</span>
                    </div>
                    <h3 class="ro-slide-title">Caregiver & Family Guidance</h3>
                    <p class="ro-slide-desc">Dedicated guidance for parents and caregivers to recognize trauma symptoms in their children, rebuild safety routines, and maintain household emotional stability amidst ongoing displacement.</p>
                    <div class="ro-slide-tags">
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Parental Trauma Guidance</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Rebuilding Daily Safety</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Family Emotional Health</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Referral Care -->
        <div class="ro-showcase-slide theme-teal" data-index="3">
            <div class="ro-slide-content">
                <div class="ro-slide-icon-box">
                    <i class="fas fa-arrows-split-up-and-left"></i>
                </div>
                <div class="ro-slide-details">
                    <div class="ro-slide-top-meta">
                        <span class="ro-slide-pill"><i class="fas fa-circle-check"></i> CONTINUITY OF CARE</span>
                        <span class="ro-slide-step-counter">Stage 04 of 04</span>
                    </div>
                    <h3 class="ro-slide-title">Referral & Specialized Care</h3>
                    <p class="ro-slide-desc">When a person’s needs go beyond the scope of remote psychological support, we identify the appropriate next level of care and facilitate referral whenever suitable services are accessible.</p>
                    <div class="ro-slide-tags">
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Needs-Based Referral</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Safeguarding Pathways</span>
                        <span class="ro-slide-tag"><i class="fas fa-check"></i> Follow-Up When Appropriate</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Showcase Bottom Control Bar -->
        <div class="ro-showcase-nav-bar">
            <!-- Nav Dots -->
            <div class="ro-nav-dots" id="roNavDots">
                <button type="button" class="ro-nav-dot active" onclick="switchShowcaseStep(0)" aria-label="Step 1"></button>
                <button type="button" class="ro-nav-dot" onclick="switchShowcaseStep(1)" aria-label="Step 2"></button>
                <button type="button" class="ro-nav-dot" onclick="switchShowcaseStep(2)" aria-label="Step 3"></button>
                <button type="button" class="ro-nav-dot" onclick="switchShowcaseStep(3)" aria-label="Step 4"></button>
            </div>

            <!-- Arrows -->
            <div class="ro-nav-arrows">
                <button type="button" class="ro-nav-arrow-btn" onclick="stepPrevShowcase()" aria-label="Previous step">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="ro-nav-arrow-btn" onclick="stepNextShowcase()" aria-label="Next step">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     6. TRANSPARENCY & ACCOUNTABILITY
═════════════════════════════════════════════════════════════ -->
<section class="ro-transparency-section">
    <div class="ro-section-header">
        <span class="ro-eyebrow">Your Support, Our Responsibility</span>
        <h2 class="ro-section-title font-display">Transparency & Accountability</h2>
        <p class="ro-section-sub">MHF is committed to using resources responsibly and delivering services with confidentiality, safeguarding and professional standards.</p>
    </div>

    <div class="transparency-grid">
        <div class="transparency-card">
            <div class="transparency-icon"><i class="fas fa-coins"></i></div>
            <h4>Responsible Use of Funds</h4>
            <p>Resources are directed strictly to clinical service delivery and essential field operations.</p>
        </div>

        <div class="transparency-card">
            <div class="transparency-icon"><i class="fas fa-user-lock"></i></div>
            <h4>Confidentiality</h4>
            <p>Beneficiary information is handled with strict privacy protocols and ethical guidelines.</p>
        </div>

        <div class="transparency-card">
            <div class="transparency-icon"><i class="fas fa-shield-heart"></i></div>
            <h4>Safeguarding</h4>
            <p>Services are delivered with child safeguarding principles at the core of all interventions.</p>
        </div>

        <div class="transparency-card">
            <div class="transparency-icon"><i class="fas fa-award"></i></div>
            <h4>Professional Standards</h4>
            <p>Support is provided exclusively by certified and vetted MHPSS clinicians.</p>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     7. BOTTOM CTA BANNER (REACHOUT BRANDED - SLIM & COMPACT)
═════════════════════════════════════════════════════════════ -->
<section class="ro-bottom-cta">
    <div class="ro-bottom-cta-inner">
        <div class="cta-left-text">
            <span class="cta-compact-pill"><i class="fas fa-heart"></i> Make a Difference</span>
            <h2 class="font-display">Help Someone Access Mental Health Support</h2>
            <p>Choose a consultation package and help make professional care accessible to someone affected by crisis.</p>
        </div>
        <div class="cta-right-action">
            <a href="#packages" class="btn-ro-primary btn-ro-compact">
                Choose a Package <i class="fas fa-arrow-right"></i>
            </a>
            <div class="cta-handwritten-badge font-script">
                Real support. Lasting impact. <i class="fas fa-heart" style="color: #ef4444; font-size: 11px; margin-left: 3px;"></i>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════
     9. CHECKOUT & ORDER MODAL (100% COMPLIANT, NO WHATSAPP)
═════════════════════════════════════════════════════════════ -->
<div class="ro-modal-backdrop" id="checkoutModal">
    <div class="ro-checkout-card">
        <!-- Header -->
        <div class="roc-header">
            <h3><i class="fas fa-shield-halved"></i> Purchase Consultations</h3>
            <button type="button" class="btn-close-modal" onclick="closeCheckoutModal()">&times;</button>
        </div>

        <!-- Scrollable Form Body -->
        <div class="roc-scrollable-body" id="checkoutFormContent">
            <!-- Selected Package Summary -->
            <div class="roc-summary-box">
                <div>
                    <div class="roc-summary-title" id="summaryPkgTitle">3 Consultations Package</div>
                    <div class="roc-summary-freq" id="summaryFreqTitle">One-Time Service Purchase</div>
                </div>
                <div class="roc-summary-price" id="summaryPkgPrice">$25.00</div>
            </div>

            <!-- Purchaser Info -->
            <div class="roc-form-group">
                <label>Your Full Name *</label>
                <input type="text" id="custName" placeholder="e.g. John Doe" required>
            </div>

            <div class="roc-form-group">
                <label>Email Address (for service invoice & receipt) *</label>
                <input type="email" id="custEmail" placeholder="e.g. john@example.com" required>
            </div>

            <!-- Payment Method Selector -->
            <div class="roc-form-group">
                <label>Payment Method</label>
                <div class="roc-pay-tabs">
                    <button type="button" class="roc-pay-tab active" id="tab-pay-card" onclick="switchModalPay('card')">
                        <i class="fas fa-credit-card"></i> Credit / Debit Card
                    </button>
                    <button type="button" class="roc-pay-tab" id="tab-pay-palpay" onclick="switchModalPay('palpay')">
                        <i class="fas fa-wallet"></i> PalPay / BOP Wallet
                    </button>
                </div>
            </div>

            <!-- Panel 1: Bank of Palestine Direct Card Gateway -->
            <div id="panel-card-form" class="roc-card-fields">
                <div class="roc-card-row">
                    <label style="display:block; font-size:11px; font-weight:700; color:var(--ro-text-muted); margin-bottom:5px; text-transform:uppercase;">Card Number</label>
                    <div style="position: relative;">
                        <input type="text" id="ccNumber" placeholder="4000 1234 5678 9010" maxlength="19" oninput="formatCC(this)" style="padding-right: 90px;">
                        <div style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); display: flex; gap: 6px; font-size: 18px; color: #64748b;">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                        </div>
                    </div>
                </div>
                <div class="roc-card-inline">
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; color:var(--ro-text-muted); margin-bottom:5px; text-transform:uppercase;">Expiry</label>
                        <input type="text" id="ccExp" placeholder="MM / YY" maxlength="5" oninput="formatExp(this)">
                    </div>
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; color:var(--ro-text-muted); margin-bottom:5px; text-transform:uppercase;">CVV / CVC</label>
                        <input type="text" id="ccCvc" placeholder="123" maxlength="4">
                    </div>
                </div>
                <div class="roc-bop-secure-note">
                    <i class="fas fa-shield-halved"></i>
                    <div>
                        <strong>Bank of Palestine 3D Secure:</strong> Automated direct settlement. Transaction is billed as a <em>Psychological Consultation Service Fee</em>.
                    </div>
                </div>
            </div>

            <!-- Panel 2: PalPay / Bank of Palestine Digital Wallet -->
            <div id="panel-palpay-form" class="roc-palpay-box" style="display: none;">
                <div style="font-size: 32px; color: var(--ro-blue); margin-bottom: 8px;">
                    <i class="fas fa-mobile-screen-button"></i>
                </div>
                <h4 style="font-size: 15px; font-weight: 800; color: var(--ro-navy); margin-bottom: 6px;">PalPay · Bank of Palestine Digital Wallet</h4>
                <p style="font-size: 12.5px; color: var(--ro-text-muted); margin-bottom: 14px; line-height: 1.5;">
                    Pay instantly using your PalPay mobile app or Bank of Palestine digital wallet. Enter your registered mobile number or PalPay ID to authorize the direct service settlement.
                </p>
                <div class="roc-palpay-input-wrap">
                    <input type="text" id="palpayId" placeholder="059XXXXXXX or PalPay ID" style="text-align: center; font-weight: 700; font-size: 14px; letter-spacing: 0.5px; padding: 11px 14px; border: 1.5px solid var(--ro-border); border-radius: 10px; width: 100%; outline: none;">
                </div>
                <div class="roc-bop-secure-note" style="margin-top: 14px;">
                    <i class="fas fa-bolt" style="color: var(--ro-gold);"></i>
                    <div>
                        <strong>Instant Automated Debit:</strong> An approval request will be sent to your PalPay mobile application immediately.
                    </div>
                </div>
            </div>

            <!-- Submit Button (100% AUTOMATED, NO WHATSAPP, NO MANUAL WIRE) -->
            <button type="button" class="btn-submit-purchase" id="btnSubmitOrder" onclick="completeOrder()">
                <i class="fas fa-lock"></i>
                <span id="btnSubmitText">Pay $25.00 via Bank of Palestine Gateway</span>
            </button>

            <div style="font-size: 11px; color: var(--ro-text-light); text-align: center; margin-top: 12px; line-height: 1.4;">
                <i class="fas fa-shield-check" style="color: #16a34a;"></i> 100% automated bank settlement. Official invoice and transaction receipt issued upon completion.
            </div>
        </div>

        <!-- Receipt / Confirmation Success View -->
        <div id="checkoutSuccessView" class="receipt-card-view" style="display: none;">
            <div class="rc-check-icon">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="rc-view-title font-display">Order Confirmed!</h3>
            <p class="rc-view-sub">Thank you for funding psychological care for someone in Gaza.</p>

            <div class="rc-invoice-slip">
                <div class="rc-slip-row">
                    <span class="rc-slip-lbl">Invoice / Ref</span>
                    <span class="rc-slip-val" id="rcSlipRef">MHF-INV-2026-77891</span>
                </div>
                <div class="rc-slip-row">
                    <span class="rc-slip-lbl">Service</span>
                    <span class="rc-slip-val" id="rcSlipService">5 Psychological Consultations</span>
                </div>
                <div class="rc-slip-row">
                    <span class="rc-slip-lbl">Customer</span>
                    <span class="rc-slip-val" id="rcSlipCustomer">John Doe</span>
                </div>
                <div class="rc-slip-row">
                    <span class="rc-slip-lbl">Payment Mode</span>
                    <span class="rc-slip-val" id="rcSlipMethod">Credit Card</span>
                </div>
                <div class="rc-slip-row">
                    <span class="rc-slip-lbl">Total Paid</span>
                    <span class="rc-slip-val" id="rcSlipTotal">$25.00 USD</span>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-pkg-buy" style="background: #ffffff; color: var(--ro-navy); border: 1.5px solid var(--ro-navy);" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
                <button type="button" class="btn-pkg-buy" style="background: var(--ro-blue);" onclick="closeCheckoutModal()">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ═════════════════════════════════════════════════════════════
     CUSTOM AMOUNT MODAL (REPLACES BROWSER PROMPT)
═════════════════════════════════════════════════════════════ -->
<div class="ro-modal-backdrop" id="customAmountModal">
    <div class="ro-checkout-card" style="max-width: 480px;">
        <!-- Header -->
        <div class="roc-header">
            <h3><i class="fas fa-hand-holding-dollar"></i> Custom Consultation Grant</h3>
            <button type="button" class="btn-close-modal" onclick="closeCustomAmountModal()">&times;</button>
        </div>

        <div class="roc-scrollable-body" style="padding: 26px 28px;">
            <p style="font-size: 13.5px; color: var(--ro-text-muted); margin-bottom: 20px; line-height: 1.5; text-align: center;">
                Select a quick preset or enter any custom contribution to sponsor mental health care sessions in Gaza.
            </p>

            <!-- Quick Preset Chips -->
            <div class="ro-custom-presets">
                <button type="button" class="ro-preset-btn active" onclick="selectPresetAmount(50)">$50</button>
                <button type="button" class="ro-preset-btn" onclick="selectPresetAmount(100)">$100</button>
                <button type="button" class="ro-preset-btn" onclick="selectPresetAmount(150)">$150</button>
                <button type="button" class="ro-preset-btn" onclick="selectPresetAmount(250)">$250</button>
                <button type="button" class="ro-preset-btn" onclick="selectPresetAmount(500)">$500</button>
            </div>

            <!-- Currency Input Box -->
            <div class="ro-custom-input-wrap">
                <span class="ro-currency-symbol">$</span>
                <input type="text" inputmode="numeric" id="customAmountInput" value="50" dir="ltr" lang="en" oninput="formatCustomInput(this)">
                <span class="ro-currency-code">USD</span>
            </div>

            <!-- Dynamic Impact Notice -->
            <div class="ro-custom-impact-pill" id="customImpactNotice">
                <i class="fas fa-sparkles" style="color: var(--ro-gold);"></i>
                <span>Sponsors approximately <strong>10</strong> psychological consultations</span>
            </div>

            <!-- Action Button -->
            <button type="button" class="btn-submit-purchase" style="margin-top: 22px; background: var(--ro-blue);" onclick="proceedCustomAmount()">
                Continue to Checkout <i class="fas fa-arrow-right" style="margin-left: 6px;"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
var currentFrequency = 'monthly';
var selectedPrice = 25;
var selectedTitle = '5 Consultations';
var selectedConsultationsCount = 5;
var currentModalPay = 'card';

// Set Frequency (One-time vs Monthly) with dynamic transition effects
function setFreq(freq) {
    currentFrequency = freq;
    var isMonthly = (freq === 'monthly');

    // Update switcher buttons
    document.getElementById('btn-freq-onetime').classList.toggle('active', !isMonthly);
    document.getElementById('btn-freq-monthly').classList.toggle('active', isMonthly);

    // Update dynamic subhint with smooth fade effect
    var hint = document.getElementById('roFreqSubhint');
    if (hint) {
        hint.style.opacity = '0';
        hint.style.transform = 'translateY(-4px)';
        setTimeout(function() {
            if (isMonthly) {
                hint.innerHTML = '<i class="fas fa-arrows-rotate" style="color: var(--ro-blue);"></i> <span><strong>Monthly Sustained Care:</strong> Recurring grant providing continuous therapy every month. Cancel anytime.</span>';
            } else {
                hint.innerHTML = '<i class="fas fa-bolt" style="color: var(--ro-gold-dark);"></i> <span><strong>One-Time Purchase:</strong> Single immediate contribution delivered directly to families in need.</span>';
            }
            hint.style.opacity = '1';
            hint.style.transform = 'translateY(0)';
        }, 150);
    }

    // Trigger staggered morph animation across all 4 cards
    var cards = document.querySelectorAll('.ro-packages-grid .ro-pkg-card');
    cards.forEach(function(card, idx) {
        card.classList.remove('card-morph');
        void card.offsetWidth; // force reflow
        card.style.animationDelay = (idx * 0.04) + 's';
        card.classList.add('card-morph');
    });

    // Update period indicators (/ month vs one-time)
    document.querySelectorAll('.pkg-period').forEach(function(el) {
        el.textContent = isMonthly ? '/ month' : 'one-time';
    });

    // Update frequency pills on cards
    document.querySelectorAll('.pkg-freq-pill').forEach(function(el) {
        if (isMonthly) {
            el.className = 'pkg-freq-pill';
            el.innerHTML = '<i class="fas fa-arrows-rotate"></i> Monthly Grant';
        } else {
            el.className = 'pkg-freq-pill one-time';
            el.innerHTML = '<i class="fas fa-bolt"></i> One-Time';
        }
    });

    // Update button text and icons
    var b1 = document.getElementById('btn-pkg-1');
    var b2 = document.getElementById('btn-pkg-2');
    var b3 = document.getElementById('btn-pkg-3');
    var b4 = document.getElementById('btn-pkg-4');

    if (b1) b1.innerHTML = isMonthly ? '<span>Sponsor 1 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>' : '<span>Buy 1 Consultation</span>';
    if (b2) b2.innerHTML = isMonthly ? '<span>Sponsor 5 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>' : '<span>Buy 5 Consultations</span>';
    if (b3) b3.innerHTML = isMonthly ? '<span>Sponsor 10 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>' : '<span>Buy 10 Consultations</span>';
    if (b4) b4.innerHTML = isMonthly ? '<span>Sponsor 20 / mo</span> <i class="fas fa-arrow-right" style="margin-left:6px; font-size:12px;"></i>' : '<span>Buy 20 Consultations</span>';
}

// Open Modal from Package Cards
function openCheckoutModal(count, price, title) {
    selectedConsultationsCount = count;
    selectedPrice = price;
    selectedTitle = title;

    var freqSuffix = currentFrequency === 'monthly' ? ' / month' : '';
    document.getElementById('summaryPkgTitle').textContent = title + ' Package';
    document.getElementById('summaryFreqTitle').textContent = currentFrequency === 'monthly' ? 'Recurring Monthly Consultation Grant' : 'One-Time Consultation Purchase';
    document.getElementById('summaryPkgPrice').textContent = '$' + price.toFixed(2) + freqSuffix;
    
    var methodLabel = currentModalPay === 'card' ? ' via Bank of Palestine Gateway' : ' via PalPay Wallet';
    document.getElementById('btnSubmitText').textContent = 'Pay $' + price.toFixed(2) + freqSuffix + methodLabel;

    // Reset View
    document.getElementById('checkoutFormContent').style.display = 'block';
    document.getElementById('checkoutSuccessView').style.display = 'none';

    document.getElementById('checkoutModal').classList.add('open');
}

// Custom Amount Modal Handlers (Replacing native browser prompt!)
function openCustomCheckout() {
    var input = document.getElementById('customAmountInput');
    if (!input.value || parseFloat(input.value) <= 0) {
        input.value = 50;
    }
    updateCustomImpact(input.value);
    document.getElementById('customAmountModal').classList.add('open');
}

function closeCustomAmountModal() {
    document.getElementById('customAmountModal').classList.remove('open');
}

function selectPresetAmount(amount) {
    var input = document.getElementById('customAmountInput');
    input.value = amount;
    updateCustomImpact(amount);

    var btns = document.querySelectorAll('.ro-preset-btn');
    btns.forEach(function(btn) {
        btn.classList.toggle('active', btn.textContent.trim() === '$' + amount);
    });
}

function formatCustomInput(el) {
    el.value = el.value.replace(/[^0-9]/g, '');
    updateCustomImpact(el.value);
}

function updateCustomImpact(val) {
    var num = parseFloat(val);
    var notice = document.getElementById('customImpactNotice');
    if (!isNaN(num) && num >= 5) {
        var sessions = Math.max(1, Math.round(num / 5));
        notice.innerHTML = '<i class="fas fa-sparkles" style="color: var(--ro-gold);"></i> <span>Sponsors approximately <strong>' + sessions + '</strong> psychological consultation' + (sessions > 1 ? 's' : '') + '</span>';
    } else {
        notice.innerHTML = '<i class="fas fa-info-circle" style="color: var(--ro-blue);"></i> <span>Minimum sponsorship amount is $5</span>';
    }

    var btns = document.querySelectorAll('.ro-preset-btn');
    btns.forEach(function(btn) {
        btn.classList.toggle('active', btn.textContent.trim() === '$' + num);
    });
}

function proceedCustomAmount() {
    var input = document.getElementById('customAmountInput');
    var parsed = parseFloat(input.value);
    if (isNaN(parsed) || parsed < 5) {
        input.focus();
        input.parentElement.style.borderColor = '#ef4444';
        return;
    }
    input.parentElement.style.borderColor = '';
    closeCustomAmountModal();

    var approxSessions = Math.max(1, Math.round(parsed / 5));
    openCheckoutModal(approxSessions, parsed, approxSessions + ' Consultations (Custom Grant)');
}

// Close Modal
function closeCheckoutModal() {
    document.getElementById('checkoutModal').classList.remove('open');
}

// Switch Payment in Modal (Card vs PalPay Wallet)
function switchModalPay(method) {
    currentModalPay = method;
    document.getElementById('tab-pay-card').classList.toggle('active', method === 'card');
    document.getElementById('tab-pay-palpay').classList.toggle('active', method === 'palpay');

    document.getElementById('panel-card-form').style.display = method === 'card' ? 'block' : 'none';
    document.getElementById('panel-palpay-form').style.display = method === 'palpay' ? 'block' : 'none';

    var freqSuffix = currentFrequency === 'monthly' ? ' / month' : '';
    var methodLabel = method === 'card' ? ' via Bank of Palestine Gateway' : ' via PalPay Wallet';
    document.getElementById('btnSubmitText').textContent = 'Pay $' + selectedPrice.toFixed(2) + freqSuffix + methodLabel;
}

// Card Formatters
function formatCC(el) {
    var val = el.value.replace(/\D/g, '').substring(0, 16);
    var formatted = val.match(/.{1,4}/g);
    el.value = formatted ? formatted.join(' ') : '';
}

function formatExp(el) {
    var val = el.value.replace(/\D/g, '').substring(0, 4);
    if (val.length >= 2) {
        el.value = val.substring(0, 2) + ' / ' + val.substring(2);
    } else {
        el.value = val;
    }
}

// Complete Automated Order (Bank of Palestine Gateway)
function completeOrder() {
    var nameEl = document.getElementById('custName');
    var emailEl = document.getElementById('custEmail');

    if (!nameEl.value.trim()) {
        nameEl.focus();
        nameEl.style.borderColor = '#ef4444';
        return;
    }
    nameEl.style.borderColor = '';

    if (!emailEl.value.trim() || !emailEl.value.includes('@')) {
        emailEl.focus();
        emailEl.style.borderColor = '#ef4444';
        return;
    }
    emailEl.style.borderColor = '';

    var btn = document.getElementById('btnSubmitOrder');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Connecting to Bank of Palestine Gateway...';

    setTimeout(function() {
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Authorizing 3D Secure...';
    }, 600);

    setTimeout(function() {
        btn.disabled = false;
        var freqSuffix = currentFrequency === 'monthly' ? ' / month' : '';
        var methodLabel = currentModalPay === 'card' ? ' via Bank of Palestine Gateway' : ' via PalPay Wallet';
        btn.innerHTML = '<i class="fas fa-lock"></i> <span id="btnSubmitText">Pay $' + selectedPrice.toFixed(2) + freqSuffix + methodLabel + '</span>';

        // Populate receipt slip
        var ref = 'BOP-TXN-' + new Date().getFullYear() + '-' + Math.floor(10000 + Math.random() * 90000);
        document.getElementById('rcSlipRef').textContent = ref;
        document.getElementById('rcSlipService').textContent = selectedTitle + ' (Psychological Consultation Service)';
        document.getElementById('rcSlipCustomer').textContent = nameEl.value.trim();
        document.getElementById('rcSlipMethod').textContent = currentModalPay === 'card' ? 'Bank of Palestine 3D Secure Gateway (Card)' : 'PalPay Digital Wallet (Bank of Palestine)';
        document.getElementById('rcSlipTotal').textContent = '$' + selectedPrice.toFixed(2) + ' USD' + freqSuffix;

        // Toggle View
        document.getElementById('checkoutFormContent').style.display = 'none';
        document.getElementById('checkoutSuccessView').style.display = 'block';
    }, 1300);
}

// Interactive Step Showcase (Section 5: Auto-play & Step transitions)
var currentShowcaseStep = 0;
var showcaseTotalSteps = 4;
var showcaseAutoTimer = null;
var showcaseIntervalMs = 3500;

function switchShowcaseStep(index, isUserClick) {
    currentShowcaseStep = index;
    
    // Update slides
    var slides = document.querySelectorAll('.ro-showcase-slide');
    slides.forEach(function(slide) {
        var slideIdx = parseInt(slide.getAttribute('data-index'), 10);
        slide.classList.toggle('active', slideIdx === index);
    });

    // Update tabs and restart progress line animation
    var tabs = document.querySelectorAll('.ro-step-tab-btn');
    tabs.forEach(function(tab) {
        var tabIdx = parseInt(tab.getAttribute('data-step'), 10);
        var isActive = (tabIdx === index);
        tab.classList.toggle('active', isActive);
        if (isActive) {
            var pLine = tab.querySelector('.tab-progress-line');
            if (pLine) {
                pLine.style.animation = 'none';
                pLine.offsetHeight; // trigger reflow
                pLine.style.animation = 'tabFill 3.5s linear forwards';
            }
        }
    });

    // Update dots
    var dots = document.querySelectorAll('.ro-nav-dot');
    dots.forEach(function(dot, idx) {
        dot.classList.toggle('active', idx === index);
    });

    // If user manually clicked, reset timer so it keeps auto-advancing from the new step
    if (isUserClick) {
        startShowcaseTimer();
    }
}

function stepNextShowcase() {
    var next = (currentShowcaseStep + 1) % showcaseTotalSteps;
    switchShowcaseStep(next, false);
}

function stepPrevShowcase() {
    var prev = (currentShowcaseStep - 1 + showcaseTotalSteps) % showcaseTotalSteps;
    switchShowcaseStep(prev, false);
}

function startShowcaseTimer() {
    stopShowcaseTimer();
    showcaseAutoTimer = setInterval(stepNextShowcase, showcaseIntervalMs);
}

function stopShowcaseTimer() {
    if (showcaseAutoTimer) {
        clearInterval(showcaseAutoTimer);
        showcaseAutoTimer = null;
    }
}

// Start auto-play immediately without waiting
startShowcaseTimer();
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', startShowcaseTimer);
}

</script>
@endsection