@extends('frontend.layouts.main')

@section('title', 'About Us - Mental Health Frontline')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
/* ════════════════════════════════════════════════════════════════
   ABOUT US - REACHOUT BRAND DESIGN SYSTEM
════════════════════════════════════════════════════════════════ */
:root {
    --ab-bg: #ffffff;
    --ab-bg-card: #ffffff;
    --ab-bg-soft: #f8fafc;
    --ab-navy-deep: #0a2a4a;
    --ab-navy-dark: #071f36;
    --ab-navy-light: #163a66;
    --ab-blue-primary: #184B89;
    --ab-blue-medium: #1a4fa0;
    --ab-blue-light: #eef4fc;
    --ab-blue-badge: #dbeafe;
    --ab-accent-red: #c0392b;
    --ab-accent-red-hover: #a93226;
    --ab-text-dark: #0a2a4a;
    --ab-text-body: #2c3e50;
    --ab-text-muted: #5a6e85;
    --ab-border: #e2e8f0;
    --ab-border-light: #edf2f7;
    --ab-border-blue: #bfdbfe;
}

body {
    background-color: var(--ab-bg);
    color: var(--ab-text-body);
    font-family: 'Inter', 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    -webkit-font-smoothing: antialiased;
}

.font-display {
    font-family: 'Caprasimo', cursive;
    letter-spacing: 0.2px;
}

.font-script {
    font-family: 'Caveat', cursive;
}

.ab-page-wrap {
    padding-top: 80px; /* offset fixed navbar */
    overflow-x: hidden;
}

@media (max-width: 860px) {
    .ab-page-wrap {
        padding-top: 72px;
    }
}

@media (max-width: 480px) {
    .ab-page-wrap {
        padding-top: 68px;
    }
}

/* Category / Section Pills */
.ab-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--ab-blue-primary);
    background: var(--ab-blue-light);
    border: 1px solid var(--ab-border-blue);
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 16px;
    width: fit-content;
    max-width: max-content;
    align-self: flex-start;
}

.ab-pill.light {
    background: rgba(255, 255, 255, 0.14);
    color: #93c5fd;
    border-color: rgba(255, 255, 255, 0.22);
}

/* Reusable Section Headers */
.ab-title-main {
    font-size: clamp(32px, 4.2vw, 50px);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.025em;
    color: var(--ab-text-dark);
    margin-bottom: 20px;
}

.ab-title-main.light {
    color: #ffffff;
}

.ab-lead-text {
    font-size: clamp(16px, 1.25vw, 18px);
    line-height: 1.7;
    color: var(--ab-text-body);
    margin-bottom: 28px;
}

/* Base Buttons */
.ab-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--ab-blue-primary);
    color: #ffffff;
    font-size: 14.5px;
    font-weight: 700;
    padding: 13px 28px;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.25);
}

.ab-btn-primary:hover {
    background: var(--ab-navy-deep);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(10, 42, 74, 0.35);
}

.ab-btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--ab-blue-primary);
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 28px;
    border-radius: 50px;
    border: 1.5px solid var(--ab-blue-primary);
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.20);
}

.ab-btn-ghost:hover {
    background: var(--ab-navy-deep);
    border-color: var(--ab-navy-deep);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(10, 42, 74, 0.30);
}

/* Image Frame & Script Annotations */
.ab-media-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 16px 36px rgba(10, 42, 74, 0.10);
}

.ab-media-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ab-media-card:hover img {
    transform: scale(1.025);
}

.ab-floating-script {
    position: absolute;
    color: #ffffff;
    font-size: 32px;
    font-weight: 700;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.75), 0 1px 3px rgba(0, 0, 0, 0.9);
    z-index: 3;
    pointer-events: none;
    line-height: 1.15;
    transform: rotate(-3deg);
}

/* ════════════════════════════════════════════════════════════════
   1. HERO SECTION (CINEMATIC ABOUT US HERO)
════════════════════════════════════════════════════════════════ */
.ab-hero-cinematic {
    position: relative;
    padding: 100px 24px;
    min-height: calc(100vh - 80px);
    min-height: 560px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0a1829;
}

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
    object-position: right 30%;
    filter: brightness(0.96) contrast(1.02);
}

.ro-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(10, 24, 42, 0.76) 0%,
        rgba(10, 24, 42, 0.62) 38%,
        rgba(10, 24, 42, 0.32) 65%,
        rgba(10, 24, 42, 0.08) 85%,
        rgba(10, 24, 42, 0) 100%
    );
}

.ro-hero-container {
    max-width: 1240px;
    width: 100%;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 3;
    display: flex;
    justify-content: flex-start;
}

.ab-hero-content-box {
    max-width: 620px;
    width: 100%;
}

.ab-hero-eyebrow {
    display: inline-block;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #93c5fd;
    margin-bottom: 20px;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
}

.ab-hero-title-white {
    font-size: clamp(38px, 4.6vw, 58px);
    font-weight: 800;
    line-height: 1.16;
    color: #ffffff !important;
    margin: 0 0 24px 0;
    letter-spacing: -0.025em;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.20);
}

.ab-hero-lead-white {
    font-size: clamp(16.5px, 1.25vw, 19px);
    line-height: 1.75;
    color: rgba(255, 255, 255, 0.94);
    margin: 0 0 36px 0;
    max-width: 580px;
    font-weight: 500;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.20);
}

