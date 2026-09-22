@extends('frontend.layouts.main')

@section('title', 'Get Help - Mental Health Frontline')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
/* ════════════════════════════════════════════════════════════════
   GET HELP - BRAND DESIGN SYSTEM
════════════════════════════════════════════════════════════════ */
:root {
    --gh-navy: #0e2a47;
    --gh-navy-dark: #091b30;
    --gh-navy-light: #163e69;
    --gh-blue-primary: #184B89;
    --gh-blue-hover: #123766;
    --gh-teal: #0e2a47;
    --gh-teal-hover: #0e2a47;
    --gh-green-wa: #184B89;
    --gh-green-wa-hover: #184B89;
    --gh-bg-soft: #f8fafc;
    --gh-bg-card: #ffffff;
    --gh-text-dark: #0f172a;
    --gh-text-body: #334155;
    --gh-text-muted: #64748b;
    --gh-border: #e2e8f0;
    --gh-border-light: #f1f5f9;
    --gh-border-blue: #dbeafe;
    --gh-pill-bg: #eef4fc;
    --gh-pill-text: #184B89;
}

body {
    background-color: #ffffff;
    color: var(--gh-text-body);
    font-family: 'Inter', 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    -webkit-font-smoothing: antialiased;
}

.font-display {
    font-family: 'Caprasimo', cursive;
}

.font-script {
    font-family: 'Caveat', cursive;
}

.gh-page-wrap {
    padding-top: 76px;
    overflow-x: hidden;
}

.gh-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 28px;
}

/* Category Pill */
.gh-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    color: var(--gh-pill-text);
    background: var(--gh-pill-bg);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 18px;
    border: 1px solid rgba(24, 75, 137, 0.12);
}

/* Common Section Titles */
.gh-section-title {
    font-size: clamp(28px, 3.4vw, 42px);
    font-weight: 800;
    color: var(--gh-navy);
    line-height: 1.18;
    letter-spacing: -0.02em;
    margin-bottom: 14px;
}

.gh-section-desc {
    font-size: 16px;
    color: var(--gh-text-muted);
    line-height: 1.65;
}

/* Buttons */
.gh-btn-wa {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #184B89;
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    padding: 13px 26px;
    border-radius: 999px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.32);
}
.gh-btn-wa:hover {
    background: #0e2a47;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(14, 42, 71, 0.45);
}
.gh-btn-wa i {
    font-size: 18px;
}
.gh-btn-wa .arrow-icon {
    font-size: 13px;
    transition: transform 0.2s ease;
}
.gh-btn-wa:hover .arrow-icon {
    transform: translateX(4px);
}

.gh-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    color: var(--gh-navy);
    font-size: 15px;
    font-weight: 700;
    padding: 12px 26px;
    border-radius: 999px;
    border: 1.5px solid var(--gh-border);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.gh-btn-outline:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: var(--gh-blue-primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}
.gh-btn-outline i {
    font-size: 16px;
}
.gh-btn-outline .arrow-icon {
    font-size: 13px;
    transition: transform 0.2s ease;
}
.gh-btn-outline:hover .arrow-icon {
    transform: translateX(4px);
}

/* ════════════════════════════════════════════════════════════════
   1. HERO SECTION (CINEMATIC FULL-WIDTH HERO WITH BRAND IDENTITY)
════════════════════════════════════════════════════════════════ */
.gh-hero-cinematic {
    position: relative;
    padding: 100px 0 85px 0;
    min-height: calc(100vh - 76px);
    min-height: 580px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0a1829;
}

.gh-hero-bg-layer {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    overflow: hidden;
    pointer-events: none;
}

.gh-hero-bg-img {
    position: absolute;
    top: 0;
    right: -10%;
    width: 116%;
    max-width: none;
    height: 100%;
    object-fit: cover;
    object-position: right 25%;
    filter: brightness(1.02) contrast(1.02);
    transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.gh-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(10, 24, 42, 0.88) 0%,
        rgba(10, 24, 42, 0.78) 32%,
        rgba(10, 24, 42, 0.45) 54%,
        rgba(10, 24, 42, 0.14) 72%,
        rgba(10, 24, 42, 0.00) 86%,
        rgba(10, 24, 42, 0.00) 100%
    );
}

.gh-hero-container {
    position: relative;
    z-index: 3;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.gh-hero-content-box {
    max-width: 650px;
    width: 100%;
}

.gh-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #93c5fd;
    background: rgba(24, 75, 137, 0.38);
    border: 1px solid rgba(147, 197, 253, 0.35);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 7px 18px;
    border-radius: 50px;
    margin-bottom: 22px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.gh-hero-eyebrow i {
    color: #60a5fa;
}

.gh-hero-title-white {
    font-size: clamp(38px, 4.8vw, 58px);
    font-weight: 800;
    line-height: 1.14;
    color: #ffffff !important;
    margin: 0 0 22px 0;
    letter-spacing: -0.025em;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
}

.gh-hero-lead-white {
    font-size: clamp(16px, 1.25vw, 18.5px);
    line-height: 1.72;
    color: rgba(255, 255, 255, 0.92);
    margin: 0 0 34px 0;
    max-width: 600px;
    font-weight: 500;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.30);
}

.gh-hero-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 16px;
    margin-bottom: 38px;
}

.gh-btn-wa-cinematic {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #184B89;
    color: #ffffff;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 15.5px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 18px rgba(24, 75, 137, 0.42);
}

