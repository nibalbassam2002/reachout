<!DOCTYPE html>
<html lang="en" dir="ltr" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mental Health Frontline - Popup</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy-dark: #0d2849;
            --text-main: #111827;
            --text-muted: #4b5563;
            --wa-bg: #e7f6ed;
            --wa-text: #24a159;
            --email-bg: #eff4ff;
            --email-text: #3b82f6;
            --cta-box-bg: #f3f4f6;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }

        /* ══ RTL: scoped to modal only ══ */
        #welcomePopup[dir="rtl"] *,
        #welcomePopup[dir="rtl"] input,
        #welcomePopup[dir="rtl"] select,
        #welcomePopup[dir="rtl"] textarea,
        #welcomePopup[dir="rtl"] button {
            font-family: 'Cairo', 'Tajawal', 'Inter', sans-serif;
        }
        /* ══ RTL: scoped to modal only ══ */
#welcomePopup[dir="rtl"] input,
#welcomePopup[dir="rtl"] select,
#welcomePopup[dir="rtl"] textarea,
#welcomePopup[dir="rtl"] button,
#welcomePopup[dir="rtl"] p,
#welcomePopup[dir="rtl"] span,
#welcomePopup[dir="rtl"] label,
#welcomePopup[dir="rtl"] a,
#welcomePopup[dir="rtl"] h1,
#welcomePopup[dir="rtl"] h2,
#welcomePopup[dir="rtl"] h3,
#welcomePopup[dir="rtl"] div {
    font-family: 'Cairo', 'Tajawal', 'Inter', sans-serif;
}

/* استثناء الأيقونات — تبقى Font Awesome */
#welcomePopup[dir="rtl"] i,
#welcomePopup[dir="rtl"] .fa,
#welcomePopup[dir="rtl"] .fas,
#welcomePopup[dir="rtl"] .fab,
#welcomePopup[dir="rtl"] .far {
    font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands' !important;
}
#welcomePopup[dir="rtl"] .gender-btn i,
#welcomePopup[dir="rtl"] .impact-btn i {
    display: block !important;
    font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands' !important;
}