.ab-hero-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-ab-hero-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    color: var(--ab-navy-deep);
    padding: 15px 34px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.btn-ab-hero-white:hover {
    background: #eef4fc;
    color: var(--ab-blue-primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.btn-ab-hero-white i {
    transition: transform 0.25s ease;
}

.btn-ab-hero-white:hover i {
    transform: translateY(3px);
}

.btn-ab-hero-outline {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.10);
    border: 1.5px solid rgba(255, 255, 255, 0.35);
    color: #ffffff;
    padding: 14px 30px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    backdrop-filter: blur(8px);
}

.btn-ab-hero-outline:hover {
    background: rgba(255, 255, 255, 0.20);
    border-color: #ffffff;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.btn-ab-hero-outline i {
    transition: transform 0.25s ease;
}

.btn-ab-hero-outline:hover i {
    transform: translateX(4px);
}

/* ════════════════════════════════════════════════════════════════
   2. WHO WE ARE (DUAL LAYERED COLLAGE)
════════════════════════════════════════════════════════════════ */
.ab-section-who {
    padding: 100px 24px 90px;
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
}

.ab-who-grid {
    display: grid;
    grid-template-columns: 1.05fr 1.15fr;
    gap: 68px;
    align-items: center;
}

/* Dual Layered Collage Container */
.ab-who-collage {
    position: relative;
    padding-bottom: 50px;
    padding-right: 40px;
}

/* Background Subtle Decorative Accent */
.ab-who-collage-decor {
    position: absolute;
    top: -24px;
    left: -24px;
    width: 220px;
    height: 220px;
    border-radius: 32px;
    background: linear-gradient(135deg, rgba(24, 75, 137, 0.08) 0%, rgba(10, 42, 74, 0.02) 100%);
    z-index: 0;
    pointer-events: none;
    border: 1px dashed rgba(24, 75, 137, 0.15);
}

/* Primary Image Frame (Children in Gaza on tire) */
.ab-who-main-frame {
    position: relative;
    z-index: 1;
    border-radius: 22px;
    overflow: hidden;
    height: 430px;
    box-shadow: 0 20px 48px rgba(10, 42, 74, 0.12), 0 4px 16px rgba(0, 0, 0, 0.04);
    background: #000;
}

.ab-who-main-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ab-who-main-frame:hover img {
    transform: scale(1.03);
}

/* Floating Top-Left Tag */
.ab-who-badge-top {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(10, 42, 74, 0.85);
    backdrop-filter: blur(8px);
    color: #ffffff;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12.5px;
    font-weight: 700;
    letter-spacing: 0.02em;
    border: 1px solid rgba(255, 255, 255, 0.20);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
}

.ab-who-badge-top i {
    color: #93c5fd;
}

/* Secondary Overlapping Inset Frame (Counseling / Comforting Support) */
.ab-who-sub-frame {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 250px;
    height: 200px;
    z-index: 4;
    border-radius: 18px;
    border: 5px solid #ffffff;
    box-shadow: 0 18px 40px rgba(10, 42, 74, 0.22), 0 6px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    background: #ffffff;
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
}

.ab-who-sub-frame:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 24px 48px rgba(10, 42, 74, 0.28);
}

.ab-who-sub-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Caption on Sub-frame */
.ab-sub-frame-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px 14px;
    background: linear-gradient(to top, rgba(10, 42, 74, 0.92) 0%, rgba(10, 42, 74, 0.4) 70%, transparent 100%);
    color: #ffffff;
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
}

.ab-sub-frame-caption i {
    color: #ef4444;
}

/* Content Area */
.ab-who-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.ab-who-highlights {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    width: 100%;
    margin: 28px 0 34px 0;
}

.ab-who-pill-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #ffffff;
    border: 1.5px solid var(--ab-border);
    padding: 14px 18px;
    border-radius: 14px;
    transition: all 0.25s ease;
    box-shadow: 0 2px 10px rgba(10, 42, 74, 0.03);
}

.ab-who-pill-box:hover {
    border-color: var(--ab-blue-primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(24, 75, 137, 0.08);
}

.ab-who-pill-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--ab-blue-light);
    color: var(--ab-blue-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.ab-who-pill-text {
    display: flex;
    flex-direction: column;
}

.ab-who-pill-text strong {
    font-size: 14px;
    font-weight: 800;
    color: var(--ab-navy-deep);
    line-height: 1.25;
}

.ab-who-pill-text span {
    font-size: 12px;
    color: var(--ab-text-muted);
    line-height: 1.3;
    margin-top: 2px;
}

.ab-who-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
    width: 100%;
}

/* ════════════════════════════════════════════════════════════════
   3. MISSION & VISION (SOFT, CALM & ELEGANT DESIGN)
════════════════════════════════════════════════════════════════ */
.ab-section-mv {
    padding: 10px 24px 75px;
    max-width: 1280px;
    margin: 0 auto;
}

.ab-mv-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
}

.ab-mv-card {
    background: #ffffff;
    border: 1.5px solid #edf2f7;
    border-radius: 20px;
    padding: 36px 34px 30px;
    box-shadow: 0 4px 20px -2px rgba(10, 42, 74, 0.04), 0 2px 6px -1px rgba(0, 0, 0, 0.02);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

/* Delicate 3px accent line on top */
.ab-mv-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3.5px;
    background: linear-gradient(90deg, var(--ab-blue-primary), #60a5fa);
    transition: height 0.3s ease;
}

.ab-mv-card.vision::before {
    background: linear-gradient(90deg, #0284c7, #38bdf8);
}

.ab-mv-card:hover {
    transform: translateY(-4px);
    border-color: #dbeafe;
    box-shadow: 0 16px 36px -6px rgba(10, 42, 74, 0.08), 0 4px 12px rgba(0, 0, 0, 0.02);
}

.ab-mv-card:hover::before {
    height: 4.5px;
}

/* Top Row: Pill Tag & Soft Icon */
.ab-mv-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.ab-mv-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--ab-blue-primary);
    background: #eef4fc;
    border: 1px solid #dbeafe;
    padding: 5px 14px;
    border-radius: 50px;
}

.ab-mv-tag.vision {
    color: #0369a1;
    background: #f0f9ff;
    border-color: #e0f2fe;
}

.ab-mv-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #f0f6ff;
    color: var(--ab-blue-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    border: 1px solid #e0ecfb;
    transition: all 0.3s ease;
}

.ab-mv-icon.vision {
    background: #f0f9ff;
    color: #0284c7;
    border-color: #e0f2fe;
}

.ab-mv-card:hover .ab-mv-icon {
    transform: scale(1.06);
    background: var(--ab-blue-primary);
    color: #ffffff;
    border-color: var(--ab-blue-primary);
}

.ab-mv-card.vision:hover .ab-mv-icon {
    background: #0284c7;
    color: #ffffff;
    border-color: #0284c7;
}

/* Card Content */
.ab-mv-heading {
    font-size: 20px;
    font-weight: 800;
    color: var(--ab-navy-deep);
    margin: 0 0 12px 0;
    letter-spacing: -0.02em;
    line-height: 1.35;
}

.ab-mv-text {
    font-size: 15.5px;
    line-height: 1.7;
    color: #4b5d73;
    margin: 0 0 22px 0;
    font-weight: 400;
}

/* Bottom Quiet Reassurance Badges */
.ab-mv-pills {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
}

.ab-mv-pill-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #556987;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 4px 10px;
    border-radius: 6px;
}

.ab-mv-pill-item i {
    font-size: 10px;
    color: var(--ab-blue-primary);
}

.ab-mv-card.vision .ab-mv-pill-item i {
    color: #0284c7;
}

/* ════════════════════════════════════════════════════════════════
   4. WHY WE EXIST
════════════════════════════════════════════════════════════════ */
.ab-section-why {
    padding: 60px 24px 100px;
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
}

.ab-why-grid {
    display: grid;
    grid-template-columns: 1.12fr 1.08fr;
    gap: 60px;
    align-items: center;
}

.ab-why-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

/* Why We Exist Feature Points */
.ab-why-points {
    display: flex;
    flex-direction: column;
    gap: 14px;
    width: 100%;
    margin-top: 6px;
    margin-bottom: 28px;
}