.gh-btn-wa-cinematic:hover {
    background: #0e2a47;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(14, 42, 71, 0.55);
}

.gh-btn-wa-cinematic .arrow-icon {
    font-size: 13px;
    transition: transform 0.25s ease;
}

.gh-btn-wa-cinematic:hover .arrow-icon {
    transform: translateX(4px);
}

.gh-btn-outline-cinematic {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
    padding: 14px 28px;
    border-radius: 50px;
    font-size: 15.5px;
    font-weight: 700;
    border: 1.5px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.gh-btn-outline-cinematic:hover {
    background: #ffffff;
    color: var(--gh-navy);
    border-color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(255, 255, 255, 0.25);
}

.gh-btn-outline-cinematic .arrow-icon {
    font-size: 13px;
    transition: transform 0.25s ease;
}

.gh-btn-outline-cinematic:hover .arrow-icon {
    transform: translateX(4px);
}

/* ── Trust Row matching Brand Visual Identity ── */
.gh-trust-row-cinematic {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px 20px;
    padding-top: 26px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    max-width: 600px;
}

.gh-trust-pill {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.14);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 8px 16px;
    border-radius: 14px;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 600;
    transition: all 0.25s ease;
}

.gh-trust-pill:hover {
    background: rgba(255, 255, 255, 0.14);
    border-color: rgba(147, 197, 253, 0.5);
    transform: translateY(-2px);
}

.gh-trust-icon-wrap {
    width: 32px;
    height: 32px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(24, 75, 137, 0.8) 0%, rgba(14, 42, 71, 0.9) 100%);
    border: 1px solid rgba(147, 197, 253, 0.35);
    color: #60a5fa;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13.5px;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

/* ── Floating Handwritten Script ── */
.gh-hero-floating-badge {
    position: absolute;
    right: -20px;
    bottom: -35px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    text-align: right;
    color: #ffffff;
    pointer-events: none;
    z-index: 4;
    text-shadow: 0 3px 14px rgba(0, 0, 0, 0.85);
}

.gh-hero-floating-badge .kite-doodle {
    width: 30px;
    height: auto;
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.6));
    margin-bottom: 6px;
}

.gh-hero-floating-badge span {
    font-size: clamp(10px, 2.3vw, 22px);
    line-height: 1.15;
    font-weight: 500;
}

.gh-hero-floating-badge .script-heart {
    font-size: 26px;
    color: #fca5a5;
    margin-top: 4px;
}

@media (max-width: 991px) {
    .gh-hero-cinematic {
        padding: 85px 0 65px 0;
        min-height: 520px;
    }
    .gh-hero-bg-img {
        right: 0;
        width: 100%;
        object-position: 75% center;
    }
    .gh-hero-overlay {
        background: linear-gradient(
            to right,
            rgba(10, 24, 42, 0.88) 0%,
            rgba(10, 24, 42, 0.78) 50%,
            rgba(10, 24, 42, 0.45) 80%,
            rgba(10, 24, 42, 0.15) 100%
        );
    }
    .gh-hero-floating-badge {
        display: none;
    }
}

@media (max-width: 640px) {
    .gh-trust-row-cinematic {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    .gh-hero-overlay {
        background: linear-gradient(
            to bottom,
            rgba(10, 24, 42, 0.88) 0%,
            rgba(10, 24, 42, 0.75) 60%,
            rgba(10, 24, 42, 0.45) 100%
        );
    }
}

/* ════════════════════════════════════════════════════════════════
   2. HOW WE CAN HELP SECTION
════════════════════════════════════════════════════════════════ */
.gh-help-section {
    padding: 95px 0 90px 0;
    background: #ffffff;
    position: relative;
}

.gh-help-header {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 48px;
    align-items: center;
    margin-bottom: 50px;
}

.gh-help-header-desc {
    font-size: 16.5px;
    color: #475569;
    line-height: 1.7;
    border-left: 3px solid var(--gh-blue-primary);
    padding-left: 22px;
    margin: 0;
}

.gh-cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.gh-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    position: relative;
    cursor: pointer;
}

.gh-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 38px -10px rgba(24, 75, 137, 0.16), 0 4px 12px rgba(0, 0, 0, 0.04);
    border-color: rgba(24, 75, 137, 0.32);
}

.gh-card-img {
    width: 100%;
    height: 195px;
    overflow: hidden;
    position: relative;
    background: #f1f5f9;
}

.gh-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.gh-card:hover .gh-card-img img {
    transform: scale(1.08);
}

.gh-card-overlay-vignette {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(14, 42, 71, 0.42) 0%, rgba(14, 42, 71, 0.05) 55%, transparent 100%);
    pointer-events: none;
}