/* وهذا للـ LTR كمان */
.gender-btn i,
.impact-btn i {
    display: block !important;
    font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands' !important;
}
        /* ══ LANG TOGGLE ══ */
        .lang-toggle {
            position: absolute;
            top: 12px;
            left: 16px;
            z-index: 200;
            display: flex;
            align-items: center;
            gap: 0;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50px;
            overflow: hidden;
            backdrop-filter: blur(4px);
        }
        .lang-btn {
            padding: 5px 11px;
            font-size: 11px;
            font-weight: 700;
            color: rgba(255,255,255,0.65);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            letter-spacing: 0.5px;
        }
        .lang-btn.active {
            background: rgba(255,255,255,0.25);
            color: #fff;
            border-radius: 50px;
        }
        .lang-btn:hover:not(.active) { color: #fff; }

        #welcomePopup[dir="rtl"] .lang-toggle {
            left: auto;
            right: 52px;
        }

        /* ══ OVERLAY ══ */
        .pop-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease-out;
        }

        /* ══ MODAL ══ */
        .pop-modal {
            position: relative;
            background: #ffffff;
            border-radius: 28px;
            width: 100%;
            max-width: 630px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pop-modal > .pop-view {
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1;
        }

        .pop-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            transition: 0.2s;
        }
        .pop-close:hover { background: rgba(255, 255, 255, 0.3); }
        #welcomePopup[dir="rtl"] .pop-close { right: auto; left: 16px; }

        /* ══ HEADER ══ */
        .pop-header {
            background-color: var(--navy-dark);
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
            height: 100px;
            border-radius: 28px 28px 0 0;
            position: relative;
            flex-shrink: 0;
            z-index: 5;
        }

        .pop-kite {
            position: absolute;
            right: 10px;
            top: 10px;
            width: 260px;
            pointer-events: none;
            opacity: 0.6;
            z-index: 1;
        }
        #welcomePopup[dir="rtl"] .pop-kite { right: auto; left: 10px; transform: scaleX(-1); }

        .pop-logo {
            width: 100px;
            height: auto;
            background: none;
            border: none;
            box-shadow: none;
            object-fit: contain;
        }
        .pop-logo-wrap {
            position: absolute;
            bottom: -42px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
        }

        /* ══ VIEW WRAPPER ══ */
        .pop-view {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.35s ease, transform 0.35s ease;
        }
        .pop-view.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* ══ WELCOME VIEW ══ */
        .pop-body {
            padding: 55px 30px 25px 30px;
            text-align: center;
        }

        .pop-title {
            color: var(--navy-dark);
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        #welcomePopup[dir="rtl"] .pop-title { letter-spacing: 0; }

        .pop-subtitle {
            color: #000;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .pop-description p {
            font-size: 12px;
            color: #1f2124;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .pop-legal-links {
            margin: 12px 0 16px 0;
            font-size: 12px;
        }
        .pop-legal-links a {
            color: #0d2849;
            font-weight: 700;
            text-decoration: underline;
        }

        .pop-cta-box {
            background: #fafafa;
            border-radius: 15px;
            padding: 18px 16px;
            margin-top: 18px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08), 0 2px 4px rgba(63,53,85,0.5);
            border: 1px solid rgba(0,0,0,0.03);
            width: 100%;
        }

        .pop-btn-row {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }

        .pop-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 8px;
            border-radius: 50px;
            font-size: 12.5px;
            font-weight: 600;
            border: 1px solid #FFFFFF !important;
            text-decoration: none;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .btn-wa {
            background: #e7f6ed;
            color: #24a159;
        }
        .btn-wa:hover { background: #d9f2e3; transform: translateY(-2px); }

        .btn-mail {
            background: #eff4ff;
            color: #3b82f6;
        }
        .btn-mail:hover { background: #e0e9ff; transform: translateY(-2px); }

        .pop-btn i { font-size: 16px; color: inherit; }

        .pop-btn-donate {
            display: block;
            width: 55%;
            margin: 0 auto;
            background: #0d2849;
            color: #fff;
            padding: 12px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            transition: 0.3s;
        }
        .pop-btn-donate:hover { background: #163a66; transform: translateY(-2px); }

        /* ══ FORM VIEW ══ */
        .form-view {
            padding: 55px 28px 28px 28px;
            display: flex;
            flex-direction: column;
        }

        /* ══ Request type tabs ══ */
        .request-type-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 22px;
            background: #f3f4f6;
            border-radius: 14px;
            padding: 5px;
        }
        .req-tab {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }
        .req-tab i { font-size: 14px; }
        .req-tab.active {
            background: #ffffff;
            color: var(--navy-dark);
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
        }
        .req-tab:hover:not(.active) { color: var(--navy-dark); }

        .req-content { display: none; }
        .req-content.active { display: block; }

        /* ══ Follow-up ══ */
        .followup-intro {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy-dark);
            margin-bottom: 4px;
            text-align: center;
        }
        .followup-intro-sub {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 18px;
            text-align: center;
        }

        .ref-lookup-box {
            background: #f8fafc;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .ref-lookup-label {
            font-size: 11px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }
        .ref-lookup-row {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
            align-items: center;
        }
        .ref-input-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
            transition: border-color 0.2s;
            overflow: hidden;
        }
        .ref-input-wrap:focus-within { border-color: var(--navy-dark); }
        .ref-prefix {
            padding: 9px 10px 9px 14px;
            font-size: 13px;
            font-weight: 800;
            color: var(--navy-dark);
            background: #eef2ff;
            border-right: 1.5px solid #e5e7eb;
            white-space: nowrap;
            letter-spacing: 0.5px;
            user-select: none;
        }
        #welcomePopup[dir="rtl"] .ref-prefix {
            border-right: none;
            border-left: 1.5px solid #e5e7eb;
            padding: 9px 14px 9px 10px;
        }
        .ref-lookup-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 9px 12px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: #111827;
            background: transparent;
            letter-spacing: 1px;
            min-width: 0;
        }
        .ref-lookup-input::placeholder { letter-spacing: 0; color: #9ca3af; }
        .ref-lookup-btn {
            background: var(--navy-dark);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .ref-lookup-btn:hover { background: #163a66; }
        .ref-lookup-btn:disabled { background: #9ca3af; cursor: not-allowed; }

        .child-record-card {
            display: none;
            align-items: center;
            gap: 12px;
            background: #fff;
            border: 1.5px solid #d1fae5;
            border-radius: 12px;
            padding: 12px 14px;
        }
        .child-record-card.found { display: flex; animation: fadeIn 0.3s ease; }
        .child-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
            color: var(--navy-dark);
            flex-shrink: 0;
        }
        .child-record-info { flex: 1; min-width: 0; }
        .child-record-name {
            font-size: 13.5px;
            font-weight: 700;
            color: #111827;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .child-record-meta {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }
        .child-ref-badge {
            font-size: 10.5px;
            font-weight: 700;
            background: #eef2ff;
            color: var(--navy-dark);
            padding: 4px 10px;
            border-radius: 50px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .ref-not-found {
            display: none;
            align-items: center;
            gap: 8px;
            background: #fef2f2;
            border: 1.5px solid #fecaca;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            color: #dc2626;
            font-weight: 600;
        }
        .ref-not-found.show { display: flex; animation: fadeIn 0.2s ease; }

        .followup-note-section { display: none; }
        .followup-note-section.show { display: block; animation: fadeIn 0.3s ease; }
        .followup-note-section .form-field { margin-bottom: 16px; }

        .btn-send-followup {
            width: 100%;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.3s;
        }
        .btn-send-followup:hover { background: #1ebe5d; transform: translateY(-1px); }

        /* ══ Progress bar ══ */
        .form-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            flex: 1;
        }
        .progress-step .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            transition: 0.3s;
        }
        .progress-step .step-label {
            font-size: 10px;
            color: #9ca3af;
            font-weight: 600;
            text-align: center;
            transition: 0.3s;
        }
        .progress-step.active .step-circle { background: var(--navy-dark); color: #fff; }
        .progress-step.active .step-label { color: var(--navy-dark); }
        .progress-step.done .step-circle { background: #22c55e; color: #fff; }
        .progress-step.done .step-label { color: #22c55e; }
        .progress-line {
            flex: 0.3;
            height: 2px;
            background: #e5e7eb;
            margin-bottom: 18px;
            transition: background 0.3s;
        }
        .progress-line.done { background: #22c55e; }

        .step-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--navy-dark);
            margin-bottom: 4px;
            text-align: center;
        }
        .step-desc {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 18px;
            text-align: center;
        }

        /* ══ Form fields ══ */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }
        .form-grid.single { grid-template-columns: 1fr; }
        .form-grid.triple { grid-template-columns: 1fr 1fr 1fr; }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .form-field.full { grid-column: 1 / -1; }

        .form-field label {
            font-size: 11px;
            font-weight: 600;
            color: #374151;
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 9px 12px;
            font-size: 12.5px;
            font-family: inherit;
            color: #111827;
            outline: none;
            transition: border-color 0.2s;
            background: #fafafa;
        }
        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus { border-color: var(--navy-dark); background: #fff; }
        .form-field textarea { resize: none; min-height: 85px; }

        /* Gender */
        .gender-group { display: flex; gap: 8px; }
        .gender-btn {
            flex: 1;
            padding: 9px 6px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: #6b7280;
            background: #fafafa;
            cursor: pointer;
            text-align: center;
            transition: 0.2s;
        }
        .gender-btn.selected { border-color: var(--navy-dark); background: #eef2ff; color: var(--navy-dark); }
        .gender-btn i { display: block; font-size: 16px; margin-bottom: 3px; }

        /* Symptoms */
        .symptoms-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin-bottom: 12px;
        }
        .symptom-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 10px 6px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            color: #6b7280;
            background: #fafafa;
            cursor: pointer;
            text-align: center;
            transition: 0.2s;
        }
        .symptom-btn i { font-size: 18px; color: #9ca3af; transition: 0.2s; }
        .symptom-btn.selected { border-color: var(--navy-dark); background: #eef2ff; color: var(--navy-dark); }
        .symptom-btn.selected i { color: var(--navy-dark); }

        .add-symptom-wrap { margin-bottom: 14px; }
        .add-symptom-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: 1.5px dashed #d1d5db;
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
        }
        .add-symptom-btn:hover { border-color: var(--navy-dark); color: var(--navy-dark); }
        .extra-symptom-input { display: none; margin-top: 8px; }
        .extra-symptom-input input {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 9px 12px;
            font-size: 12.5px;
            font-family: inherit;
            outline: none;
            background: #fafafa;
        }
        .extra-symptom-input input:focus { border-color: var(--navy-dark); }

        /* Impact */
        .impact-group { display: flex; gap: 8px; margin-bottom: 14px; }
        .impact-btn {
            flex: 1;
            padding: 9px 4px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            background: #fafafa;
            cursor: pointer;
            text-align: center;
            transition: 0.2s;
        }
        .impact-btn i { display: block; font-size: 15px; margin-bottom: 3px; }
        .impact-btn[data-level="1"].selected { border-color: #22c55e; background: #f0fdf4; color: #16a34a; }
        .impact-btn[data-level="2"].selected { border-color: #f59e0b; background: #fffbeb; color: #d97706; }
        .impact-btn[data-level="3"].selected { border-color: #ef4444; background: #fef2f2; color: #dc2626; }

        /* Nav buttons */
        .form-nav { display: flex; gap: 10px; align-items: center; margin-top: 6px; }
        .btn-back {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            flex-shrink: 0;
        }
        .btn-back:hover { border-color: var(--navy-dark); color: var(--navy-dark); }

        .btn-next {
            flex: 1;
            background: var(--navy-dark);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-next:hover { background: #163a66; transform: translateY(-1px); }
        .btn-next:disabled { background: #9ca3af; cursor: not-allowed; transform: none; }

        .btn-submit {
            flex: 1;
            background: #22c55e;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover { background: #16a34a; transform: translateY(-1px); }
        .btn-submit:disabled { background: #9ca3af; cursor: not-allowed; transform: none; }

        /* Success */
        .success-view {
            padding: 55px 28px 35px 28px;
            text-align: center;
        }
        .success-icon {
            width: 64px;
            height: 64px;
            background: #f0fdf4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .success-icon i { font-size: 30px; color: #22c55e; }
        .success-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--navy-dark);
            margin-bottom: 8px;
        }
        .success-desc {
            font-size: 12.5px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .success-ref-box {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eef2ff;
            border: 1.5px solid #c7d2fe;
            border-radius: 50px;
            padding: 7px 18px;
            margin-bottom: 16px;
        }
        .success-ref-box i { font-size: 13px; color: var(--navy-dark); }
        .success-ref-label { font-size: 11px; color: #6b7280; font-weight: 600; }
        .success-ref-number { font-size: 14px; font-weight: 800; color: var(--navy-dark); letter-spacing: 0.5px; }

        .btn-whatsapp-final {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25d366;
            color: #fff;
            padding: 13px 28px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-whatsapp-final:hover { background: #1ebe5d; transform: translateY(-2px); }

        /* Spinner */
        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }
        .btn-submit.loading .spinner { display: block; }
        .btn-submit.loading .btn-text { display: none; }
         /* ══ Legal Doc Modal ══ */
.legal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    animation: fadeIn 0.15s ease;
}
.legal-modal {
    background: #fff;
    border-radius: 18px;
    padding: 24px 20px 16px;
    width: min(290px, calc(100vw - 32px));
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}
.legal-modal-title {
    font-size: 15px; font-weight: 700;
    color: #0d2849; margin: 0 0 4px;
}
.legal-modal-sub {
    font-size: 11.5px; color: #6b7280;
    margin: 0 0 16px;
}
.legal-action-btn {
    display: flex; align-items: center; gap: 10px;
    width: 100%; padding: 11px 14px;
    border-radius: 10px;
    border: 1.5px solid #e5e7eb;
    background: #fafafa;
    font-size: 13px; font-weight: 600;
    color: #111827; cursor: pointer;
    transition: 0.15s; margin-bottom: 8px;
    text-align: left;
}
.legal-action-btn:hover { background: #f3f4f6; border-color: #0d2849; }
.legal-action-btn i { font-size: 16px; color: #6b7280; }
.legal-cancel-btn {
    width: 100%; padding: 9px;
    border: none; background: transparent;
    font-size: 12.5px; color: #9ca3af;
    cursor: pointer; margin-top: 4px;
    border-radius: 8px;
}
.legal-cancel-btn:hover { background: #f3f4f6; color: #374151; }
#welcomePopup[dir="rtl"] .legal-action-btn { text-align: right; }
        /* Animations */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        #step-3 .form-nav {
            position: sticky;
            bottom: 0;
            background: #fff;
            padding: 10px 0 4px 0;
            margin-top: 10px;
            z-index: 10;
        }

        /* ══ Phone picker ══ */
        .phone-input-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            overflow: visible;
            background: #fafafa;
            transition: border-color 0.2s;
            position: relative;
        }
        .phone-input-wrap:focus-within { border-color: var(--navy-dark); background: #fff; }

        .country-picker { position: relative; flex-shrink: 0; }
        .country-picker-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 9px 8px 9px 10px;
            background: #f3f4f6;
            border: none;
            border-right: 1.5px solid #e5e7eb;
            border-radius: 8px 0 0 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            white-space: nowrap;
            transition: background 0.2s;
            font-family: inherit;
        }
        #welcomePopup[dir="rtl"] .country-picker-btn {
            border-right: none;
            border-left: 1.5px solid #e5e7eb;
            border-radius: 0 8px 8px 0;
        }
        .country-picker-btn:hover { background: #e9eaec; }
        #selectedFlag { font-size: 16px; }
        #selectedCode { font-size: 12px; font-weight: 700; color: #374151; }

        .country-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            width: 260px;
            background: #fff;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 9999;
            overflow: hidden;
        }
        #welcomePopup[dir="rtl"] .country-dropdown { left: auto; right: 0; }
        .country-dropdown.open { display: block; animation: fadeIn 0.15s ease; }

        .country-search-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-bottom: 1px solid #f3f4f6;
        }
        .country-search-wrap input {
            border: none !important;
            outline: none !important;
            font-size: 12px;
            color: #374151;
            width: 100%;
            font-family: inherit;
            background: transparent !important;
            padding: 0 !important;
        }

        .country-list { max-height: 200px; overflow-y: auto; scrollbar-width: thin; }
        .country-list::-webkit-scrollbar { width: 4px; }
        .country-list::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }

        .country-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            cursor: pointer;
            transition: background 0.15s;
            font-size: 12px;
            color: #374151;
        }
        .country-item:hover { background: #f9fafb; }
        .country-item.selected { background: #eef2ff; color: var(--navy-dark); font-weight: 700; }
        .country-item .ci-flag { font-size: 16px; flex-shrink: 0; }
        .country-item .ci-name { flex: 1; font-size: 11.5px; }
        .country-item .ci-code { font-size: 11px; color: #9ca3af; font-weight: 600; }

        .phone-input-wrap input[type="tel"] {
            border: none !important;
            border-radius: 0 !important;
            background: transparent !important;
            flex: 1;
            min-width: 0;
            font-size: 13px;
            padding: 9px 8px 9px 10px !important;
        }
        .phone-input-wrap input[type="tel"]:focus { border: none !important; outline: none !important; }

        .phone-digit-counter {
            font-size: 10px;
            color: #9ca3af;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: 600;
        }
        #welcomePopup[dir="rtl"] .phone-digit-counter { padding-right: 0; padding-left: 10px; }
        .phone-digit-counter.warn { color: #f59e0b; }
        .phone-digit-counter.done { color: #22c55e; }

        .form-field input.error,
        .form-field select.error { border-color: #ef4444; }
        .error-msg { font-size: 10px; color: #ef4444; margin-top: 2px; display: none; }
        .error-msg.show { display: block; }

        /* ══ RTL direction fixes — scoped to modal ══ */
        #welcomePopup[dir="rtl"] .form-nav { flex-direction: row-reverse; }
        #welcomePopup[dir="rtl"] .pop-btn-row { flex-direction: row; }
        #welcomePopup[dir="rtl"] .gender-group { flex-direction: row; }
        #welcomePopup[dir="rtl"] .impact-group { flex-direction: row; }
        #welcomePopup[dir="rtl"] .ref-lookup-row { flex-direction: row; }
/* gender icons */
.gender-btn i { 
    display: block !important; 
    font-size: 16px; 
    margin-bottom: 3px; 
}

/* impact icons */
.impact-btn i { 
    display: block !important; 
    font-size: 15px; 
    margin-bottom: 3px; 
}
        /* ══ RESPONSIVE ══ */
        @media (max-width: 500px) {
            .pop-modal { border-radius: 24px; }
            .pop-body { padding: 60px 20px 25px 20px; }
            .pop-btn-row { flex-direction: column; }
            .form-view { padding: 55px 18px 24px 18px; }
            .symptoms-grid { grid-template-columns: repeat(3, 1fr); }
            .form-grid { grid-template-columns: 1fr; }
            .form-grid.triple { grid-template-columns: 1fr 1fr; }
            .req-tab span { display: none; }
        }

        @media (max-width: 640px) {
            .pop-overlay { padding: 0; align-items: center; }
            .pop-modal { border-radius: 24px; max-height: 90vh; width: calc(100% - 32px); margin: 0 auto; }
            .pop-header { height: 80px; border-radius: 24px 24px 0 0; }
            .pop-kite { width: 160px; top: 5px; right: 5px; }
            .pop-logo { width: 80px; }
            .pop-logo-wrap { bottom: -36px; }
            .pop-body { padding: 50px 18px 20px 18px; }
            .pop-title { font-size: 16px; }
            .pop-subtitle { font-size: 13px; }
            .pop-description p { font-size: 11.5px; }
            .pop-btn-row { flex-direction: column; gap: 8px; }
            .pop-btn { width: 100%; padding: 11px 12px; font-size: 12px; }
            .pop-btn-donate { width: 70%; font-size: 12px; padding: 11px; }
            .form-view { padding: 50px 16px 20px 16px; }
            .request-type-tabs { gap: 6px; padding: 4px; }
            .req-tab { font-size: 11px; padding: 8px 6px; gap: 5px; }
            .req-tab i { font-size: 13px; }
            .form-progress { gap: 4px; margin-bottom: 18px; }
            .progress-step .step-circle { width: 26px; height: 26px; font-size: 11px; }
            .progress-step .step-label { font-size: 9px; }
            .progress-line { flex: 0.2; }
            .step-title { font-size: 14px; }
            .step-desc { font-size: 10px; margin-bottom: 14px; }
            .form-grid { grid-template-columns: 1fr; gap: 10px; margin-bottom: 12px; }
            .form-grid.triple { grid-template-columns: 1fr 1fr; }
            .form-field label { font-size: 10.5px; }
            .form-field input, .form-field select, .form-field textarea { font-size: 12px; padding: 8px 10px; }
            .form-field textarea { min-height: 75px; }
            .gender-btn { padding: 8px 4px; font-size: 10.5px; }
            .symptoms-grid { grid-template-columns: repeat(3, 1fr); gap: 6px; margin-bottom: 10px; }
            .symptom-btn { padding: 8px 4px; font-size: 9.5px; border-radius: 10px; }
            .symptom-btn i { font-size: 15px; }
            .impact-group { gap: 6px; }
            .impact-btn { padding: 8px 4px; font-size: 10px; }
            .impact-btn i { font-size: 13px; }
            .form-nav { gap: 8px; margin-top: 4px; }
            .btn-back { width: 34px; height: 34px; }
            .btn-next, .btn-submit { padding: 11px; font-size: 12px; }
            .country-picker-btn { padding: 8px 6px 8px 8px; font-size: 11px; }
            #selectedCode { font-size: 11px; }
            .country-dropdown { width: 220px; }
            .ref-lookup-box { padding: 12px; }
            .ref-lookup-row { gap: 6px; }
            .ref-prefix { padding: 8px 8px 8px 10px; font-size: 12px; }
            .ref-lookup-input { font-size: 12px; padding: 8px 8px; }
            .ref-lookup-btn { padding: 8px 12px; font-size: 11px; }
            .followup-intro { font-size: 12px; }
            .followup-intro-sub { font-size: 10px; }
            .btn-send-followup { padding: 11px; font-size: 12px; }
            .success-view { padding: 50px 20px 28px 20px; }
            .success-icon { width: 54px; height: 54px; }
            .success-icon i { font-size: 24px; }
            .success-title { font-size: 15px; }
            .success-desc { font-size: 11.5px; }
            .success-ref-box { padding: 6px 14px; flex-wrap: wrap; justify-content: center; gap: 4px; }
            .success-ref-number { font-size: 13px; }
            .btn-whatsapp-final { padding: 11px 22px; font-size: 13px; }
        }

        @media (max-width: 380px) {
            .pop-overlay { padding: 8px; }
            .pop-body { padding: 48px 14px 18px 14px; }
            .form-view { padding: 48px 12px 18px 12px; }
            .symptoms-grid { grid-template-columns: repeat(2, 1fr); }
            .form-grid.triple { grid-template-columns: 1fr; }
            .req-tab span { display: none; }
            .pop-btn { font-size: 11px; }
            .pop-btn-donate { width: 80%; }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .pop-overlay { padding: 16px; }
            .pop-modal { max-width: 500px; border-radius: 24px; }
            .pop-kite { width: 200px; }
            .pop-btn-row { gap: 10px; }
            .symptoms-grid { grid-template-columns: repeat(4, 1fr); }
            .form-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .pop-modal { max-width: 560px; }
            .symptoms-grid { grid-template-columns: repeat(4, 1fr); }
        }

        @media (min-width: 1400px) {
            .pop-modal { max-width: 660px; }
            .pop-title { font-size: 21px; }
        }

        @media (max-width: 768px) {
            .pop-cta-box { padding: 14px 12px; }
            .pop-btn-row { flex-direction: column; gap: 8px; margin-bottom: 8px; }
            .pop-btn { width: 100%; padding: 12px; font-size: 13px; border-radius: 50px; }
            .pop-btn-donate { width: 100%; display: block; padding: 12px; font-size: 13px; border-radius: 50px; margin: 0; }
        }
    </style>
</head>
<body>

<!-- Arabic font (loaded lazily) -->
<link id="arabicFont" rel="stylesheet" href="" data-href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" disabled>

<div id="welcomePopup" class="pop-overlay">
    <div class="pop-modal">

        <!-- Language Toggle -->
        <div class="lang-toggle">
            <button class="lang-btn active" id="btnLangEn" onclick="setLang('en')">EN</button>
            <button class="lang-btn" id="btnLangAr" onclick="setLang('ar')">ع</button>
        </div>

        <button class="pop-close" id="closePopup" aria-label="Close">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1L13 13M13 1L1 13" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="pop-header">
            <img class="pop-kite" src="{{ asset('reachout/img/kite.png') }}" alt="Kite Decor">
            <div class="pop-logo-wrap">
                <img src="{{ asset('reachout/img/logogrope.png') }}" alt="Mental Health Logo" class="pop-logo">
            </div>
        </div>

        <!-- ══ VIEW 1: Welcome ══ -->
        <div class="pop-view active" id="view-welcome">
            <div class="pop-body">
                <h2 class="pop-title" data-en="You deserve to be heard" data-ar="صوتك يستحق أن يُسمع"></h2>
                <h3 class="pop-subtitle" data-en="You don't have to go through this alone" data-ar="لا يجب أن تمر بهذا وحدك"></h3>

                <div class="pop-description">
                    <p data-en="We're here for you 24/7 whenever you need support." data-ar="نحن هنا من أجلك على مدار الساعة كلما احتجت للدعم."></p>
                    <p data-en="You can reach out at any time to access free confidential mental health care designed for people facing difficult moments." data-ar="يمكنك التواصل معنا في أي وقت للحصول على رعاية نفسية مجانية وسرية، مصممة خصيصاً للأشخاص الذين يمرون بلحظات صعبة."></p>
                    <p data-en="Your well-being matters and we'll walk with you every step of the way." data-ar="صحتك النفسية تهمنا، وسنكون بجانبك في كل خطوة."></p>
                </div>

                <p class="pop-legal-links">
                    <a href="#" onclick="openDoc(); return false;" 
                        data-en="Terms of Service" data-ar="شروط الخدمة"></a>
                        &amp;
                        <a href="#" onclick="openDoc(); return false;" 
                        data-en="Privacy Policy" data-ar="سياسة الخصوصية"></a>
                </p>

                <div class="pop-cta-box">
                    <div class="pop-btn-row">
                        <button class="pop-btn btn-wa" id="btnOpenFormWa" data-channel="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <span data-en="Chat with us on WhatsApp" data-ar="تواصل معنا عبر واتساب"></span>
                        </button>
                        <button class="pop-btn btn-mail" id="btnOpenFormEmail" data-channel="email">
                            <i class="far fa-envelope"></i>
                            <span data-en="Send us an Email" data-ar="راسلنا عبر البريد الإلكتروني"></span>
                        </button>
                    </div>
                    <a href="{{ route('donate.page') }}" class="pop-btn-donate" id="popupDonateAction" data-en="Donate now" data-ar="تبرع الآن"></a>
                </div>
            </div>
        </div>

        <!-- ══ VIEW 2: Multi-step Form ══ -->
        <div class="pop-view" id="view-form">
            <div class="form-view">

                <!-- Request type tabs -->
                <div class="request-type-tabs">
                    <button class="req-tab active" id="tab-new" onclick="switchRequestTab('new')">
                        <i class="fas fa-file-medical"></i>
                        <span data-en="New Request" data-ar="طلب جديد"></span>
                    </button>
                    <button class="req-tab" id="tab-followup" onclick="switchRequestTab('followup')">
                        <i class="fas fa-clock-rotate-left"></i>
                        <span data-en="Follow-up on Existing Case" data-ar="متابعة حالة قائمة"></span>
                    </button>
                </div>

                <!-- New Request content -->
                <div class="req-content active" id="content-new">

                    <!-- Progress bar -->
                    <div class="form-progress">
                        <div class="progress-step active" id="pstep-1">
                            <div class="step-circle">1</div>
                            <div class="step-label" data-en="Child Info" data-ar="بيانات الطفل"></div>
                        </div>
                        <div class="progress-line" id="pline-1"></div>
                        <div class="progress-step" id="pstep-2">
                            <div class="step-circle">2</div>
                            <div class="step-label" data-en="Guardian" data-ar="ولي الأمر"></div>
                        </div>
                        <div class="progress-line" id="pline-2"></div>
                        <div class="progress-step" id="pstep-3">
                            <div class="step-circle">3</div>
                            <div class="step-label" data-en="Case" data-ar="الحالة"></div>
                        </div>
                    </div>

                    <!-- Step 1 -->
                    <div class="form-step" id="step-1">
                        <p class="step-title" data-en="Child Information" data-ar="بيانات الطفل"></p>
                        <p class="step-desc" data-en="Tell us a bit about the child to provide the best support" data-ar="أخبرنا قليلاً عن الطفل لنقدم أفضل دعم ممكن"></p>

                        <div class="form-grid">
                            <div class="form-field full">
                                <label data-en="Child's Full Name *" data-ar="الاسم الكامل للطفل *"></label>
                                <input type="text" id="child_name" data-placeholder-en="e.g. Lina Ahmad" data-placeholder-ar="مثال: لينا أحمد" autocomplete="off">
                                <span class="error-msg" id="err-child_name" data-en="Please enter the child's name" data-ar="يرجى إدخال اسم الطفل"></span>
                            </div>
                            <div class="form-field">
                                <label data-en="Age *" data-ar="العمر *"></label>
                                <input type="number" id="child_age" data-placeholder-en="e.g. 9" data-placeholder-ar="مثال: 9" min="3" max="18">
                                <span class="error-msg" id="err-child_age" data-en="Please enter a valid age (3–18)" data-ar="يرجى إدخال عمر صحيح (3–18)"></span>
                            </div>
                            <div class="form-field">
                                <label data-en="School Grade" data-ar="الصف الدراسي"></label>
                                <select id="child_grade">
                                    <option value="" data-en="Select grade" data-ar="اختر الصف"></option>
                                    <option value="KG1">KG1</option><option value="KG2">KG2</option>
                                    <option value="Grade 1" data-en="Grade 1" data-ar="الصف الأول">Grade 1</option>
                                    <option value="Grade 2" data-en="Grade 2" data-ar="الصف الثاني">Grade 2</option>
                                    <option value="Grade 3" data-en="Grade 3" data-ar="الصف الثالث">Grade 3</option>
                                    <option value="Grade 4" data-en="Grade 4" data-ar="الصف الرابع">Grade 4</option>
                                    <option value="Grade 5" data-en="Grade 5" data-ar="الصف الخامس">Grade 5</option>
                                    <option value="Grade 6" data-en="Grade 6" data-ar="الصف السادس">Grade 6</option>
                                    <option value="Grade 7" data-en="Grade 7" data-ar="الصف السابع">Grade 7</option>
                                    <option value="Grade 8" data-en="Grade 8" data-ar="الصف الثامن">Grade 8</option>
                                    <option value="Grade 9" data-en="Grade 9" data-ar="الصف التاسع">Grade 9</option>
                                    <option value="Grade 10" data-en="Grade 10" data-ar="الصف العاشر">Grade 10</option>
                                    <option value="Grade 11" data-en="Grade 11" data-ar="الصف الحادي عشر">Grade 11</option>
                                    <option value="Grade 12" data-en="Grade 12" data-ar="الصف الثاني عشر">Grade 12</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field" style="margin-bottom:16px">
                            <label data-en="Gender *" data-ar="الجنس *"></label>
                            <div class="gender-group" id="gender-group">
                                <button type="button" class="gender-btn" data-value="male">
                                    <i class="fas fa-mars"></i>
                                    <span data-en="Male" data-ar="ذكر"></span>
                                </button>
                                <button type="button" class="gender-btn" data-value="female">
                                    <i class="fas fa-venus"></i>
                                    <span data-en="Female" data-ar="أنثى"></span>
                                </button>
                                <button type="button" class="gender-btn" data-value="prefer_not">
                                    <i class="fas fa-circle-dot"></i>
                                    <span data-en="Prefer not to say" data-ar="أفضل عدم الإفصاح"></span>
                                </button>
                            </div>
                            <span class="error-msg" id="err-gender" data-en="Please select the child's gender" data-ar="يرجى تحديد جنس الطفل"></span>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backToWelcome" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-next" id="nextStep1">
                                <span data-en="Next" data-ar="التالي"></span>
                                <i class="fas fa-arrow-right" style="font-size:12px"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="form-step" id="step-2" style="display:none">
                        <p class="step-title" data-en="Guardian Information" data-ar="بيانات ولي الأمر"></p>
                        <p class="step-desc" data-en="So our team can reach out to you directly" data-ar="حتى يتمكن فريقنا من التواصل معك مباشرة"></p>

                        <div class="form-grid">
                            <div class="form-field full">
                                <label data-en="Guardian's Full Name *" data-ar="الاسم الكامل لولي الأمر *"></label>
                                <input type="text" id="guardian_name" data-placeholder-en="e.g. Ahmad Al-Khalil" data-placeholder-ar="مثال: أحمد الخليل" autocomplete="off">
                                <span class="error-msg" id="err-guardian_name" data-en="Please enter the guardian's name" data-ar="يرجى إدخال اسم ولي الأمر"></span>
                            </div>
                            <div class="form-field">
                                <label data-en="Relationship *" data-ar="صلة القرابة *"></label>
                                <select id="guardian_relation">
                                    <option value="" data-en="Select" data-ar="اختر"></option>
                                    <option value="father" data-en="Father" data-ar="الأب">Father</option>
                                    <option value="mother" data-en="Mother" data-ar="الأم">Mother</option>
                                    <option value="uncle" data-en="Uncle" data-ar="العم / الخال">Uncle</option>
                                    <option value="aunt" data-en="Aunt" data-ar="العمة / الخالة">Aunt</option>
                                    <option value="sibling" data-en="Sibling" data-ar="الأخ / الأخت">Sibling</option>
                                    <option value="other" data-en="Other" data-ar="أخرى">Other</option>
                                </select>
                                <span class="error-msg" id="err-guardian_relation" data-en="Please select the relationship" data-ar="يرجى تحديد صلة القرابة"></span>
                            </div>
                            <div class="form-field">
                                <label data-en="Phone Number *" data-ar="رقم الهاتف *"></label>
                                <div class="phone-input-wrap">
                                    <div class="country-picker" id="countryPicker">
                                        <button type="button" class="country-picker-btn" id="countryPickerBtn">
                                            <span id="selectedFlag">🇵🇸</span>
                                            <span id="selectedCode">+970</span>
                                            <i class="fas fa-chevron-down" style="font-size:9px;color:#9ca3af"></i>
                                        </button>
                                        <div class="country-dropdown" id="countryDropdown">
                                            <div class="country-search-wrap">
                                                <i class="fas fa-search" style="font-size:11px;color:#9ca3af"></i>
                                                <input type="text" id="countrySearch" data-placeholder-en="Search country..." data-placeholder-ar="ابحث عن دولة..." autocomplete="off">
                                            </div>
                                            <div class="country-list" id="countryList"></div>
                                        </div>
                                    </div>
                                    <input type="tel" id="guardian_phone" data-placeholder-en="Enter number" data-placeholder-ar="أدخل الرقم" inputmode="numeric" maxlength="15">
                                    <span class="phone-digit-counter" id="phoneDigitCounter"></span>
                                </div>
                                <span class="error-msg" id="err-guardian_phone" data-en="Please enter a valid phone number" data-ar="يرجى إدخال رقم هاتف صحيح"></span>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backStep2" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-next" id="nextStep2">
                                <span data-en="Next" data-ar="التالي"></span>
                                <i class="fas fa-arrow-right" style="font-size:12px"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="form-step" id="step-3" style="display:none">
                        <p class="step-title" data-en="Case Details" data-ar="تفاصيل الحالة"></p>
                        <p class="step-desc" data-en="Help us understand what your child is experiencing" data-ar="ساعدنا على فهم ما يعانيه طفلك"></p>

                        <div class="form-field" style="margin-bottom:10px">
                            <label data-en="Observed Symptoms *" data-ar="الأعراض الملاحظة *"></label>
                            <div class="symptoms-grid" id="symptoms-grid">
                                <button type="button" class="symptom-btn" data-value="sleep">
                                    <i class="fas fa-bed"></i>
                                    <span data-en="Sleep Issues" data-ar="اضطراب النوم"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="anxiety">
                                    <i class="fas fa-brain"></i>
                                    <span data-en="Anxiety" data-ar="القلق"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="sadness">
                                    <i class="fas fa-face-sad-tear"></i>
                                    <span data-en="Sadness" data-ar="الحزن"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="aggression">
                                    <i class="fas fa-fire"></i>
                                    <span data-en="Aggression" data-ar="العدوانية"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="withdrawal">
                                    <i class="fas fa-person-shelter"></i>
                                    <span data-en="Withdrawal" data-ar="الانسحاب الاجتماعي"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="school">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span data-en="School Issues" data-ar="مشاكل مدرسية"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="appetite">
                                    <i class="fas fa-utensils"></i>
                                    <span data-en="Appetite Change" data-ar="تغير في الشهية"></span>
                                </button>
                                <button type="button" class="symptom-btn" data-value="concentration">
                                    <i class="fas fa-magnifying-glass"></i>
                                    <span data-en="Poor Focus" data-ar="ضعف التركيز"></span>
                                </button>
                            </div>
                            <span class="error-msg" id="err-symptoms" data-en="Please select at least one symptom" data-ar="يرجى تحديد عرض واحد على الأقل"></span>
                        </div>

                        <div class="add-symptom-wrap">
                            <button type="button" class="add-symptom-btn" id="addSymptomBtn">
                                <i class="fas fa-plus" style="font-size:11px"></i>
                                <span data-en="Add another symptom" data-ar="إضافة عرض آخر"></span>
                            </button>
                            <div class="extra-symptom-input" id="extraSymptomWrap">
                                <input type="text" id="extra_symptom" data-placeholder-en="Describe the symptom..." data-placeholder-ar="اوصف العرض...">
                            </div>
                        </div>

                        <div class="form-field" style="margin-bottom:14px">
                            <label data-en="How much is it affecting daily life? *" data-ar="مدى التأثير على الحياة اليومية؟ *"></label>
                            <div class="impact-group" id="impact-group">
                                <button type="button" class="impact-btn" data-level="1">
                                    <i class="fas fa-circle-check"></i>
                                    <span data-en="Mild" data-ar="خفيف"></span>
                                </button>
                                <button type="button" class="impact-btn" data-level="2">
                                    <i class="fas fa-triangle-exclamation"></i>
                                    <span data-en="Noticeable" data-ar="ملحوظ"></span>
                                </button>
                                <button type="button" class="impact-btn" data-level="3">
                                    <i class="fas fa-circle-exclamation"></i>
                                    <span data-en="Severe" data-ar="شديد"></span>
                                </button>
                            </div>
                            <span class="error-msg" id="err-impact" data-en="Please select an impact level" data-ar="يرجى تحديد مستوى التأثير"></span>
                        </div>

                        <div class="form-field" style="margin-bottom:16px">
                            <label data-en="Describe the problem in detail *" data-ar="اوصف المشكلة بالتفصيل *"></label>
                            <textarea id="notes" data-placeholder-en="Please describe what you've observed: when it started, how often it happens, what triggers it, and how it affects the child's daily routine at home and school..." data-placeholder-ar="يرجى وصف ما لاحظته: متى بدأ، كم مرة يحدث، ما الذي يثيره، وكيف يؤثر على الروتين اليومي للطفل في المنزل والمدرسة..."></textarea>
                            <span class="error-msg" id="err-notes" data-en="Please describe the problem in detail (at least 20 characters)" data-ar="يرجى وصف المشكلة بالتفصيل (20 حرفاً على الأقل)"></span>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backStep3" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-submit" id="submitForm">
                                <span class="btn-text">
                                    <i class="fas fa-paper-plane" style="font-size:12px"></i>
                                    <span data-en="Submit & Continue" data-ar="إرسال ومتابعة"></span>
                                </span>
                                <div class="spinner"></div>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Follow-up content -->
                <div class="req-content" id="content-followup">

                    <p class="followup-intro" data-en="Follow up on an existing case" data-ar="متابعة حالة قائمة"></p>
                    <p class="followup-intro-sub" data-en="Enter your reference number to load the child's record" data-ar="أدخل رقم المرجع لاسترجاع سجل الطفل"></p>

                    <div class="ref-lookup-box">
                        <span class="ref-lookup-label">
                            <i class="fas fa-hashtag" style="font-size:10px;margin-right:3px"></i>
                            <span data-en="Case Reference Number" data-ar="رقم المرجع للحالة"></span>
                        </span>
                        <div class="ref-lookup-row">
                            <div class="ref-input-wrap">
                                <span class="ref-prefix">MHF-</span>
                                <input
                                    type="text"
                                    class="ref-lookup-input"
                                    id="refNumberInput"
                                    placeholder="2024-00142"
                                    maxlength="12"
                                    inputmode="numeric"
                                    oninput="this.value=this.value.replace(/[^0-9\-]/g,''); resetLookup();"
                                    onkeydown="if(event.key==='Enter') lookupReference();"
                                >
                            </div>
                            <button class="ref-lookup-btn" id="refLookupBtn" onclick="lookupReference()">
                                <i class="fas fa-search"></i>
                                <span data-en="Find" data-ar="بحث"></span>
                            </button>
                        </div>

                        <div class="child-record-card" id="childRecordCard">
                            <div class="child-avatar" id="childAvatarInitials">LN</div>
                            <div class="child-record-info">
                                <div class="child-record-name" id="childRecordName">Lina Ahmad</div>
                                <div class="child-record-meta" id="childRecordMeta">Age 9 · Grade 4 · Female</div>
                            </div>
                            <span class="child-ref-badge" id="childRefBadge">MH-2024-00142</span>
                        </div>

                        <div class="ref-not-found" id="refNotFound">
                            <i class="fas fa-circle-exclamation"></i>
                            <span data-en="Reference number not found. Please check and try again." data-ar="رقم المرجع غير موجود. يرجى التحقق والمحاولة مجدداً."></span>
                        </div>
                    </div>

                    <div class="followup-note-section" id="followupNoteSection">
                        <div class="form-field">
                            <label>
                                <span data-en="Describe the new concern *" data-ar="اوصف المشكلة الجديدة *"></span>
                            </label>
                            <textarea
                                id="followupNote"
                                data-placeholder-en="What new symptoms or changes have you noticed since the last session? Please be as specific as possible..."
                                data-placeholder-ar="ما الأعراض أو التغييرات الجديدة التي لاحظتها منذ الجلسة الأخيرة؟ يرجى التفصيل قدر الإمكان..."
                                style="min-height:100px"
                            ></textarea>
                            <span class="error-msg" id="err-followup-note" data-en="Please describe the new concern (at least 20 characters)" data-ar="يرجى وصف المشكلة الجديدة (20 حرفاً على الأقل)"></span>
                        </div>

                        <button class="btn-send-followup" id="btnSendFollowup" onclick="sendFollowupWhatsApp()">
                            <i class="fab fa-whatsapp" style="font-size:16px"></i>
                            <span data-en="Send via WhatsApp" data-ar="إرسال عبر واتساب"></span>
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <!-- ══ VIEW 3: Success ══ -->
        <div class="pop-view" id="view-success">
            <div class="success-view">
                <div class="success-icon">
                    <i class="fas fa-circle-check"></i>
                </div>

                <div class="success-ref-box">
                    <i class="fas fa-hashtag"></i>
                    <span class="success-ref-label" data-en="Your reference:" data-ar="رقم مرجعك:"></span>
                    <span class="success-ref-number" id="successRefNumber">MH-2025-00189</span>
                </div>

                <h2 class="success-title" data-en="Your request was received!" data-ar="تم استقبال طلبك!"></h2>
                <p class="success-desc">
                    <span data-en="Save your reference number above for any future follow-ups." data-ar="احتفظ برقم المرجع أعلاه لأي متابعة مستقبلية."></span><br><br>
                    <span data-en="Our team has received your information and will be in touch shortly. You can also connect with us directly on WhatsApp right now." data-ar="استلم فريقنا معلوماتك وسيتواصل معك قريباً. يمكنك أيضاً التواصل معنا مباشرة عبر واتساب الآن."></span>
                </p>
                <a href="https://wa.me/yournumber" id="finalWhatsappBtn" class="btn-whatsapp-final" target="_blank">
                    <i class="fab fa-whatsapp" style="font-size:20px"></i>
                    <span data-en="Continue on WhatsApp" data-ar="تابع على واتساب"></span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let currentLang = 'en';

    // ══ setLang: scoped to modal only ══
    window.setLang = function(lang) {
        currentLang = lang;

        // ✅ Apply dir/lang ONLY on the popup — NOT on <html>
        const popup = document.getElementById('welcomePopup');
        popup.setAttribute('lang', lang);
        popup.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');

        // Load Arabic font when needed
        if (lang === 'ar') {
            const fontLink = document.getElementById('arabicFont');
            if (fontLink.getAttribute('href') === '') {
                fontLink.setAttribute('href', fontLink.getAttribute('data-href'));
                fontLink.removeAttribute('disabled');
            }
        }

        document.getElementById('btnLangEn').classList.toggle('active', lang === 'en');
        document.getElementById('btnLangAr').classList.toggle('active', lang === 'ar');

        // Update all [data-en] [data-ar] elements inside popup only
        popup.querySelectorAll('[data-en]').forEach(el => {
            const txt = el.getAttribute('data-' + lang);
            if (txt !== null) el.textContent = txt;
        });

        popup.querySelectorAll('[data-placeholder-en]').forEach(el => {
            const ph = el.getAttribute('data-placeholder-' + lang);
            if (ph !== null) el.placeholder = ph;
        });

        popup.querySelectorAll('select option[data-en]').forEach(opt => {
            const txt = opt.getAttribute('data-' + lang);
            if (txt) opt.textContent = txt;
        });

        // Fix arrow direction via JS too
        popup.querySelectorAll('.btn-back i, .btn-next i').forEach(icon => {
            icon.style.transform = lang === 'ar' ? 'scaleX(-1)' : 'scaleX(1)';
        });
    };

    setLang('en');

    // ══ Countries ══
    const COUNTRIES = [
        { flag:'🇵🇸', name:'Palestine',      code:'+970', max:9  },
        { flag:'🇮🇱', name:'Israel',         code:'+972', max:9  },
        { flag:'🇯🇴', name:'Jordan',         code:'+962', max:9  },
        { flag:'🇪🇬', name:'Egypt',          code:'+20',  max:10 },
        { flag:'🇸🇦', name:'Saudi Arabia',   code:'+966', max:9  },
        { flag:'🇦🇪', name:'UAE',            code:'+971', max:9  },
        { flag:'🇰🇼', name:'Kuwait',         code:'+965', max:8  },
        { flag:'🇶🇦', name:'Qatar',          code:'+974', max:8  },
        { flag:'🇧🇭', name:'Bahrain',        code:'+973', max:8  },
        { flag:'🇴🇲', name:'Oman',           code:'+968', max:8  },
        { flag:'🇱🇧', name:'Lebanon',        code:'+961', max:8  },
        { flag:'🇸🇾', name:'Syria',          code:'+963', max:9  },
        { flag:'🇮🇶', name:'Iraq',           code:'+964', max:10 },
        { flag:'🇾🇪', name:'Yemen',          code:'+967', max:9  },
        { flag:'🇱🇾', name:'Libya',          code:'+218', max:9  },
        { flag:'🇹🇳', name:'Tunisia',        code:'+216', max:8  },
        { flag:'🇩🇿', name:'Algeria',        code:'+213', max:9  },
        { flag:'🇲🇦', name:'Morocco',        code:'+212', max:9  },
        { flag:'🇸🇩', name:'Sudan',          code:'+249', max:9  },
        { flag:'🇸🇴', name:'Somalia',        code:'+252', max:8  },
        { flag:'🇺🇸', name:'United States',  code:'+1',   max:10 },
        { flag:'🇨🇦', name:'Canada',         code:'+1',   max:10 },
        { flag:'🇬🇧', name:'United Kingdom', code:'+44',  max:10 },
        { flag:'🇩🇪', name:'Germany',        code:'+49',  max:11 },
        { flag:'🇫🇷', name:'France',         code:'+33',  max:9  },
        { flag:'🇮🇹', name:'Italy',          code:'+39',  max:10 },
        { flag:'🇪🇸', name:'Spain',          code:'+34',  max:9  },
        { flag:'🇳🇱', name:'Netherlands',    code:'+31',  max:9  },
        { flag:'🇧🇪', name:'Belgium',        code:'+32',  max:9  },
        { flag:'🇵🇹', name:'Portugal',       code:'+351', max:9  },
        { flag:'🇦🇹', name:'Austria',        code:'+43',  max:11 },
        { flag:'🇨🇭', name:'Switzerland',    code:'+41',  max:9  },
        { flag:'🇸🇪', name:'Sweden',         code:'+46',  max:10 },
        { flag:'🇳🇴', name:'Norway',         code:'+47',  max:8  },
        { flag:'🇩🇰', name:'Denmark',        code:'+45',  max:8  },
        { flag:'🇫🇮', name:'Finland',        code:'+358', max:10 },
        { flag:'🇵🇱', name:'Poland',         code:'+48',  max:9  },
        { flag:'🇷🇺', name:'Russia',         code:'+7',   max:10 },
        { flag:'🇺🇦', name:'Ukraine',        code:'+380', max:9  },
        { flag:'🇮🇳', name:'India',          code:'+91',  max:10 },
        { flag:'🇵🇰', name:'Pakistan',       code:'+92',  max:10 },
        { flag:'🇮🇷', name:'Iran',           code:'+98',  max:10 },
        { flag:'🇹🇷', name:'Turkey',         code:'+90',  max:10 },
        { flag:'🇨🇳', name:'China',          code:'+86',  max:11 },
        { flag:'🇯🇵', name:'Japan',          code:'+81',  max:10 },
        { flag:'🇰🇷', name:'South Korea',    code:'+82',  max:10 },
        { flag:'🇦🇺', name:'Australia',      code:'+61',  max:9  },
        { flag:'🇳🇿', name:'New Zealand',    code:'+64',  max:9  },
        { flag:'🇿🇦', name:'South Africa',   code:'+27',  max:9  },
        { flag:'🇧🇷', name:'Brazil',         code:'+55',  max:11 },
        { flag:'🇲🇽', name:'Mexico',         code:'+52',  max:10 },
    ];

    let selectedChannel  = 'whatsapp';
    let selectedGender   = '';
    let selectedSymptoms = [];
    let selectedImpact   = '';
    let selectedCountry  = COUNTRIES[0];
    let foundChildRecord = null;

    // ══ Country Picker ══
    const countryList     = document.getElementById('countryList');
    const countrySearch   = document.getElementById('countrySearch');
    const countryDropdown = document.getElementById('countryDropdown');
    const pickerBtn       = document.getElementById('countryPickerBtn');
    const selectedFlag    = document.getElementById('selectedFlag');
    const selectedCodeEl  = document.getElementById('selectedCode');
    const phoneInput      = document.getElementById('guardian_phone');
    const digitCounter    = document.getElementById('phoneDigitCounter');

    function buildCountryList(filter = '') {
        countryList.innerHTML = '';
        const q = filter.toLowerCase();
        const filtered = COUNTRIES.filter(c =>
            c.name.toLowerCase().includes(q) || c.code.includes(q)
        );
        if (!filtered.length) {
            countryList.innerHTML = `<div style="padding:12px;text-align:center;font-size:12px;color:#9ca3af">${currentLang === 'ar' ? 'لا نتائج' : 'No results'}</div>`;
            return;
        }
        filtered.forEach(c => {
            const item = document.createElement('div');
            item.className = 'country-item' + (c === selectedCountry ? ' selected' : '');
            item.innerHTML = `<span class="ci-flag">${c.flag}</span><span class="ci-name">${c.name}</span><span class="ci-code">${c.code}</span>`;
            item.addEventListener('click', () => selectCountry(c));
            countryList.appendChild(item);
        });
    }

    function selectCountry(c) {
        selectedCountry = c;
        selectedFlag.textContent   = c.flag;
        selectedCodeEl.textContent = c.code;
        phoneInput.maxLength = c.max;
        phoneInput.placeholder = currentLang === 'ar' ? 'أدخل الرقم' : 'Enter number';
        if (phoneInput.value.length > c.max) phoneInput.value = phoneInput.value.slice(0, c.max);
        updateCounter();
        countryDropdown.classList.remove('open');
        countrySearch.value = '';
        buildCountryList();
        phoneInput.focus();
    }

    function updateCounter() {
        const len = phoneInput.value.replace(/\D/g,'').length;
        const max = selectedCountry.max;
        if (!len) { digitCounter.textContent = ''; return; }
        digitCounter.textContent = `${len}/${max}`;
        digitCounter.className = 'phone-digit-counter' +
            (len === max ? ' done' : len >= max - 1 ? ' warn' : '');
    }

    pickerBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = countryDropdown.classList.toggle('open');
        if (isOpen) { buildCountryList(); countrySearch.focus(); }
    });
    countrySearch.addEventListener('input', () => buildCountryList(countrySearch.value));
    document.addEventListener('click', (e) => {
        if (!document.getElementById('countryPicker').contains(e.target))
            countryDropdown.classList.remove('open');
    });
    phoneInput.addEventListener('input', () => {
        phoneInput.value = phoneInput.value.replace(/\D/g, '').slice(0, selectedCountry.max);
        updateCounter();
    });
    buildCountryList();
    selectCountry(COUNTRIES[0]);

    // ══ View switching ══
    function switchView(targetId) {
        document.querySelectorAll('.pop-view').forEach(v => {
            v.classList.remove('active');
            v.style.display = 'none';
        });
        const target = document.getElementById(targetId);
        target.style.display = 'block';
        requestAnimationFrame(() => requestAnimationFrame(() => target.classList.add('active')));
    }

    // ══ Step navigation ══
    function showStep(n) {
        document.querySelectorAll('.form-step').forEach(s => s.style.display = 'none');
        document.getElementById('step-' + n).style.display = 'block';
        updateProgressBar(n);
    }

    function updateProgressBar(current) {
        for (let i = 1; i <= 3; i++) {
            const ps = document.getElementById('pstep-' + i);
            const pl = document.getElementById('pline-' + i);
            ps.classList.remove('active', 'done');
            if (pl) pl.classList.remove('done');
            if (i < current)  { ps.classList.add('done'); if (pl) pl.classList.add('done'); }
            if (i === current) ps.classList.add('active');
        }
    }

    // ══ Tab switching ══
    window.switchRequestTab = function(tab) {
        document.querySelectorAll('.req-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.req-content').forEach(c => c.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        document.getElementById('content-' + tab).classList.add('active');
    };

    // ══ Welcome buttons ══
    document.getElementById('btnOpenFormWa').addEventListener('click', function () {
        selectedChannel = 'whatsapp';
        switchView('view-form');
        switchRequestTab('new');
        showStep(1);
    });
    document.getElementById('btnOpenFormEmail').addEventListener('click', function () {
        selectedChannel = 'email';
        switchView('view-form');
        switchRequestTab('new');
        showStep(1);
    });

    // ══ Close modal ══
    function hideModal() { document.getElementById('welcomePopup').style.display = 'none'; }
    document.getElementById('closePopup').addEventListener('click', hideModal);
    document.getElementById('welcomePopup').addEventListener('click', function (e) {
        if (e.target === this) hideModal();
    });
    const donateBtn = document.getElementById('popupDonateAction');
    if (donateBtn) donateBtn.addEventListener('click', hideModal);

    // ══ Gender ══
    document.querySelectorAll('.gender-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            selectedGender = this.dataset.value;
            hideError('gender');
        });
    });

    // ══ Symptoms ══
    document.querySelectorAll('.symptom-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            this.classList.toggle('selected');
            const val = this.dataset.value;
            if (selectedSymptoms.includes(val)) {
                selectedSymptoms = selectedSymptoms.filter(s => s !== val);
            } else {
                selectedSymptoms.push(val);
            }
            if (selectedSymptoms.length > 0) hideError('symptoms');
        });
    });

    // ══ Add symptom ══
    document.getElementById('addSymptomBtn').addEventListener('click', function () {
        const wrap = document.getElementById('extraSymptomWrap');
        const isOpen = wrap.style.display === 'block';
        wrap.style.display = isOpen ? 'none' : 'block';
        const spanEl = this.querySelector('span');
        if (isOpen) {
            spanEl.setAttribute('data-en', 'Add another symptom');
            spanEl.setAttribute('data-ar', 'إضافة عرض آخر');
        } else {
            spanEl.setAttribute('data-en', 'Cancel');
            spanEl.setAttribute('data-ar', 'إلغاء');
        }
        spanEl.textContent = spanEl.getAttribute('data-' + currentLang);
        if (!isOpen) document.getElementById('extra_symptom').focus();
    });

    // ══ Impact ══
    document.querySelectorAll('.impact-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.impact-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            selectedImpact = this.dataset.level;
            hideError('impact');
        });
    });

    // ══ Validation ══
    function showError(fieldId) {
        document.getElementById('err-' + fieldId)?.classList.add('show');
        document.getElementById(fieldId)?.classList.add('error');
    }
    function hideError(fieldId) {
        document.getElementById('err-' + fieldId)?.classList.remove('show');
        document.getElementById(fieldId)?.classList.remove('error');
    }

    function validateStep1() {
        let ok = true;
        const name = document.getElementById('child_name').value.trim();
        const age  = parseInt(document.getElementById('child_age').value);
        if (!name) { showError('child_name'); ok = false; } else hideError('child_name');
        if (!age || age < 3 || age > 18) { showError('child_age'); ok = false; } else hideError('child_age');
        if (!selectedGender) { showError('gender'); ok = false; } else hideError('gender');
        return ok;
    }

    function validateStep2() {
        let ok = true;
        const name     = document.getElementById('guardian_name').value.trim();
        const relation = document.getElementById('guardian_relation').value;
        const phone    = document.getElementById('guardian_phone').value.trim();
        if (!name)     { showError('guardian_name');     ok = false; } else hideError('guardian_name');
        if (!relation) { showError('guardian_relation'); ok = false; } else hideError('guardian_relation');
        if (!phone || phone.replace(/\D/g,'').length < 7) {
            showError('guardian_phone'); ok = false;
        } else hideError('guardian_phone');
        return ok;
    }

    function validateStep3() {
        let ok = true;
        if (selectedSymptoms.length === 0) { showError('symptoms'); ok = false; } else hideError('symptoms');
        if (!selectedImpact) { showError('impact'); ok = false; } else hideError('impact');
        const notes = document.getElementById('notes').value.trim();
        if (notes.length < 20) { showError('notes'); ok = false; } else hideError('notes');
        return ok;
    }

    // ══ Navigation buttons ══
    document.getElementById('backToWelcome').addEventListener('click', () => switchView('view-welcome'));
    document.getElementById('backStep2').addEventListener('click',    () => showStep(1));
    document.getElementById('backStep3').addEventListener('click',    () => showStep(2));
    document.getElementById('nextStep1').addEventListener('click', () => { if (validateStep1()) showStep(2); });
    document.getElementById('nextStep2').addEventListener('click', () => { if (validateStep2()) showStep(3); });

    // ══ Generate ref ══
    function generateRefNumber() {
        const year = new Date().getFullYear();
        const num  = String(Math.floor(Math.random() * 90000) + 10000).padStart(5, '0');
        return `MH-${year}-${num}`;
    }

    // ══ Submit ══
    document.getElementById('submitForm').addEventListener('click', async function () {
        if (!validateStep3()) return;
        const btn = this;
        btn.disabled = true;
        btn.classList.add('loading');

        const payload = {
            channel:           selectedChannel,
            child_name:        document.getElementById('child_name').value.trim(),
            child_age:         document.getElementById('child_age').value,
            child_grade:       document.getElementById('child_grade').value,
            child_gender:      selectedGender,
            guardian_name:     document.getElementById('guardian_name').value.trim(),
            guardian_relation: document.getElementById('guardian_relation').value,
            guardian_phone:    (selectedCountry.code + phoneInput.value).replace(/\s+/g,''),
            symptoms:          selectedSymptoms,
            extra_symptom:     document.getElementById('extra_symptom').value.trim(),
            impact_level:      selectedImpact,
            notes:             document.getElementById('notes').value.trim(),
        };

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            const response = await fetch('/reachout/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });
            if (!response.ok) throw new Error('Server error: ' + response.status);
            const data = await response.json();
            const refNumber = data.ref_number || generateRefNumber();
            document.getElementById('successRefNumber').textContent = refNumber;
            switchView('view-success');
            if (data.whatsapp_url) document.getElementById('finalWhatsappBtn').href = data.whatsapp_url;
            if (selectedChannel === 'whatsapp') {
    setTimeout(() => window.open(data.whatsapp_url || 'https://wa.me/yournumber', '_blank'), 1500);
}
        if (selectedChannel === 'email') {
    const mailtoUrl = data.mailto_url || data.contact_url;
    document.getElementById('finalWhatsappBtn').innerHTML = `
        <i class="far fa-envelope" style="font-size:20px"></i>
        <span>${currentLang === 'ar' ? 'فتح الإيميل' : 'Open Email'}</span>
    `;
    document.getElementById('finalWhatsappBtn').style.background = '#3b82f6';
    document.getElementById('finalWhatsappBtn').href = mailtoUrl;
    setTimeout(() => window.open(mailtoUrl, '_blank'), 1500);
}
        } catch (error) {
            console.error('Submission error:', error);
            alert(currentLang === 'ar'
                ? 'حدث خطأ. يرجى المحاولة مجدداً أو التواصل معنا مباشرة.'
                : 'Something went wrong. Please try again or contact us directly.');
            btn.disabled = false;
            btn.classList.remove('loading');
        }
    });

    // ══ Follow-up lookup ══
    window.resetLookup = function() {
        document.getElementById('childRecordCard').classList.remove('found');
        document.getElementById('refNotFound').classList.remove('show');
        document.getElementById('followupNoteSection').classList.remove('show');
        foundChildRecord = null;
    };

    window.lookupReference = async function() {
        const refInput = document.getElementById('refNumberInput');
        const rawVal   = refInput.value.trim();
        const refVal   = rawVal ? 'MHF-' + rawVal : '';
        if (!rawVal) { refInput.focus(); return; }

        const btn = document.getElementById('refLookupBtn');
        btn.disabled = true;
        btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${currentLang === 'ar' ? 'جارٍ البحث...' : 'Searching...'}`;

        document.getElementById('childRecordCard').classList.remove('found');
        document.getElementById('refNotFound').classList.remove('show');
        document.getElementById('followupNoteSection').classList.remove('show');

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            const response = await fetch('/reachout/lookup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ ref_number: refVal }),
            });
            if (!response.ok) throw new Error('Server error');
            const data = await response.json();

            if (data.found && data.child) {
                foundChildRecord = data.child;
                const initials = data.child.name.split(' ').map(w => w[0]).slice(0,2).join('').toUpperCase();
                document.getElementById('childAvatarInitials').textContent = initials;
                document.getElementById('childRecordName').textContent     = data.child.name;
                const ageTxt    = currentLang === 'ar' ? `العمر ${data.child.age}` : `Age ${data.child.age}`;
                const gradeTxt  = data.child.grade || '—';
                const genderMap = { male: currentLang==='ar'?'ذكر':'Male', female: currentLang==='ar'?'أنثى':'Female' };
                const genderTxt = genderMap[data.child.gender] || data.child.gender || '—';
                document.getElementById('childRecordMeta').textContent = `${ageTxt} · ${gradeTxt} · ${genderTxt}`;
                document.getElementById('childRefBadge').textContent   = refVal;
                document.getElementById('childRecordCard').classList.add('found');
                document.getElementById('followupNoteSection').classList.add('show');
                document.getElementById('followupNote').focus();
            } else {
                document.getElementById('refNotFound').classList.add('show');
                foundChildRecord = null;
            }
        } catch (error) {
            console.error('Lookup error:', error);
            document.getElementById('refNotFound').classList.add('show');
        } finally {
            btn.disabled = false;
            btn.innerHTML = `<i class="fas fa-search"></i> <span data-en="Find" data-ar="بحث">${currentLang === 'ar' ? 'بحث' : 'Find'}</span>`;
        }
    };

    // ══ Follow-up WhatsApp ══
    window.sendFollowupWhatsApp = function() {
        const note  = document.getElementById('followupNote').value.trim();
        const errEl = document.getElementById('err-followup-note');
        if (note.length < 20) { errEl.classList.add('show'); return; }
        errEl.classList.remove('show');
        if (!foundChildRecord) return;

        const refVal = document.getElementById('refNumberInput').value.trim();
        const message =
            `📋 *Follow-up Request*\n──────────────────\n` +
            `🔖 *Ref:* ${refVal}\n` +
            `👦 *Child:* ${foundChildRecord.name}` +
            (foundChildRecord.age   ? ` (Age ${foundChildRecord.age}` : '') +
            (foundChildRecord.grade ? `, ${foundChildRecord.grade})` : ')') +
            `\n──────────────────\n📝 *New concern:*\n${note}`;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        fetch('/reachout/followup', {
            method: 'POST',
            headers: { 'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken,'Accept':'application/json' },
            body: JSON.stringify({ ref_number: refVal, note }),
        }).catch(err => console.error('Followup save error:', err));

        window.open(`https://wa.me/972568200088?text=${encodeURIComponent(message)}`, '_blank');
    };
     window.openDoc = function() {
    const existing = document.getElementById('legalDocModal');
    if (existing) existing.remove();

    const lang = currentLang;
    const files = {
        en: '/documents/legal-en.pdf',
        ar: '/documents/legal-ar.pdf'
    };
    const url = files[lang];

    const labels = {
        en: { title: 'Legal Documents', sub: 'How would you like to view it?',
              preview: 'Preview in browser', download: 'Download PDF', cancel: 'Cancel' },
        ar: { title: 'الوثائق القانونية', sub: 'كيف تريد عرضه؟',
              preview: 'معاينة في المتصفح', download: 'تنزيل PDF', cancel: 'إلغاء' }
    };
    const l = labels[lang];

    const overlay = document.createElement('div');
    overlay.className = 'legal-overlay';
    overlay.id = 'legalDocModal';
    overlay.style.direction = lang === 'ar' ? 'rtl' : 'ltr';
    overlay.innerHTML = `
        <div class="legal-modal">
            <p class="legal-modal-title">${l.title}</p>
            <p class="legal-modal-sub">${l.sub}</p>
            <button class="legal-action-btn" id="legalPreviewBtn">
                <i class="fas fa-eye"></i> ${l.preview}
            </button>
            <button class="legal-action-btn" id="legalDownloadBtn">
                <i class="fas fa-download"></i> ${l.download}
            </button>
            <button class="legal-cancel-btn" id="legalCancelBtn">${l.cancel}</button>
        </div>
    `;
    document.body.appendChild(overlay);

    document.getElementById('legalPreviewBtn').onclick = function() {
        window.open(url, '_blank');
        overlay.remove();
    };
    document.getElementById('legalDownloadBtn').onclick = function() {
        const a = document.createElement('a');
        a.href = url;
        a.download = 'legal-' + lang + '.pdf';
        a.click();
        overlay.remove();
    };
    document.getElementById('legalCancelBtn').onclick = function() { overlay.remove(); };
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.remove();
    });
};
    document.getElementById('refNumberInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') window.lookupReference();
    });

});
</script>
</body>
</html>