.ab-why-point-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #ffffff;
    border: 1.5px solid var(--ab-border);
    padding: 14px 18px;
    border-radius: 14px;
    transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(10, 42, 74, 0.02);
}

.ab-why-point-item:hover {
    border-color: var(--ab-blue-primary);
    transform: translateX(4px);
    box-shadow: 0 6px 18px rgba(24, 75, 137, 0.06);
}

.ab-why-point-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: var(--ab-blue-light);
    color: var(--ab-blue-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    margin-top: 1px;
}

.ab-why-point-body {
    display: flex;
    flex-direction: column;
}

.ab-why-point-body strong {
    font-size: 14.5px;
    font-weight: 800;
    color: var(--ab-navy-deep);
    margin-bottom: 2px;
    line-height: 1.3;
}

.ab-why-point-body span {
    font-size: 13px;
    line-height: 1.5;
    color: var(--ab-text-muted);
}

/* Image Showcase Frame */
.ab-why-img-wrap {
    position: relative;
    border-radius: 22px;
    overflow: hidden;
    height: 500px;
    box-shadow: 0 24px 50px -12px rgba(10, 42, 74, 0.20), 0 6px 18px rgba(0, 0, 0, 0.06);
    background: #000;
}

.ab-why-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 22% 35%;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ab-why-img-wrap:hover img {
    transform: scale(1.03);
}

/* Floating Top Badge on Photo */
.ab-why-badge-top {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(10, 42, 74, 0.85);
    backdrop-filter: blur(8px);
    color: #ffffff;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.04em;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
}

.ab-why-badge-top i {
    color: #f87171;
}

/* Bottom Caption Scrim */
.ab-why-caption-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 3;
    padding: 45px 28px 22px;
    background: linear-gradient(to top, rgba(10, 24, 42, 0.94) 0%, rgba(10, 24, 42, 0.62) 65%, transparent 100%);
    color: #ffffff;
    display: flex;
    flex-direction: column;
}

.ab-why-quote-text {
    font-size: 27px;
    font-weight: 700;
    line-height: 1.25;
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
    margin-bottom: 4px;
}

.ab-why-caption-sub {
    font-size: 12.5px;
    color: #93c5fd;
    font-weight: 600;
    letter-spacing: 0.02em;
}

/* ════════════════════════════════════════════════════════════════
   5. OUR ROLE (BRAND NAVY BANNER)
════════════════════════════════════════════════════════════════ */
/* ════════════════════════════════════════════════════════════════
   5. OUR ROLE (BRAND NAVY BANNER - COMPACT & BALANCED)
════════════════════════════════════════════════════════════════ */
.ab-section-role {
    background: linear-gradient(140deg, #0a2a4a 0%, #0d355e 50%, #163a66 100%);
    color: #ffffff;
    padding: 46px 24px 48px;
}

.ab-role-container {
    max-width: 1280px;
    margin: 0 auto;
}

.ab-role-header {
    text-align: center;
    max-width: 780px;
    margin: 0 auto 28px;
}

.ab-role-header .ab-pill {
    color: #93c5fd;
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.22);
    margin-bottom: 10px;
    padding: 4px 14px;
    font-size: 11px;
}

.ab-role-header h2 {
    color: #ffffff;
    font-size: clamp(22px, 2.2vw, 30px);
    font-weight: 800;
    line-height: 1.25;
    letter-spacing: -0.015em;
    margin: 0 0 8px 0;
}

.ab-role-header p {
    color: #cbdcf5;
    font-size: 14.5px;
    line-height: 1.5;
    margin: 0;
}

.ab-role-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.ab-role-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.13);
    border-radius: 14px;
    padding: 22px 18px 20px;
    text-align: center;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.ab-role-card:hover {
    background: rgba(255, 255, 255, 0.11);
    border-color: rgba(147, 197, 253, 0.45);
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22);
}

.ab-role-icon {
    font-size: 24px;
    color: #93c5fd;
    margin-bottom: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    width: 36px;
}

.ab-role-card p {
    color: #e2e8f0;
    font-size: 13.5px;
    line-height: 1.45;
    margin: 0;
}

.ab-role-card strong {
    color: #ffffff;
    font-weight: 700;
}

/* ════════════════════════════════════════════════════════════════
   6. OUR APPROACH (4 STEPS)
════════════════════════════════════════════════════════════════ */
/* ════════════════════════════════════════════════════════════════
   6. OUR APPROACH (4 STEPS - SOFT & BALANCED)
════════════════════════════════════════════════════════════════ */
.ab-section-approach {
    padding: 75px 24px 85px;
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
}

.ab-approach-header {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 44px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.ab-approach-header .ab-pill {
    align-self: center !important;
    margin-left: auto;
    margin-right: auto;
}

.ab-approach-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.ab-step-card {
    background: #ffffff;
    border: 1.5px solid #edf2f7;
    border-radius: 18px;
    padding: 28px 22px 24px;
    box-shadow: 0 4px 18px rgba(10, 42, 74, 0.03), 0 1px 3px rgba(0, 0, 0, 0.02);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
    animation: abStepCardGlow 6s infinite ease-in-out;
}

/* Staggered sequential wave across the 4 steps */
.ab-approach-grid .ab-step-card:nth-child(1) { animation-delay: 0s; }
.ab-approach-grid .ab-step-card:nth-child(2) { animation-delay: 1.5s; }
.ab-approach-grid .ab-step-card:nth-child(3) { animation-delay: 3s; }
.ab-approach-grid .ab-step-card:nth-child(4) { animation-delay: 4.5s; }

.ab-approach-grid .ab-step-card:nth-child(1) .ab-step-icon,
.ab-approach-grid .ab-step-card:nth-child(1) .ab-step-line::after { animation-delay: 0s; }

.ab-approach-grid .ab-step-card:nth-child(2) .ab-step-icon,
.ab-approach-grid .ab-step-card:nth-child(2) .ab-step-line::after { animation-delay: 1.5s; }

.ab-approach-grid .ab-step-card:nth-child(3) .ab-step-icon,
.ab-approach-grid .ab-step-card:nth-child(3) .ab-step-line::after { animation-delay: 3s; }

.ab-approach-grid .ab-step-card:nth-child(4) .ab-step-icon,
.ab-approach-grid .ab-step-card:nth-child(4) .ab-step-line::after { animation-delay: 4.5s; }

@keyframes abStepCardGlow {
    0%, 100% {
        border-color: #edf2f7;
        box-shadow: 0 4px 18px rgba(10, 42, 74, 0.03), 0 0 0 rgba(56, 189, 248, 0);
    }
    50% {
        border-color: #93c5fd;
        box-shadow: 0 8px 26px -2px rgba(24, 75, 137, 0.08), 0 0 20px rgba(56, 189, 248, 0.22);
    }
}

/* Card Top Row */
.ab-step-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}