.gh-card-badge {
    position: absolute;
    bottom: 14px;
    left: 14px;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(14, 42, 71, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    color: #ffffff;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.03em;
    border: 1px solid rgba(255, 255, 255, 0.22);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
    z-index: 2;
}

.gh-card-badge i {
    color: #60a5fa;
    font-size: 12px;
}

.gh-card-body {
    padding: 24px 22px 22px 22px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.gh-card-title {
    font-size: 17.5px;
    font-weight: 700;
    color: var(--gh-navy);
    line-height: 1.35;
    margin-bottom: 10px;
    min-height: 48px;
    display: flex;
    align-items: flex-start;
}

.gh-card-desc {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

.gh-card-footer {
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.gh-card-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--gh-blue-primary);
    transition: all 0.2s ease;
}

.gh-card-link .arrow-icon {
    font-size: 12px;
    transition: transform 0.2s ease;
}

.gh-card:hover .gh-card-link {
    color: var(--gh-navy);
}

.gh-card:hover .gh-card-link .arrow-icon {
    transform: translateX(5px);
}

/* ════════════════════════════════════════════════════════════════
   3. HOW IT WORKS SECTION (ANIMATED JOURNEY & INTERACTIVE CARDS)
════════════════════════════════════════════════════════════════ */
.gh-works-section {
    padding: 105px 0 100px 0;
    background: linear-gradient(180deg, #f8fafc 0%, #edf3f9 50%, #f8fafc 100%);
    border-top: 1px solid var(--gh-border);
    border-bottom: 1px solid var(--gh-border);
    position: relative;
    overflow: hidden;
}

/* Subtle Animated Ambient Circles */
.gh-works-glow-1 {
    position: absolute;
    width: 450px;
    height: 450px;
    top: -120px;
    left: -100px;
    background: radial-gradient(circle, rgba(24, 75, 137, 0.07) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    animation: ghFloatSlow 8s ease-in-out infinite alternate;
}

.gh-works-glow-2 {
    position: absolute;
    width: 400px;
    height: 400px;
    bottom: -100px;
    right: -80px;
    background: radial-gradient(circle, rgba(14, 42, 71, 0.06) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    animation: ghFloatSlow 10s ease-in-out infinite alternate-reverse;
}

@keyframes ghFloatSlow {
    0% { transform: translateY(0) scale(1); }
    100% { transform: translateY(20px) scale(1.08); }
}

.gh-works-header {
    text-align: center;
    max-width: 680px;
    margin: 0 auto 65px auto;
}

.gh-works-header .gh-section-title {
    margin-bottom: 14px;
}

.gh-works-header .gh-section-desc {
    font-size: 16.5px;
    color: #64748b;
    line-height: 1.6;
}

/* Steps Container with Animated Connecting Flow Line */
.gh-steps-container {
    position: relative;
}

.gh-steps-track-line {
    position: absolute;
    top: 65px;
    left: 14%;
    right: 14%;
    height: 3px;
    background: linear-gradient(90deg, #cbd5e1 0%, #184B89 50%, #cbd5e1 100%);
    background-size: 200% 100%;
    animation: ghFlowGradient 4s linear infinite;
    z-index: 1;
    border-radius: 4px;
}

@keyframes ghFlowGradient {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.gh-steps-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
    position: relative;
    z-index: 2;
}

/* Modern Animated Step Card */
.gh-step-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 34px 28px 30px 28px;
    border: 1.5px solid #e2e8f0;
    box-shadow: 0 6px 22px rgba(15, 23, 42, 0.04);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: relative;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
}

.gh-step-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: transparent;
    transition: background 0.3s ease;
}

.gh-step-card:hover {
    transform: translateY(-9px);
    border-color: rgba(24, 75, 137, 0.32);
    box-shadow: 0 22px 42px -10px rgba(24, 75, 137, 0.16), 0 4px 12px rgba(0, 0, 0, 0.03);
}

.gh-step-card:hover::before {
    background: linear-gradient(90deg, #184B89, #60a5fa);
}

/* Card Top: Icon & Number Watermark */
.gh-step-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 22px;
}

.gh-step-icon-wrap {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: linear-gradient(135deg, #184B89 0%, #0e2a47 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 8px 20px rgba(24, 75, 137, 0.28);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
}

.gh-step-card:hover .gh-step-icon-wrap {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 26px rgba(24, 75, 137, 0.42);
}

.gh-step-number-watermark {
    font-size: 34px;
    font-weight: 900;
    color: #e2e8f0;
    line-height: 1;
    letter-spacing: -0.04em;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
}

.gh-step-card:hover .gh-step-number-watermark {
    color: rgba(24, 75, 137, 0.28);
    transform: scale(1.06);
}

/* Feature Tag */
.gh-step-pill-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #184B89;
    background: #eef4fc;
    padding: 5px 12px;
    border-radius: 50px;
    margin-bottom: 14px;
    border: 1px solid rgba(24, 75, 137, 0.12);
}

.gh-step-pill-tag i {
    font-size: 11px;
    color: #184B89;
}

.gh-step-title {
    font-size: 19px;
    font-weight: 800;
    color: var(--gh-navy);
    line-height: 1.34;
    margin-bottom: 12px;
    min-height: 52px;
}

.gh-step-text {
    font-size: 14.5px;
    color: #64748b;
    line-height: 1.65;
    margin-bottom: 22px;
    flex-grow: 1;
}

/* Action Trigger */
.gh-step-footer {
    width: 100%;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.gh-step-action-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--gh-blue-primary);
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.25s ease;
}

.gh-step-action-link .arrow-icon {
    font-size: 12px;
    transition: transform 0.25s ease;
}

.gh-step-card:hover .gh-step-action-link {
    color: var(--gh-navy);
}

.gh-step-card:hover .gh-step-action-link .arrow-icon {
    transform: translateX(5px);
}

/* ════════════════════════════════════════════════════════════════
   4. EASY ACCESS BANNER CARD (BACK-US STYLE)
════════════════════════════════════════════════════════════════ */
.gh-access-section {
    position: relative;
    background: #ffffff;
    padding: 40px 24px 55px 24px;
    border-top: 1px solid var(--gh-border);
    border-bottom: 1px solid var(--gh-border);
}

.gh-access-card {
    max-width: 1140px;
    margin: 0 auto;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 24px;
    padding: 38px 46px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 36px;
    position: relative;
    z-index: 2;
    box-shadow: 0 16px 45px -10px rgba(10, 42, 74, 0.08), 0 4px 14px rgba(0, 0, 0, 0.02);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.gh-access-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 22px 55px -10px rgba(10, 42, 74, 0.13), 0 6px 18px rgba(0, 0, 0, 0.03);
}

.gh-access-left {
    max-width: 650px;
}

.gh-access-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--gh-blue-primary);
    background: #eef4fc;
    border: 1px solid #dbeafe;
    padding: 4px 12px;
    border-radius: 100px;
    margin-bottom: 10px;
}

.gh-access-pill i {
    color: #ef4444;
}

.gh-access-left h2 {
    font-size: clamp(22px, 2.4vw, 30px);
    font-weight: 800;
    color: var(--gh-navy);
    margin-bottom: 8px;
    line-height: 1.25;
    letter-spacing: -0.02em;
}

.gh-access-left p {
    font-size: 15px;
    color: #64748b;
    line-height: 1.55;
    margin: 0;
}

.gh-access-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    flex-shrink: 0;
}

.gh-access-btns {
    display: flex;
    align-items: center;
    gap: 12px;
}

.gh-access-script {
    font-family: 'Caveat', cursive;
    font-size: 20px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 5px;
    font-weight: 600;
}

.gh-access-script .heart {
    color: #ef4444;
    font-size: 14px;
}

@media (max-width: 991px) {
    .gh-access-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 32px 28px;
        gap: 24px;
    }
    .gh-access-right {
        align-items: flex-start;
        width: 100%;
    }
    .gh-access-btns {
        flex-wrap: wrap;
        width: 100%;
    }
}

/* ════════════════════════════════════════════════════════════════
   5. WHAT TO EXPECT SECTION
════════════════════════════════════════════════════════════════ */
.gh-expect-section {
    padding: 85px 0 95px 0;
    background: #f8fafc;
    border-top: 1px solid var(--gh-border);
}

.gh-expect-header {
    text-align: left;
    margin-bottom: 55px;
}

/* Flow track with connector line */
.gh-flow-track {
    display: grid;
    grid-template-columns: 1fr auto 1fr auto 1fr auto 1fr;
    gap: 16px;
    align-items: flex-start;
    margin-bottom: 50px;
    position: relative;
}

.gh-flow-step {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    position: relative;
}

/* Step number badge */
.gh-flow-step::before {
    content: attr(data-step);
    position: absolute;
    top: -8px;
    left: -8px;
    width: 20px;
    height: 20px;
    background: var(--gh-blue-primary);
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    box-shadow: 0 2px 8px rgba(24, 75, 137, 0.35);
    line-height: 1;
    text-align: center;
    padding-top: 1px;
}

.gh-flow-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #ffffff;
    color: var(--gh-blue-primary);
    border: 1.5px solid var(--gh-border-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.10);
    transition: all 0.35s ease;
    position: relative;
    z-index: 2;
}

.gh-flow-step:hover .gh-flow-icon {
    background: var(--gh-blue-primary);
    color: #ffffff;
    border-color: var(--gh-blue-primary);
    transform: translateY(-3px) scale(1.07);
    box-shadow: 0 10px 28px rgba(24, 75, 137, 0.30);
}

.gh-flow-step h4 {
    font-size: 15.5px;
    font-weight: 700;
    color: var(--gh-navy);
    line-height: 1.3;
    margin: 0;
}

.gh-flow-step p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.55;
    margin: 0;
}

/* Animated arrow between steps */
.gh-flow-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 16px;
    color: var(--gh-blue-primary);
    font-size: 16px;
    opacity: 0.55;
    animation: arrowBounce 1.6s ease-in-out infinite;
}

.gh-flow-arrow:nth-of-type(2) { animation-delay: 0.3s; }
.gh-flow-arrow:nth-of-type(3) { animation-delay: 0.6s; }

@keyframes arrowBounce {
    0%, 100% { transform: translateX(0);   opacity: 0.55; }
    50%       { transform: translateX(5px); opacity: 1; }
}

/* Informational alert cards */
.gh-alerts-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.gh-alert-box {
    padding: 22px 26px;
    border-radius: 14px;
    display: flex;
    gap: 18px;
    align-items: flex-start;
}

.gh-alert-box.policy {
    background: #ffffff;
    border: 1px solid var(--gh-border-blue);
    box-shadow: 0 4px 16px rgba(24, 75, 137, 0.06);
}

.gh-alert-box.emergency {
    background: #fef2f2;
    border: 1px solid #fecaca;
    box-shadow: 0 4px 16px rgba(220, 38, 38, 0.05);
}

.gh-alert-icon {
    font-size: 22px;
    flex-shrink: 0;
    margin-top: 2px;
}

.gh-alert-box.policy .gh-alert-icon {
    color: var(--gh-blue-primary);
}

.gh-alert-box.emergency .gh-alert-icon {
    color: #dc2626;
}

.gh-alert-content h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--gh-navy);
    margin-bottom: 6px;
}

.gh-alert-box.emergency .gh-alert-content h4 {
    color: #991b1b;
}

.gh-alert-content p {
    font-size: 13.5px;
    color: #475569;
    line-height: 1.55;
    margin-bottom: 8px;
}

.gh-alert-box.emergency .gh-alert-content p {
    color: #7f1d1d;
}