.ab-step-badge {
    display: inline-flex;
    align-items: center;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.12em;
    color: var(--ab-blue-primary);
    background: #f0f6ff;
    border: 1px solid #dbeafe;
    padding: 4px 12px;
    border-radius: 50px;
}

.ab-step-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--ab-blue-light);
    color: var(--ab-blue-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    border: 1px solid #e0ecfb;
    transition: all 0.25s ease;
    animation: abStepIconGlow 6s infinite ease-in-out;
}

@keyframes abStepIconGlow {
    0%, 100% {
        border-color: #e0ecfb;
        background: var(--ab-blue-light);
        color: var(--ab-blue-primary);
    }
    50% {
        border-color: #93c5fd;
        background: #e0f2fe;
        color: #0284c7;
        box-shadow: 0 0 12px rgba(56, 189, 248, 0.3);
    }
}

/* Card Content */
.ab-step-title {
    font-size: 21px;
    font-weight: 800;
    color: var(--ab-navy-deep);
    margin: 0 0 4px 0;
    letter-spacing: -0.015em;
}

.ab-step-sub {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 12px;
    display: inline-block;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.ab-step-desc {
    font-size: 14px;
    line-height: 1.65;
    color: #4b5d73;
    margin: 0 0 18px 0;
    font-weight: 400;
}

/* Bottom Progress Line Accent */
.ab-step-line {
    height: 3px;
    width: 100%;
    background: #f1f5f9;
    border-radius: 3px;
    overflow: hidden;
    position: relative;
    margin-top: auto;
}

.ab-step-line::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 25%;
    background: var(--ab-blue-primary);
    transition: width 0.35s ease;
    animation: abStepLineGlow 6s infinite ease-in-out;
}

@keyframes abStepLineGlow {
    0%, 100% {
        width: 25%;
        background: var(--ab-blue-primary);
    }
    50% {
        width: 60%;
        background: linear-gradient(90deg, var(--ab-blue-primary), #38bdf8);
        box-shadow: 0 0 8px rgba(56, 189, 248, 0.35);
    }
}

/* User Hover Overrides */
.ab-step-card:hover {
    border-color: var(--ab-blue-primary);
    transform: translateY(-4px);
    box-shadow: 0 14px 32px -4px rgba(24, 75, 137, 0.12), 0 0 24px rgba(56, 189, 248, 0.28);
    animation-play-state: paused;
}

.ab-step-card:hover .ab-step-icon {
    transform: scale(1.06);
    background: var(--ab-blue-primary);
    color: #ffffff;
    border-color: var(--ab-blue-primary);
    animation-play-state: paused;
}

.ab-step-card:hover .ab-step-line::after {
    width: 100%;
    background: linear-gradient(90deg, var(--ab-blue-primary), #38bdf8);
    animation-play-state: paused;
}

/* ════════════════════════════════════════════════════════════════
   7. WHO WE SERVE (ARCH PORTAL & DUO COMPOSITION)
════════════════════════════════════════════════════════════════ */
.ab-section-serve {
    padding: 70px 24px 105px;
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
}

.ab-serve-grid {
    display: grid;
    grid-template-columns: 1.08fr 1.12fr;
    gap: 64px;
    align-items: center;
}

.ab-serve-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.ab-serve-list {
    list-style: none;
    padding: 0;
    margin: 0 0 28px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
}

.ab-serve-item {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 15px;
    font-weight: 600;
    color: var(--ab-text-dark);
    background: #ffffff;
    border: 1px solid var(--ab-border);
    padding: 11px 16px;
    border-radius: 12px;
    transition: all 0.25s ease;
    box-shadow: 0 2px 6px rgba(10, 42, 74, 0.02);
}

.ab-serve-item:hover {
    border-color: var(--ab-blue-primary);
    transform: translateX(4px);
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.06);
}

.ab-serve-item i {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--ab-blue-light);
    color: var(--ab-blue-primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    flex-shrink: 0;
}

/* Arch Showcase Wrapper (Non-Rectangular Design) */
.ab-serve-showcase {
    position: relative;
    padding-bottom: 30px;
    padding-right: 30px;
}

/* Offset Decorative Dashed Arch Outline */
.ab-serve-arch-decor {
    position: absolute;
    top: -12px;
    left: -12px;
    width: calc(100% - 20px);
    height: calc(100% - 20px);
    border: 2px dashed rgba(24, 75, 137, 0.22);
    border-radius: 220px 220px 32px 32px;
    pointer-events: none;
    z-index: 0;
    transition: transform 0.4s ease, border-color 0.4s ease;
}

.ab-serve-showcase:hover .ab-serve-arch-decor {
    transform: scale(1.02) rotate(-1deg);
    border-color: rgba(24, 75, 137, 0.4);
}

/* Main Arch Photo Frame (Toddler looking up with hope) */
.ab-serve-arch-frame {
    position: relative;
    z-index: 1;
    border-radius: 210px 210px 28px 28px;
    overflow: hidden;
    height: 470px;
    box-shadow: 0 24px 50px -10px rgba(10, 42, 74, 0.20), 0 6px 18px rgba(0, 0, 0, 0.06);
    background: #000;
}

.ab-serve-arch-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 45% 35%;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.ab-serve-arch-frame:hover img {
    transform: scale(1.03);
}

/* Top Floating Tag on Arch */
.ab-serve-badge-top {
    position: absolute;
    top: 24px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(10, 42, 74, 0.85);
    backdrop-filter: blur(8px);
    color: #ffffff;
    padding: 7px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.03em;
    border: 1px solid rgba(255, 255, 255, 0.22);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
    white-space: nowrap;
}

.ab-serve-badge-top i {
    color: #93c5fd;
}

/* Secondary Floating Inset Photo (Girl with yellow water container) */
.ab-serve-inset-frame {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 200px;
    height: 170px;
    z-index: 4;
    border-radius: 20px;
    border: 4.5px solid #ffffff;
    box-shadow: 0 18px 40px rgba(10, 42, 74, 0.25), 0 6px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    background: #ffffff;
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
}

.ab-serve-inset-frame:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 24px 48px rgba(10, 42, 74, 0.32);
}

.ab-serve-inset-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 25%;
    display: block;
}

.ab-serve-inset-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 8px 12px;
    background: linear-gradient(to top, rgba(10, 24, 42, 0.94) 0%, rgba(10, 24, 42, 0.5) 75%, transparent 100%);
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
}

.ab-serve-inset-caption i {
    color: #f87171;
}

/* Handwritten Script Quote Overlay */
.ab-serve-script {
    position: absolute;
    bottom: 28px;
    left: 28px;
    z-index: 3;
    color: #ffffff;
    font-size: 26px;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.75);
    line-height: 1.2;
    transform: rotate(-2deg);
    pointer-events: none;
}