.gh-alert-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--gh-blue-primary);
    text-decoration: none;
    transition: all 0.2s ease;
}
.gh-alert-link:hover {
    color: var(--gh-navy);
    text-decoration: underline;
}

/* ════════════════════════════════════════════════════════════════
   6. BOTTOM CTA BANNER
════════════════════════════════════════════════════════════════ */
.gh-bottom-cta {
    position: relative;
    padding: 90px 0;
    background: #0a1829;
    overflow: hidden;
}

.gh-cta-bg-layer {
    position: absolute;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    overflow: hidden;
}

.gh-cta-bg-img {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    width: auto;
    filter: brightness(0.88) contrast(1.05);
}

.gh-cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(10, 24, 42, 1.00) 0%,
        rgba(10, 24, 42, 0.97) 36%,
        rgba(10, 24, 42, 0.72) 50%,
        rgba(10, 24, 42, 0.28) 64%,
        rgba(10, 24, 42, 0.06) 78%,
        rgba(10, 24, 42, 0.00) 90%,
        rgba(10, 24, 42, 0.00) 100%
    );
}

.gh-bottom-cta-inner {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 40px;
    align-items: center;
}

.gh-bottom-cta .gh-pill {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.25);
}

.gh-bottom-cta-title {
    font-size: clamp(32px, 3.8vw, 48px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.16;
    letter-spacing: -0.02em;
    margin-bottom: 14px;
}

.gh-bottom-cta-desc {
    font-size: 18px;
    color: #cbd5e1;
    margin-bottom: 30px;
}

.gh-bottom-cta-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px;
}

.gh-bottom-cta-actions .gh-btn-outline {
    background: transparent;
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.45);
}
.gh-bottom-cta-actions .gh-btn-outline:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: #ffffff;
    color: #ffffff;
}

.gh-bottom-cta-script {
    text-align: right;
    font-family: 'Caveat', cursive;
    color: #ffffff;
    font-size: clamp(34px, 3.8vw, 50px);
    font-weight: 700;
    line-height: 1.1;
    text-shadow: 0 4px 16px rgba(0, 0, 0, 0.6);
}

.gh-bottom-cta-script .heart {
    display: block;
    font-size: 34px;
    margin-top: 4px;
}

/* ════════════════════════════════════════════════════════════════
   4b. EASY ACCESS – VISUAL GRID LAYOUT
════════════════════════════════════════════════════════════════ */
.gh-access-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    padding: 60px 0 70px 0;
}

/* Visual Left Column */
.gh-access-visual-wrap {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gh-access-ambient-blob {
    position: absolute;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(24, 75, 137, 0.10) 0%, rgba(24, 75, 137, 0.03) 60%, transparent 100%);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
    pointer-events: none;
}

.gh-floating-pulse-badge {
    position: absolute;
    top: 18px;
    left: 10px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border: 1px solid var(--gh-border);
    border-radius: 100px;
    padding: 7px 14px 7px 10px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--gh-navy);
    box-shadow: 0 6px 20px rgba(10, 42, 74, 0.10);
    z-index: 4;
    white-space: nowrap;
}

.pulse-dot {
    width: 9px;
    height: 9px;
    background: #22c55e;
    border-radius: 50%;
    display: inline-block;
    animation: pulseGreen 1.8s ease-in-out infinite;
    flex-shrink: 0;
}

@keyframes pulseGreen {
    0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
    50%       { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
}

.gh-access-frame {
    position: relative;
    z-index: 2;
    border-radius: 42% 58% 62% 38% / 44% 38% 62% 56%;
    overflow: hidden;
    width: 100%;
    max-width: 460px;
    aspect-ratio: 1 / 1.05;
    box-shadow: 0 28px 70px -14px rgba(10, 42, 74, 0.20), 0 8px 24px rgba(0,0,0,0.08);
    transition: border-radius 1.2s ease;
}

.gh-access-frame:hover {
    border-radius: 58% 42% 38% 62% / 56% 62% 38% 44%;
}

.gh-access-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
    transition: transform 0.7s ease;
}

.gh-access-frame:hover img {
    transform: scale(1.06);
}

/* Content Right Column */
.gh-access-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
}

.gh-access-lead {
    font-size: 15.5px;
    color: var(--gh-text-body);
    line-height: 1.7;
    margin-bottom: 24px;
    margin-top: 10px;
}

.gh-access-points {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 28px;
}

.gh-access-point {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14.5px;
    color: var(--gh-text-body);
    font-weight: 500;
    line-height: 1.5;
}

.gh-access-point i {
    color: var(--gh-blue-primary);
    font-size: 15px;
    margin-top: 2px;
    flex-shrink: 0;
}

.gh-access-subtext {
    font-size: 13px;
    color: var(--gh-text-muted);
    margin-top: 6px;
    font-style: italic;
}

@media (max-width: 991px) {
    .gh-access-grid {
        grid-template-columns: 1fr;
        gap: 40px;
        padding: 45px 0 55px 0;
    }
    .gh-access-frame {
        max-width: 100%;
    }
    .gh-access-frame img {
        height: 300px;
    }
}