/* ════════════════════════════════════════════════════════════════
   8. OUR VALUES (5 CARDS)
════════════════════════════════════════════════════════════════ */
.ab-section-values {
    padding: 90px 24px;
    background: var(--ab-bg-soft);
    border-top: 1px solid var(--ab-border);
    border-bottom: 1px solid var(--ab-border);
}

.ab-values-container {
    max-width: 1280px;
    margin: 0 auto;
}

.ab-values-header {
    margin-bottom: 45px;
}

.ab-values-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.ab-value-card {
    position: relative;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    padding: 32px 20px 26px 20px;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 16px rgba(10, 42, 74, 0.03);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Subtle colored accent line at the top */
.ab-value-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #184B89, #38bdf8);
    opacity: 0.35;
    transition: opacity 0.3s ease, height 0.3s ease;
}

.ab-value-card:hover::before {
    opacity: 1;
    height: 4px;
}

/* Watermark silhouette icon in the background */
.ab-value-watermark {
    position: absolute;
    right: -10px;
    bottom: -12px;
    font-size: 82px;
    color: #184B89;
    opacity: 0.035;
    transition: transform 0.4s ease, opacity 0.4s ease;
    pointer-events: none;
    user-select: none;
    z-index: 1;
}

.ab-value-card:hover .ab-value-watermark {
    opacity: 0.075;
    transform: rotate(-6deg) scale(1.08);
}

/* Minimalist index number tag (01, 02, ...) */
.ab-value-index {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: #94a3b8;
    background: #f8fafc;
    border: 1px solid #edf2f7;
    padding: 2px 7px;
    border-radius: 6px;
    line-height: 1;
    transition: all 0.3s ease;
    z-index: 2;
}

.ab-value-card:hover .ab-value-index {
    color: var(--ab-blue-primary);
    border-color: var(--ab-border-blue);
    background: var(--ab-blue-light);
}

.ab-value-card:hover {
    border-color: #bfdbfe;
    transform: translateY(-6px);
    box-shadow: 0 16px 36px -8px rgba(24, 75, 137, 0.14), 0 4px 12px rgba(0, 0, 0, 0.03);
}

.ab-value-icon {
    font-size: 23px;
    color: var(--ab-blue-primary);
    margin-bottom: 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f0f7ff 0%, #e2edfd 100%);
    box-shadow: 0 4px 14px rgba(24, 75, 137, 0.08), 0 0 0 5px #f4f8fe;
    position: relative;
    z-index: 2;
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
}

.ab-value-card:hover .ab-value-icon {
    transform: scale(1.1);
    box-shadow: 0 6px 18px rgba(24, 75, 137, 0.14), 0 0 0 6px #eef4fc;
}

.ab-value-title {
    font-size: 16.5px;
    font-weight: 800;
    color: var(--ab-text-dark);
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
    transition: color 0.25s ease;
}

.ab-value-card:hover .ab-value-title {
    color: var(--ab-blue-primary);
}

.ab-value-desc {
    font-size: 13.5px;
    line-height: 1.55;
    color: var(--ab-text-muted);
    margin: 0;
    position: relative;
    z-index: 2;
}

/* ════════════════════════════════════════════════════════════════
   9. IMPACT & SAFEGUARDING
════════════════════════════════════════════════════════════════ */
.ab-section-dual {
    padding: 70px 24px;
    max-width: 1280px;
    margin: 0 auto;
}

.ab-dual-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    align-items: stretch;
}

.ab-dual-panel {
    position: relative;
    background: #ffffff;
    border: 1.5px solid var(--ab-border);
    border-radius: 18px;
    padding: 36px 34px;
    box-shadow: 0 6px 24px rgba(10, 42, 74, 0.04);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.ab-dual-panel:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(10, 42, 74, 0.08);
}

/* Subtle top accent bar */
.ab-dual-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #184B89, #38bdf8);
    opacity: 0.4;
    transition: opacity 0.3s ease;
}

.ab-dual-panel:hover::before {
    opacity: 1;
}

/* Panel icon in corner */
.ab-dual-panel-icon {
    position: absolute;
    top: 16px;
    right: 18px;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: var(--ab-blue-light);
    border: 1px solid var(--ab-border-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    color: var(--ab-blue-primary);
    transition: transform 0.3s ease, background 0.3s ease;
}

.ab-dual-panel:hover .ab-dual-panel-icon {
    transform: scale(1.1);
    background: #dbeafe;
}

.ab-dual-panel .ab-pill {
    margin-bottom: 12px;
}

.ab-dual-panel .ab-btn-primary {
    margin-top: auto;
    align-self: flex-start;
}

.ab-dual-list {
    list-style: none;
    padding: 0;
    margin: 0 0 28px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ab-dual-list-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14.5px;
    color: var(--ab-text-body);
    font-weight: 500;
}

.ab-dual-list-item i {
    width: 21px;
    height: 21px;
    border-radius: 50%;
    background: var(--ab-blue-light);
    color: var(--ab-blue-primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    flex-shrink: 0;
}

/* ════════════════════════════════════════════════════════════════
   10. BOTTOM CALL TO ACTION (FLOATING WHITE CARD LIKE BACK-US)
════════════════════════════════════════════════════════════════ */
.ro-bottom-cta {
    position: relative;
    background: #f8fafc;
    padding: 36px 24px 50px 24px;
    border-top: 1px solid var(--ab-border);
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
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.ro-bottom-cta-inner:hover {
    transform: translateY(-2px);
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
    color: var(--ab-blue-primary);
    background: var(--ab-blue-light);
    border: 1px solid var(--ab-border-blue);
    padding: 4px 12px;
    border-radius: 100px;
    margin-bottom: 8px;
}

.cta-compact-pill i {
    color: var(--ab-accent-red);
}

.cta-left-text {
    max-width: 640px;
}

.cta-left-text h2 {
    font-size: clamp(21px, 2.2vw, 28px);
    font-weight: normal;
    color: var(--ab-navy-deep);
    margin-bottom: 6px;
    line-height: 1.25;
}

.cta-left-text p {
    font-size: 14.5px;
    color: var(--ab-text-muted);
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
    padding: 13px 30px;
    font-size: 14.5px;
    background: var(--ab-accent-red);
    color: #ffffff;
    border-radius: 50px;
    font-weight: 800;
    box-shadow: 0 6px 18px rgba(192, 57, 43, 0.35);
    transition: all 0.25s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-ro-compact:hover {
    background: var(--ab-accent-red-hover);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(192, 57, 43, 0.45);
}

.cta-handwritten-badge {
    font-size: 16.5px;
    color: var(--ab-accent-red);
    font-weight: 700;
    margin-top: 2px;
}

/* ════════════════════════════════════════════════════════════════
   RESPONSIVE STYLES
════════════════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
    .ab-hero-grid,
    .ab-who-grid,
    .ab-why-grid,
    .ab-serve-grid,
    .ab-dual-grid,
    .ab-mv-grid {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .ab-who-collage {
        max-width: 600px;
        margin: 0 auto;
        padding-right: 32px;
        padding-bottom: 36px;
    }

    .ab-who-main-frame {
        height: 380px;
    }

    .ab-who-sub-frame {
        width: 215px;
        height: 170px;
    }

    .ab-role-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .ab-approach-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .ab-values-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .ro-bottom-cta-inner {
        flex-direction: column;
        text-align: center;
        gap: 22px;
        padding: 30px 24px;
    }

    .cta-right-action {
        align-items: center;
    }
}

@media (max-width: 768px) {
    .ab-hero-cinematic {
        padding: 48px 20px 42px 20px !important;
        min-height: 380px !important;
        height: auto !important;
    }
    .ab-hero-content-box {
        text-align: center;
        margin: 0 auto;
        max-width: 100%;
    }
    .ab-hero-eyebrow {
        font-size: 11px;
        margin-bottom: 12px;
    }
    .ab-hero-title-white {
        font-size: clamp(23px, 6.8vw, 32px) !important;
        line-height: 1.25 !important;
        margin-bottom: 14px !important;
    }
    .ab-hero-lead-white {
        font-size: 14px !important;
        line-height: 1.55 !important;
        margin: 0 auto 22px auto !important;
        max-width: 440px;
    }
    .ab-hero-actions {
        justify-content: center;
        gap: 10px;
    }
    .btn-ab-hero-white, .btn-ab-hero-outline {
        padding: 12px 20px;
        font-size: 13.5px;
    }
}

@media (max-width: 640px) {
    .ab-hero-overlay {
        background: linear-gradient(
            to bottom,
            rgba(10, 24, 42, 0.85) 0%,
            rgba(10, 24, 42, 0.75) 55%,
            rgba(10, 24, 42, 0.40) 100%
        );
    }

    .ab-who-highlights {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .ab-who-collage {
        padding-right: 20px;
        padding-bottom: 26px;
    }

    .ab-who-main-frame {
        height: 290px;
        border-radius: 18px;
    }

    .ab-who-sub-frame {
        width: 175px;
        height: 140px;
        border-width: 3.5px;
        border-radius: 14px;
    }

    .ab-sub-frame-caption {
        font-size: 11px;
        padding: 6px 10px;
    }

    .ab-mv-grid,
    .ab-role-grid,
    .ab-approach-grid,
    .ab-values-grid {
        grid-template-columns: 1fr;
    }

    .ab-mv-card {
        padding: 28px 22px;
        border-radius: 16px;
    }

    .ab-hero-img-wrap,
    .ab-serve-img-wrap {
        height: 320px;
    }

    .ab-why-img-wrap {
        height: 350px;
        border-radius: 18px;
    }

    .ab-why-quote-text {
        font-size: 22px;
    }

    .ab-floating-script {
        font-size: 24px;
    }

    .ab-dual-panel {
        padding: 32px 24px;
    }
}

@media (max-width: 480px) {
    .ab-hero-cinematic {
        padding: 36px 16px 32px 16px !important;
        min-height: 340px !important;
    }
    .ab-hero-title-white {
        font-size: 25px !important;
    }
    .ab-hero-lead-white {
        font-size: 13.5px !important;
    }
    .ab-hero-actions {
        flex-direction: column;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }
    .btn-ab-hero-white, .btn-ab-hero-outline {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection

@section('content')
<div class="ab-page-wrap">

    <!-- ══ 1. HERO SECTION (CINEMATIC FULL-WIDTH BACKGROUND) ══ -->
    <section class="ab-hero-cinematic">
        <div class="ro-hero-bg-layer">
            <img src="{{ asset('reachout/img/about_hero_children.jpg') }}?v={{ filemtime(public_path('reachout/img/about_hero_children.jpg')) }}" alt="Children in Gaza - Mental Health Frontline" class="ro-hero-bg-img">
            <div class="ro-hero-overlay"></div>
        </div>

        <div class="ro-hero-container">
            <div class="ab-hero-content-box" style="margin-top: -80px;">
                <img src="{{ asset('reachout/img/logo3.png') }}?v={{ filemtime(public_path('reachout/img/logo3.png')) }}" alt="Mental Health Frontline" style="height: 145px; width: auto; margin-bottom: 22px; margin-left: 148px; display: block; filter: brightness(0) invert(1) drop-shadow(0 2px 8px rgba(0,0,0,0.4)); opacity: 1;">

                <h1 class="ab-hero-title-white" style="font-size: clamp(30px, 3.6vw, 48px);">
                    Mental health support,
                    <span style="display: block; font-size: 0.9em; font-weight: 700; opacity: 0.92;">Even when reaching care is difficult.</span>
                </h1>

                <p class="ab-hero-lead-white">
                    Mental Health Frontline is an independent initiative providing free psychological and
psychosocial support to people affected by conflict and displacement, through
accessible channels including WhatsApp and email.
                </p>

                <div class="ab-hero-actions">
                    <a href="#our-story" class="btn-ab-hero-white">
                        <span>Discover Our Story</span>
                        
                    </a>
                    <a href="#our-role" class="btn-ab-hero-outline">
                        <span>What We Do</span>
                        
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 2. WHO WE ARE (DUAL LAYERED COLLAGE) ══ -->
    <section class="ab-section-who" id="our-story">
        <div class="ab-who-grid">
            <!-- Left: Dual Layered Photo Collage -->
            <div class="ab-who-collage">
                <div class="ab-who-collage-decor"></div>

                <!-- Main Photo: Children of Gaza sitting on tire -->
                <div class="ab-who-main-frame">
                    <img src="{{ asset('reachout/img/about_who_we_are.jpg') }}?v={{ filemtime(public_path('reachout/img/about_who_we_are.jpg')) }}" alt="Children in Gaza - Mental Health Frontline">
                    <div class="ab-who-badge-top">
                        
                        <span>On-The-Ground Frontline</span>
                    </div>
                </div>

                <!-- Secondary Overlapping Inset: Compassionate Psychosocial Care -->
                <div class="ab-who-sub-frame">
                    <img src="{{ asset('reachout/img/about_comforting.jpg') }}?v={{ filemtime(public_path('reachout/img/about_comforting.jpg')) }}" alt="Compassionate mental health consultation">
                    <div class="ab-sub-frame-caption">
                        
                        <span>Safe & Dignified Care</span>
                    </div>
                </div>
            </div>

            <!-- Right: Content & Core Pillars -->
            <div class="ab-who-content">
                <span class="ab-pill"> WHO WE ARE</span>
                <h2 class="ab-title-main">
                    A more compassionate response to human suffering
                </h2>
                <p class="ab-lead-text" style="margin-bottom: 16px;">
                    Mental Health Frontline (MHF) is an independent mental health initiative providing free, confidential and professional psychological and psychosocial support to individuals and families affected by conflict, displacement and humanitarian crises.
                </p>
                <p class="ab-lead-text" style="font-size: 15px; color: var(--ab-text-muted); margin-bottom: 0;">
                    We are a team of mental health professionals, working with communities on the ground and through accessible digital channels to ensure that no one has to face their psychological challenges alone.
                </p>

                <!-- 2 Highlight Trust Pillars -->
                <div class="ab-who-highlights">
                    <div class="ab-who-pill-box">
                        
                        <div class="ab-who-pill-text">
                            <strong>Confidential Support</strong>
                            <span>Accessible Support</span>
                        </div>
                    </div>
                    <div class="ab-who-pill-box">
                        
                        <div class="ab-who-pill-text">
                            <strong>Free Psychological Support</strong>
                            <span>Reducing barriers to psychological support</span>
                        </div>
                    </div>
                </div>

                <div class="ab-who-actions" style="margin-top: -8px;">
                    <a href="#why-we-exist" class="ab-btn-ghost">
                        <span>Why We Exist</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 3. MISSION & VISION (SOFT & ELEGANT) ══ -->
    <section class="ab-section-mv">
        <div class="ab-mv-grid">
            <!-- Card 1: Our Mission -->
            <div class="ab-mv-card">
                <div>
                    <div class="ab-mv-top">
                        <span class="ab-mv-tag">
                             OUR MISSION
                        </span>
                        
                    </div>

                    <h3 class="ab-mv-heading">Accessible Support in Times of Crisis</h3>

                    <p class="ab-mv-text">
                        To make professional mental health and psychosocial support easier to access for people and families affected by conflict and humanitarian crises, with a focus on Gaza and other conflict-affected communities.
                    </p>
                </div>

                <div class="ab-mv-pills">
                    <span class="ab-mv-pill-item"> Accessible Support</span>
                    <span class="ab-mv-pill-item"> Professional Care</span>
                    <span class="ab-mv-pill-item"> Confidentiality</span>
                </div>
            </div>

            <!-- Card 2: Our Vision -->
            <div class="ab-mv-card vision">
                <div>
                    <div class="ab-mv-top">
                        <span class="ab-mv-tag vision">
                             OUR VISION
                        </span>
                        
                    </div>

                    <h3 class="ab-mv-heading">Stronger Communities Through Mental Health Support</h3>

                    <p class="ab-mv-text">
                        We envision conflict-affected communities where people and families can access compassionate mental health and psychosocial support without cost or distance placing it out of reach.
                    </p>
                </div>

                <div class="ab-mv-pills vision">
                    <span class="ab-mv-pill-item"> Compassion</span>
                    <span class="ab-mv-pill-item"> Resilience</span>
                    <span class="ab-mv-pill-item"> Hope</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 4. WHY WE EXIST ══ -->
    <section class="ab-section-why" id="why-we-exist">
        <div class="ab-why-grid">
            <div class="ab-why-content">
                <span class="ab-pill"> WHY WE EXIST</span>
                <h2 class="ab-title-main">
                    Why access matters
                </h2>
                <p class="ab-lead-text" style="margin-bottom: 24px;">
                    When reaching a clinic is difficult, asking for support can become another burden.
                    Cost, disrupted services and caring responsibilities can place help out of reach. MHF offers a practical way to start a conversation through familiar digital channels, without charging the person seeking support.
                </p>

                <!-- 3 Clear Impact Pillars -->
                <div class="ab-why-points">
                    <div class="ab-why-point-item">
                        
                        <div class="ab-why-point-body">
                            <strong>Protecting Children & Families</strong>
                            <span>Early trauma care to foster emotional stability and resilience amidst hardship.</span>
                        </div>
                    </div>
                    <div class="ab-why-point-item">
                        
                        <div class="ab-why-point-body">
                            <strong>Closing Healthcare Inequities</strong>
                            <span>Free and confidential psychological aid where conventional clinics cannot operate.</span>
                        </div>
                    </div>
                    <div class="ab-why-point-item">
                        
                        <div class="ab-why-point-body">
                            <strong>Preserving Human Dignity</strong>
                            <span>Compassionate, respectful support ensuring no person suffers their grief alone.</span>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Image Frame with Child Photo -->
            <div class="ab-media-card ab-why-img-wrap">
                <img src="{{ asset('reachout/img/about_why_we_exist_child.jpg') }}?v={{ filemtime(public_path('reachout/img/about_why_we_exist_child.jpg')) }}" alt="Child affected by conflict in Gaza - Why We Exist">


                <div class="ab-why-caption-bar">
                    <div class="ab-why-quote-text font-script">
                        “In the midst of crisis, there is still hope.”
                    </div>
                    <div class="ab-why-caption-sub">
                        
                        Frontline Psychological & Psychosocial Support
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 5. OUR ROLE (BRAND NAVY BANNER) ══ -->
    <section class="ab-section-role" id="our-role">
        <div class="ab-role-container">
            <div class="ab-role-header">
                <span class="ab-pill light">OUR ROLE</span>
                <h2 class="ab-title-main light">
                    Bridging gaps. Building stronger communities.
                </h2>
                <p>Mental Health Frontline plays a vital role in the mental health and humanitarian response by:</p>
            </div>

            <div class="ab-role-grid">
                <div class="ab-role-card">
                    
                    <p><strong>Improving access</strong> to timely mental health support</p>
                </div>

                <div class="ab-role-card">
                    
                    <p><strong>Providing an accessible</strong> first point of contact</p>
                </div>

                <div class="ab-role-card">
                    
                    <p><strong>Identifying needs and connecting</strong> individuals with appropriate services</p>
                </div>

                <div class="ab-role-card">
                    
                    <p><strong>Contributing to stronger,</strong> more inclusive and responsive mental health systems</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 6. OUR APPROACH (4 STEPS - SOFT & BALANCED) ══ -->
    <section class="ab-section-approach" id="our-approach">
        <div class="ab-approach-header">
            <span class="ab-pill"> OUR APPROACH</span>
            <h2 class="ab-title-main" style="margin-bottom: 8px;">How support works</h2>
            <p style="font-size: 15px; color: var(--ab-text-muted); margin: 0;">A clear, compassionate pathway ensuring safe, timely and dignified mental health support from first touch to recovery. </p>
            
        </div>

        <div class="ab-approach-grid">
            <!-- Step 01 -->
            <div class="ab-step-card">
                <div>
                    <div class="ab-step-header">
                        <span class="ab-step-badge">STEP 01</span>
                        
                    </div>
                    <h3 class="ab-step-title">Contact us</h3>
                    <p class="ab-step-desc">Reach out through WhatsApp or email to start a conversation.</p>
                </div>
                <div class="ab-step-line"></div>
            </div>

            <!-- Step 02 -->
            <div class="ab-step-card">
                <div>
                    <div class="ab-step-header">
                        <span class="ab-step-badge">STEP 02</span>
                        
                    </div>
                    <h3 class="ab-step-title">Tell us what is happening</h3>
                    <p class="ab-step-desc">We listen to your concerns and discuss what support may be appropriate.</p>
                </div>
                <div class="ab-step-line"></div>
            </div>

            <!-- Step 03 -->
            <div class="ab-step-card">
                <div>
                    <div class="ab-step-header">
                        <span class="ab-step-badge">STEP 03</span>
                        
                    </div>
                    <h3 class="ab-step-title">Receive practical support</h3>
                    <p class="ab-step-desc">Our team offers psychological support and guidance within the scope of the service.</p>
                </div>
                <div class="ab-step-line"></div>
            </div>

            <!-- Step 04 -->
            <div class="ab-step-card">
                <div>
                    <div class="ab-step-header">
                        <span class="ab-step-badge">STEP 04</span>
                        
                    </div>
                    <h3 class="ab-step-title">Agree on next steps</h3>
                    <p class="ab-step-desc">Depending on your needs and service availability, next steps may include follow-up or exploring options for additional care.</p>
                </div>
                <div class="ab-step-line"></div>
            </div>
        </div>
    </section>

    <!-- ══ 7. WHO WE SERVE (ARCH PORTAL & DUO COMPOSITION) ══ -->
    <section class="ab-section-serve">
        <div class="ab-serve-grid">
            <div class="ab-serve-content">
                <span class="ab-pill"> WHO WE SERVE</span>
                <h2 class="ab-title-main">People. Families. Communities.</h2>
                <p class="ab-lead-text" style="margin-bottom: 20px;">We support individuals, families and communities affected by:</p>
                <ul class="ab-serve-list">
                    <li class="ab-serve-item"> Conflict and armed violence</li>
                    <li class="ab-serve-item"> Displacement and forced migration</li>
                    <li class="ab-serve-item"> Humanitarian crises & acute deprivation</li>
                    <li class="ab-serve-item"> Loss, grief and prolonged psychological stress</li>
                    <li class="ab-serve-item"> Barriers to accessing essential mental health care</li>
                    <li class="ab-serve-item"> Vulnerable children and families in conflict zones</li>
                </ul>

                <a href="{{ route('backus') }}" class="ab-btn-primary">
                    <span>Stand With Them</span>
                    
                </a>
            </div>

            <!-- Architectural Arch Showcase with Floating Inset -->
            <div class="ab-serve-showcase">
                <div class="ab-serve-arch-decor"></div>

                <!-- Main Arch Photo: Toddler looking up with hope -->
                <div class="ab-serve-arch-frame">
                    <img src="{{ asset('reachout/img/about_serve_water.png') }}?v={{ filemtime(public_path('reachout/img/about_serve_water.png')) }}" alt="Children in Gaza - Who We Serve">

                    <div class="ab-serve-badge-top">
                        
                        <span>Frontline Humanitarian Care</span>
                    </div>

                    <div class="ab-serve-script font-script">
                        Stronger Children<br>Stronger Communities
                    </div>
                </div>

                <!-- Secondary Floating Inset: Young girl carrying water -->
                <div class="ab-serve-inset-frame">
                    <img src="{{ asset('reachout/img/about_serve_children.png') }}?v={{ filemtime(public_path('reachout/img/about_serve_children.png')) }}" alt="Child resilience in Gaza street">
                    <div class="ab-serve-inset-caption">
                        
                        <span>Dignity & Resilience</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ 8. OUR VALUES (5 CARDS) ══ -->
    <section class="ab-section-values">
        <div class="ab-values-container">
            <div class="ab-values-header">
                <span class="ab-pill"> OUR VALUES</span>
                <h2 class="ab-title-main" style="margin-bottom: 6px;">What guides us</h2>
                <p style="font-size: 15px; color: var(--ab-text-muted); margin: 0;">The foundational principles anchoring our humanitarian mission and care.</p>
            </div>

            <div class="ab-values-grid">
                <!-- 01 -->
                <div class="ab-value-card">
                    <span class="ab-value-index">01</span>
                    
                    <h3 class="ab-value-title">Humanity & Dignity</h3>
                    <p class="ab-value-desc">We treat every person with compassion and respect.</p>
                    
                </div>

                <!-- 02 -->
                <div class="ab-value-card">
                    <span class="ab-value-index">02</span>
                    
                    <h3 class="ab-value-title">Confidentiality</h3>
                    <p class="ab-value-desc">We understand privacy and trust of those we support.</p>
                    
                </div>

                <!-- 03 -->
                <div class="ab-value-card">
                    <span class="ab-value-index">03</span>
                    
                    <h3 class="ab-value-title">Professionalism</h3>
                    <p class="ab-value-desc">We provide responsible, evidence-informed support.</p>
                    
                </div>

                <!-- 04 -->
                <div class="ab-value-card">
                    <span class="ab-value-index">04</span>
                    
                    <h3 class="ab-value-title">Safeguarding</h3>
                    <p class="ab-value-desc">We prioritise the safety and rights of children and vulnerable people.</p>
                    
                </div>

                <!-- 05 -->
                <div class="ab-value-card">
                    <span class="ab-value-index">05</span>
                    
                    <h3 class="ab-value-title">Accessibility</h3>
                    <p class="ab-value-desc">We work to remove barriers to mental health care.</p>
                    
                </div>
            </div>
        </div>
    </section>


    <!-- ══ 10. BOTTOM CALL TO ACTION (FLOATING WHITE CARD LIKE BACK-US) ══ -->
    <section class="ro-bottom-cta">
        <div class="ro-bottom-cta-inner">
            <div class="cta-left-text">
                <span class="cta-compact-pill"> Get Involved</span>
                <h2 class="font-display">Be part of a more supportive world</h2>
                <p>Whether you want to support our work, collaborate, or simply learn more, there are many ways to get involved.</p>
            </div>
            <div class="cta-right-action" style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                <div style="display: flex; flex-direction: row; gap: 12px; align-items: center;">
                    <a href="{{ route('backus') }}" class="btn-ro-compact" style="min-width: 170px; justify-content: center;">
                        <span>Fund Consultations</span>
                    </a>
                    <a href="{{ route('home') }}#partnerships" class="btn-ro-compact" style="min-width: 170px; justify-content: center; background: transparent; border: 2px solid var(--ab-navy-deep); color: var(--ab-navy-deep); box-shadow: none;">
                        <span>Partner With Us</span>
                    </a>
                </div>
                <div class="cta-handwritten-badge font-script">
                    Real support. Lasting impact. 
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