/* ════════════════════════════════════════════════════════════════
   RESPONSIVENESS (existing section)

════════════════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .gh-cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .gh-steps-track-line {
        display: none;
    }
    .gh-steps-row {
        grid-template-columns: 1fr;
        gap: 28px;
    }
    .gh-flow-track {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    .gh-flow-arrow {
        display: none;
    }
}

@media (max-width: 768px) {
    .gh-hero-grid,
    .gh-help-header,
    .gh-access-grid,
    .gh-bottom-cta-inner {
        grid-template-columns: 1fr;
        gap: 36px;
    }
    .gh-hero-visual img {
        height: 340px;
    }
    .gh-access-visual img {
        height: 300px;
    }
    .gh-cards-grid {
        grid-template-columns: 1fr;
    }
    .gh-flow-track {
        grid-template-columns: 1fr;
    }
    .gh-alerts-row {
        grid-template-columns: 1fr;
    }
    .gh-bottom-cta-script {
        text-align: left;
    }
}
</style>
@endsection

@section('content')
<main class="gh-page-wrap">

    <!-- ══ 1. HERO SECTION (CINEMATIC FULL-WIDTH BACKGROUND) ══ -->
    <section class="gh-hero-cinematic">
        <!-- Background Layer with Gaza Girl Photo -->
        <div class="gh-hero-bg-layer">
            <img src="{{ asset('reachout/img/gethelp_hero_girl.jpg') }}?v={{ file_exists(public_path('reachout/img/gethelp_hero_girl.jpg')) ? filemtime(public_path('reachout/img/gethelp_hero_girl.jpg')) : 1 }}" alt="Support in Gaza - Mental Health Frontline" class="gh-hero-bg-img">
            <div class="gh-hero-overlay"></div>
        </div>

        <div class="gh-container gh-hero-container">
            <div class="gh-hero-content-box">
                <span class="gh-hero-eyebrow">
                    <i class="fas fa-hand-holding-heart"></i> YOU ARE NOT ALONE
                </span>

                <h1 class="gh-hero-title-white">
                    Get the support<br>you need.
                </h1>

                <p class="gh-hero-lead-white">
                    Free, confidential and professional mental health and psychosocial support for individuals and families affected by conflict, displacement and crisis.
                </p>

                <div class="gh-hero-actions">
                    <button class="gh-btn-wa-cinematic" onclick="openPopupWithChannel('whatsapp'); return false;">
                        <i class="fab fa-whatsapp"></i>
                        <span>Start on WhatsApp</span>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </button>
                    <button class="gh-btn-outline-cinematic" onclick="openPopupWithChannel('email'); return false;">
                        <i class="fas fa-envelope"></i>
                        <span>Email us</span>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </button>
                </div>

            </div>

            <!-- Floating Handwritten Script on the scene -->
            <div class="gh-hero-floating-badge">
                <img src="{{ asset('reachout/img/kite.png') }}" class="kite-doodle" alt="Kite">
                <span class="font-script">Stronger Minds<br>Brighter Tomorrows</span>
                <span class="script-heart font-script">♡</span>
            </div>
        </div>
    </section>

    <!-- ══ 2. HOW WE CAN HELP ══ -->
    <section class="gh-help-section">
        <div class="gh-container">
            <div class="gh-help-header">
                <div>
                    <span class="gh-pill">HOW WE CAN HELP</span>
                    <h2 class="gh-section-title">Support for real lives,<br>in difficult times.</h2>
                </div>
                <div>
                    <p class="gh-help-header-desc">
                        We provide mental health and psychosocial support tailored to the needs of individuals and families affected by conflict, displacement and crisis.
                    </p>
                </div>
            </div>

            <div class="gh-cards-grid">
                <!-- Card 1 -->
                <div class="gh-card" onclick="openPopupWithChannel('whatsapp'); return false;">
                    <div class="gh-card-img">
                        <img src="{{ asset('reachout/img/gethelp_emotional_light.jpg') }}" alt="Emotional & psychological support">
                        <div class="gh-card-overlay-vignette"></div>
                        <div class="gh-card-badge">
                            <i class="fas fa-heartbeat"></i>
                            <span>Psychological</span>
                        </div>
                    </div>
                    <div class="gh-card-body">
                        <div>
                            <h3 class="gh-card-title">Emotional & psychological support</h3>
                            <p class="gh-card-desc">A safe space to talk with a qualified professional about what you're experiencing.</p>
                        </div>
                        <div class="gh-card-footer">
                            <span class="gh-card-link">
                                <span>Get this support</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="gh-card" onclick="openPopupWithChannel('whatsapp'); return false;">
                    <div class="gh-card-img">
                        <img src="{{ asset('reachout/img/gethelp_care_hands.jpg') }}" alt="Caregiver & family guidance">
                        <div class="gh-card-overlay-vignette"></div>
                        <div class="gh-card-badge">
                            <i class="fas fa-hands-helping"></i>
                            <span>Family & Care</span>
                        </div>
                    </div>
                    <div class="gh-card-body">
                        <div>
                            <h3 class="gh-card-title">Caregiver & family guidance</h3>
                            <p class="gh-card-desc">Practical support for parents, caregivers and family members facing new challenges.</p>
                        </div>
                        <div class="gh-card-footer">
                            <span class="gh-card-link">
                                <span>Get this support</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="gh-card" onclick="openPopupWithChannel('whatsapp'); return false;">
                    <div class="gh-card-img">
                        <img src="{{ asset('reachout/img/gethelp_kite_sky.jpg') }}" alt="Coping with stress, grief, fear and displacement">
                        <div class="gh-card-overlay-vignette"></div>
                        <div class="gh-card-badge">
                            <i class="fas fa-wind"></i>
                            <span>Coping & Relief</span>
                        </div>
                    </div>
                    <div class="gh-card-body">
                        <div>
                            <h3 class="gh-card-title">Coping with stress & displacement</h3>
                            <p class="gh-card-desc">Tools and strategies to help you navigate the emotional effects of crisis.</p>
                        </div>
                        <div class="gh-card-footer">
                            <span class="gh-card-link">
                                <span>Get this support</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="gh-card" onclick="openPopupWithChannel('whatsapp'); return false;">
                    <div class="gh-card-img">
                        <img src="{{ asset('reachout/img/gethelp_wooden_signpost.webp') }}" alt="Referral when specialized care is needed">
                        <div class="gh-card-overlay-vignette"></div>
                        <div class="gh-card-badge">
                            <i class="fas fa-map-signs"></i>
                            <span>Referral</span>
                        </div>
                    </div>
                    <div class="gh-card-body">
                        <div>
                            <h3 class="gh-card-title">Referral when specialized care is needed</h3>
                            <p class="gh-card-desc">We help connect you with appropriate services and resources where available.</p>
                        </div>
                        <div class="gh-card-footer">
                            <span class="gh-card-link">
                                <span>Get this support</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 3. HOW IT WORKS ══ -->
    <section class="gh-works-section">
        <!-- Ambient Decorative Glows -->
        <div class="gh-works-glow-1"></div>
        <div class="gh-works-glow-2"></div>

        <div class="gh-container">
            <div class="gh-works-header">
                <span class="gh-pill">HOW IT WORKS</span>
                <h2 class="gh-section-title">Getting support is simple.</h2>
                <p class="gh-works-header-desc">
                    Three clear, compassionate and confidential steps to connect with professional mental health support whenever you need it.
                </p>
            </div>

            <div class="gh-steps-container">
                <!-- Animated Connecting Flow Line across steps -->
                <div class="gh-steps-track-line"></div>

                <div class="gh-steps-row">
                    <!-- Step 1 -->
                    <div class="gh-step-card">
                        <div class="gh-step-top">
                            <div class="gh-step-icon-wrap">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <span class="gh-step-number-watermark">01</span>
                        </div>
                        <span class="gh-step-pill-tag">
                            <i class="fas fa-bolt"></i> Instant & Free
                        </span>
                        <h3 class="gh-step-title">Choose WhatsApp or email</h3>
                        <p class="gh-step-text">Select the channel that feels most comfortable, accessible, and safe for you to reach out.</p>
                        <div class="gh-step-footer">
                            <button class="gh-step-action-link" onclick="openPopupWithChannel('whatsapp'); return false;">
                                <span>Start conversation</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="gh-step-card">
                        <div class="gh-step-top">
                            <div class="gh-step-icon-wrap">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="gh-step-number-watermark">02</span>
                        </div>
                        <span class="gh-step-pill-tag">
                            <i class="fas fa-lock"></i> 100% Confidential
                        </span>
                        <h3 class="gh-step-title">Speak privately with a specialist</h3>
                        <p class="gh-step-text">Share what you're experiencing in a judgment-free, fully protected and compassionate space.</p>
                        <div class="gh-step-footer">
                            <button class="gh-step-action-link" onclick="openPopupWithChannel('whatsapp'); return false;">
                                <span>Certified specialists</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="gh-step-card">
                        <div class="gh-step-top">
                            <div class="gh-step-icon-wrap">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <span class="gh-step-number-watermark">03</span>
                        </div>
                        <span class="gh-step-pill-tag">
                            <i class="fas fa-hands-helping"></i> Ongoing Care
                        </span>
                        <h3 class="gh-step-title">Receive guidance & next steps</h3>
                        <p class="gh-step-text">Together we establish practical coping strategies, emotional relief, and ongoing tailored guidance.</p>
                        <div class="gh-step-footer">
                            <button class="gh-step-action-link" onclick="openPopupWithChannel('whatsapp'); return false;">
                                <span>Your path forward</span>
                                <i class="fas fa-arrow-right arrow-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 4. EASY ACCESS ══ -->
    <section class="gh-access-section">
        <div class="gh-container">
            <div class="gh-access-grid">
                <!-- Sculpted Organic Visual -->
                <div class="gh-access-visual-wrap">
                    <div class="gh-access-ambient-blob"></div>

                    <!-- Floating Badge 1: Live Status -->
                    <div class="gh-floating-pulse-badge">
                        <span class="pulse-dot"></span>
                        <span>Direct & Ready to Listen</span>
                    </div>

                    <!-- Sculpted Frame with Gaza Children Photo -->
                    <div class="gh-access-frame">
                        <img src="{{ asset('reachout/img/gethelp_children_support.jpg') }}" alt="Mental Health Support in Gaza - Children Supporting Each Other">
                    </div>

                </div>

                <!-- Content Area -->
                <div class="gh-access-content">
                    <span class="gh-pill">
                        <i class="fas fa-hand-holding-heart"></i> EASY & DIRECT ACCESS
                    </span>

                    <h2 class="gh-section-title">
                        Connect in moments.<br>
                        <span style="color: var(--gh-blue-primary);">Support that truly understands.</span>
                    </h2>

                    <p class="gh-access-lead">
                        Hardship and distance should never stand between you and mental well-being. Whether you are living through crisis, displaced, or carrying heavy emotional weight — qualified specialists are here to listen with empathy, dignity, and absolute confidentiality.
                    </p>

                    <div class="gh-access-points">
                        <div class="gh-access-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Direct, 1-on-1 private messaging via WhatsApp or Email</span>
                        </div>
                        <div class="gh-access-point">
                            <i class="fas fa-check-circle"></i>
                            <span>100% Free, ethical, and strictly confidential</span>
                        </div>
                        <div class="gh-access-point">
                            <i class="fas fa-check-circle"></i>
                            <span>Practical emotional first aid adapted to crisis realities</span>
                        </div>
                    </div>

                    <div class="gh-hero-actions" style="margin-bottom: 22px;">
                        <button class="gh-btn-wa" onclick="openPopupWithChannel('whatsapp'); return false;">
                            <i class="fab fa-whatsapp"></i>
                            <span>Start on WhatsApp</span>
                            <i class="fas fa-arrow-right arrow-icon"></i>
                        </button>
                        <button class="gh-btn-outline" onclick="openPopupWithChannel('email'); return false;">
                            <i class="fas fa-envelope"></i>
                            <span>Email us</span>
                            <i class="fas fa-arrow-right arrow-icon"></i>
                        </button>
                    </div>

                    <p class="gh-access-subtext">Different places. The same human warmth and care. ♡</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 5. WHAT TO EXPECT ══ -->
    <section class="gh-expect-section">
        <div class="gh-container">
            <div class="gh-expect-header">
                <span class="gh-pill">WHAT TO EXPECT</span>
                <h2 class="gh-section-title">A supportive process, from start to next steps.</h2>
            </div>

            <div class="gh-flow-track">
                <!-- Step 1 -->
                <div class="gh-flow-step" data-step="1">
                    <div class="gh-flow-icon"><i class="fas fa-comments"></i></div>
                    <h4>A confidential conversation</h4>
                    <p>Talk about what you're experiencing in a safe space.</p>
                </div>

                <div class="gh-flow-arrow"><i class="fas fa-chevron-right"></i></div>

                <!-- Step 2 -->
                <div class="gh-flow-step" data-step="2">
                    <div class="gh-flow-icon"><i class="fas fa-heart"></i></div>
                    <h4>Understanding your needs</h4>
                    <p>We listen and explore the best way to support you.</p>
                </div>

                <div class="gh-flow-arrow"><i class="fas fa-chevron-right"></i></div>

                <!-- Step 3 -->
                <div class="gh-flow-step" data-step="3">
                    <div class="gh-flow-icon"><i class="fas fa-clipboard-check"></i></div>
                    <h4>Practical guidance</h4>
                    <p>You receive strategies and support based on your needs.</p>
                </div>

                <div class="gh-flow-arrow"><i class="fas fa-chevron-right"></i></div>

                <!-- Step 4 -->
                <div class="gh-flow-step" data-step="4">
                    <div class="gh-flow-icon"><i class="fas fa-people-arrows"></i></div>
                    <h4>Referral if appropriate</h4>
                    <p>We help connect you with specialized services where available.</p>
                </div>
            </div>


            <!-- Alerts Row -->
            <div class="gh-alerts-row">
                <!-- Privacy Note -->
                <div class="gh-alert-box policy">
                    <div class="gh-alert-icon"><i class="fas fa-shield-halved"></i></div>
                    <div class="gh-alert-content">
                        <h4>Your privacy matters</h4>
                        <p>Please review our service guidelines to understand how we protect your privacy and ensure safe, ethical communication.</p>
                        <a href="{{ route('policies') }}" class="gh-alert-link">
                            <span>View service policies</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Emergency Disclaimer -->
                <div class="gh-alert-box emergency">
                    <div class="gh-alert-icon"><i class="fas fa-triangle-exclamation"></i></div>
                    <div class="gh-alert-content">
                        <h4>If you are in immediate danger</h4>
                        <p>Please seek local emergency help where available. Our service is not a crisis or emergency service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 6. BOTTOM BANNER CTA ══ -->
    <section class="gh-bottom-cta">
        <!-- Background: boy image pinned to far right -->
        <div class="gh-cta-bg-layer">
            <img src="{{ asset('reachout/img/gethelp_twilight_hope.jpg') }}" alt="Child from Gaza - Mental Health Frontline" class="gh-cta-bg-img">
            <div class="gh-cta-overlay"></div>
        </div>
        <div class="gh-container">
            <div class="gh-bottom-cta-inner">
                <div>
                    <span class="gh-pill">SUPPORT STARTS WITH A CONVERSATION</span>
                    <h2 class="gh-bottom-cta-title">You do not have<br>to face this alone.</h2>
                    <p class="gh-bottom-cta-desc">We are here to listen.</p>

                    <div class="gh-bottom-cta-actions">
                        <button class="gh-btn-wa" onclick="openPopupWithChannel('whatsapp'); return false;">
                            <i class="fab fa-whatsapp"></i>
                            <span>Start on WhatsApp</span>
                            <i class="fas fa-arrow-right arrow-icon"></i>
                        </button>
                        <button class="gh-btn-outline" onclick="openPopupWithChannel('email'); return false;">
                            <i class="fas fa-envelope"></i>
                            <span>Email us</span>
                            <i class="fas fa-arrow-right arrow-icon"></i>
                        </button>
                    </div>
                </div>

                <div class="gh-bottom-cta-script">
                    <span>Hope Still<br>Lives Here</span>
                    <span class="heart">♡</span>
                </div>
            </div>
        </div>
    </section>

</main>

@include('frontend.popup')

@endsection

@section('scripts')
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
</script>
@endsection
