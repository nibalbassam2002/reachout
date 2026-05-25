<!DOCTYPE html>
<html lang="en">
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

        /* زر الإغلاق */
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

        /* ══ تبويبات نوع الطلب - جديد ══ */
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

        /* ══ محتوى كل تبويب ══ */
        .req-content { display: none; }
        .req-content.active { display: block; }

        /* ══ قسم الطلب القديم (Follow-up) - جديد ══ */
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
        /* حقل الرفيرنس مع البريفيكس الثابت */
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

        /* بطاقة الطفل بعد البحث */
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

        /* رسالة عدم الوجود */
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

        /* حقل الملاحظة الجديدة */
        .followup-note-section {
            display: none;
        }
        .followup-note-section.show { display: block; animation: fadeIn 0.3s ease; }

        .followup-note-section .form-field {
            margin-bottom: 16px;
        }

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

        /* ══ شريط التقدم ══ */
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

        /* عنوان المرحلة */
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

        /* حقول الإدخال */
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
            font-family: 'Inter', sans-serif;
            color: #111827;
            outline: none;
            transition: border-color 0.2s;
            background: #fafafa;
        }
        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus { border-color: var(--navy-dark); background: #fff; }
        .form-field textarea { resize: none; min-height: 85px; }

        /* خيارات الجنس */
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

        /* أيقونات الأعراض */
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
            font-family: 'Inter', sans-serif;
            outline: none;
            background: #fafafa;
        }
        .extra-symptom-input input:focus { border-color: var(--navy-dark); }

        /* تقييم التأثير */
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

        /* أزرار التنقل */
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

        /* رسالة النجاح */
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

        /* ═ الرقم المرجعي في صفحة النجاح - جديد ═ */
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

        /* ══ حقل الهاتف مع country picker ══ */
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
            font-family: 'Inter', sans-serif;
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
            font-family: 'Inter', sans-serif;
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
        .phone-digit-counter.warn { color: #f59e0b; }
        .phone-digit-counter.done { color: #22c55e; }

        .form-field input.error,
        .form-field select.error { border-color: #ef4444; }
        .error-msg { font-size: 10px; color: #ef4444; margin-top: 2px; display: none; }
        .error-msg.show { display: block; }

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
    </style>
</head>
<body>

<div id="welcomePopup" class="pop-overlay">
    <div class="pop-modal">

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

        <!-- ══ VIEW 1: الترحيب ══ -->
        <div class="pop-view active" id="view-welcome">
            <div class="pop-body">
                <h2 class="pop-title">You deserve to be heard</h2>
                <h3 class="pop-subtitle">You don't have to go through this alone</h3>

                <div class="pop-description">
                    <p>We're here for you 24/7 whenever you need support.</p>
                    <p>You can reach out at any time to access free confidential mental health care<br> designed for people facing difficult moments.</p>
                    <p>Your well-being matters and we'll walk with you every step of the way.</p>
                </div>

                <p class="pop-legal-links">
                    <a href="#">Terms of Service</a> &amp; <a href="#">Privacy Policy</a>
                </p>

                <div class="pop-cta-box">
                    <div class="pop-btn-row">
                        <button class="pop-btn btn-wa" id="btnOpenFormWa" data-channel="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            Chat with us on WhatsApp
                        </button>
                        <button class="pop-btn btn-mail" id="btnOpenFormEmail" data-channel="email">
                            <i class="far fa-envelope"></i>
                            Send us an Email
                        </button>
                    </div>
                    <a href="#donate" class="pop-btn-donate" id="popupDonateAction">Donate now</a>
                </div>
            </div>
        </div>

        <!-- ══ VIEW 2: الاستمارة متعددة المراحل ══ -->
        <div class="pop-view" id="view-form">
            <div class="form-view">

                <!-- ══ تبويبات نوع الطلب - جديد ══ -->
                <div class="request-type-tabs">
                    <button class="req-tab active" id="tab-new" onclick="switchRequestTab('new')">
                        <i class="fas fa-file-medical"></i>
                        <span>New Request</span>
                    </button>
                    <button class="req-tab" id="tab-followup" onclick="switchRequestTab('followup')">
                        <i class="fas fa-clock-rotate-left"></i>
                        <span>Follow-up on Existing Case</span>
                    </button>
                </div>

                <!-- ══ محتوى: طلب جديد ══ -->
                <div class="req-content active" id="content-new">

                    <!-- شريط التقدم -->
                    <div class="form-progress">
                        <div class="progress-step active" id="pstep-1">
                            <div class="step-circle">1</div>
                            <div class="step-label">Child Info</div>
                        </div>
                        <div class="progress-line" id="pline-1"></div>
                        <div class="progress-step" id="pstep-2">
                            <div class="step-circle">2</div>
                            <div class="step-label">Guardian</div>
                        </div>
                        <div class="progress-line" id="pline-2"></div>
                        <div class="progress-step" id="pstep-3">
                            <div class="step-circle">3</div>
                            <div class="step-label">Case</div>
                        </div>
                    </div>

                    <!-- المرحلة 1: بيانات الطفل -->
                    <div class="form-step" id="step-1">
                        <p class="step-title">Child Information</p>
                        <p class="step-desc">Tell us a bit about the child to provide the best support</p>

                        <div class="form-grid">
                            <div class="form-field full">
                                <label>Child's Full Name <span style="color:#ef4444">*</span></label>
                                <input type="text" id="child_name" placeholder="e.g. Lina Ahmad" autocomplete="off">
                                <span class="error-msg" id="err-child_name">Please enter the child's name</span>
                            </div>
                            <div class="form-field">
                                <label>Age <span style="color:#ef4444">*</span></label>
                                <input type="number" id="child_age" placeholder="e.g. 9" min="3" max="18">
                                <span class="error-msg" id="err-child_age">Please enter a valid age (3–18)</span>
                            </div>
                            <div class="form-field">
                                <label>School Grade</label>
                                <select id="child_grade">
                                    <option value="">Select grade</option>
                                    <option>KG1</option><option>KG2</option>
                                    <option>Grade 1</option><option>Grade 2</option>
                                    <option>Grade 3</option><option>Grade 4</option>
                                    <option>Grade 5</option><option>Grade 6</option>
                                    <option>Grade 7</option><option>Grade 8</option>
                                    <option>Grade 9</option><option>Grade 10</option>
                                    <option>Grade 11</option><option>Grade 12</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field" style="margin-bottom:16px">
                            <label>Gender <span style="color:#ef4444">*</span></label>
                            <div class="gender-group" id="gender-group">
                                <button type="button" class="gender-btn" data-value="male">
                                    <i class="fas fa-mars"></i> Male
                                </button>
                                <button type="button" class="gender-btn" data-value="female">
                                    <i class="fas fa-venus"></i> Female
                                </button>
                                <button type="button" class="gender-btn" data-value="prefer_not">
                                    <i class="fas fa-circle-dot"></i> Prefer not to say
                                </button>
                            </div>
                            <span class="error-msg" id="err-gender">Please select the child's gender</span>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backToWelcome" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-next" id="nextStep1">
                                Next <i class="fas fa-arrow-right" style="font-size:12px"></i>
                            </button>
                        </div>
                    </div>

                    <!-- المرحلة 2: بيانات ولي الأمر -->
                    <div class="form-step" id="step-2" style="display:none">
                        <p class="step-title">Guardian Information</p>
                        <p class="step-desc">So our team can reach out to you directly</p>

                        <div class="form-grid">
                            <div class="form-field full">
                                <label>Guardian's Full Name <span style="color:#ef4444">*</span></label>
                                <input type="text" id="guardian_name" placeholder="e.g. Ahmad Al-Khalil" autocomplete="off">
                                <span class="error-msg" id="err-guardian_name">Please enter the guardian's name</span>
                            </div>
                            <div class="form-field">
                                <label>Relationship <span style="color:#ef4444">*</span></label>
                                <select id="guardian_relation">
                                    <option value="">Select</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="uncle">Uncle</option>
                                    <option value="aunt">Aunt</option>
                                    <option value="sibling">Sibling</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="error-msg" id="err-guardian_relation">Please select the relationship</span>
                            </div>
                            <div class="form-field">
                                <label>Phone Number <span style="color:#ef4444">*</span></label>
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
                                                <input type="text" id="countrySearch" placeholder="Search country..." autocomplete="off">
                                            </div>
                                            <div class="country-list" id="countryList"></div>
                                        </div>
                                    </div>
                                    <input type="tel" id="guardian_phone" placeholder="Enter number" inputmode="numeric" maxlength="15">
                                    <span class="phone-digit-counter" id="phoneDigitCounter"></span>
                                </div>
                                <span class="error-msg" id="err-guardian_phone">Please enter a valid phone number</span>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backStep2" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-next" id="nextStep2">
                                Next <i class="fas fa-arrow-right" style="font-size:12px"></i>
                            </button>
                        </div>
                    </div>

                    <!-- المرحلة 3: بيانات الحالة -->
                    <div class="form-step" id="step-3" style="display:none">
                        <p class="step-title">Case Details</p>
                        <p class="step-desc">Help us understand what your child is experiencing</p>

                        <div class="form-field" style="margin-bottom:10px">
                            <label>Observed Symptoms <span style="color:#ef4444">*</span></label>
                            <div class="symptoms-grid" id="symptoms-grid">
                                <button type="button" class="symptom-btn" data-value="sleep">
                                    <i class="fas fa-bed"></i>Sleep Issues
                                </button>
                                <button type="button" class="symptom-btn" data-value="anxiety">
                                    <i class="fas fa-brain"></i>Anxiety
                                </button>
                                <button type="button" class="symptom-btn" data-value="sadness">
                                    <i class="fas fa-face-sad-tear"></i>Sadness
                                </button>
                                <button type="button" class="symptom-btn" data-value="aggression">
                                    <i class="fas fa-fire"></i>Aggression
                                </button>
                                <button type="button" class="symptom-btn" data-value="withdrawal">
                                    <i class="fas fa-person-shelter"></i>Withdrawal
                                </button>
                                <button type="button" class="symptom-btn" data-value="school">
                                    <i class="fas fa-graduation-cap"></i>School Issues
                                </button>
                                <button type="button" class="symptom-btn" data-value="appetite">
                                    <i class="fas fa-utensils"></i>Appetite Change
                                </button>
                                <button type="button" class="symptom-btn" data-value="concentration">
                                    <i class="fas fa-magnifying-glass"></i>Poor Focus
                                </button>
                            </div>
                            <span class="error-msg" id="err-symptoms">Please select at least one symptom</span>
                        </div>

                        <div class="add-symptom-wrap">
                            <button type="button" class="add-symptom-btn" id="addSymptomBtn">
                                <i class="fas fa-plus" style="font-size:11px"></i>
                                Add another symptom
                            </button>
                            <div class="extra-symptom-input" id="extraSymptomWrap">
                                <input type="text" id="extra_symptom" placeholder="Describe the symptom...">
                            </div>
                        </div>

                        <div class="form-field" style="margin-bottom:14px">
                            <label>How much is it affecting daily life? <span style="color:#ef4444">*</span></label>
                            <div class="impact-group" id="impact-group">
                                <button type="button" class="impact-btn" data-level="1">
                                    <i class="fas fa-circle-check"></i>Mild
                                </button>
                                <button type="button" class="impact-btn" data-level="2">
                                    <i class="fas fa-triangle-exclamation"></i>Noticeable
                                </button>
                                <button type="button" class="impact-btn" data-level="3">
                                    <i class="fas fa-circle-exclamation"></i>Severe
                                </button>
                            </div>
                            <span class="error-msg" id="err-impact">Please select an impact level</span>
                        </div>

                        <div class="form-field" style="margin-bottom:16px">
                            <label>Describe the problem in detail <span style="color:#ef4444">*</span></label>
                            <textarea id="notes" placeholder="Please describe what you've observed: when it started, how often it happens, what triggers it, and how it affects the child's daily routine at home and school..."></textarea>
                            <span class="error-msg" id="err-notes">Please describe the problem in detail (at least 20 characters)</span>
                        </div>

                        <div class="form-nav">
                            <button class="btn-back" id="backStep3" title="Back">
                                <i class="fas fa-arrow-left" style="font-size:14px"></i>
                            </button>
                            <button class="btn-submit" id="submitForm">
                                <span class="btn-text"><i class="fas fa-paper-plane" style="font-size:12px"></i> Submit & Continue</span>
                                <div class="spinner"></div>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- /content-new -->

                <!-- ══ محتوى: متابعة حالة قديمة - جديد بالكامل ══ -->
                <div class="req-content" id="content-followup">

                    <p class="followup-intro">Follow up on an existing case</p>
                    <p class="followup-intro-sub">Enter your reference number to load the child's record</p>

                    <div class="ref-lookup-box">
                        <span class="ref-lookup-label">
                            <i class="fas fa-hashtag" style="font-size:10px;margin-right:3px"></i>
                            Case Reference Number
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
                                <i class="fas fa-search"></i> Find
                            </button>
                        </div>

                        <!-- بطاقة الطفل عند الإيجاد -->
                        <div class="child-record-card" id="childRecordCard">
                            <div class="child-avatar" id="childAvatarInitials">LN</div>
                            <div class="child-record-info">
                                <div class="child-record-name" id="childRecordName">Lina Ahmad</div>
                                <div class="child-record-meta" id="childRecordMeta">Age 9 · Grade 4 · Female</div>
                            </div>
                            <span class="child-ref-badge" id="childRefBadge">MH-2024-00142</span>
                        </div>

                        <!-- رسالة عدم الوجود -->
                        <div class="ref-not-found" id="refNotFound">
                            <i class="fas fa-circle-exclamation"></i>
                            Reference number not found. Please check and try again.
                        </div>
                    </div>

                    <!-- حقل الملاحظة الجديدة - يظهر فقط بعد إيجاد الطفل -->
                    <div class="followup-note-section" id="followupNoteSection">
                        <div class="form-field">
                            <label>
                                Describe the new concern
                                <span style="color:#ef4444">*</span>
                            </label>
                            <textarea
                                id="followupNote"
                                placeholder="What new symptoms or changes have you noticed since the last session? Please be as specific as possible..."
                                style="min-height:100px"
                            ></textarea>
                            <span class="error-msg" id="err-followup-note">Please describe the new concern (at least 20 characters)</span>
                        </div>

                        <button class="btn-send-followup" id="btnSendFollowup" onclick="sendFollowupWhatsApp()">
                            <i class="fab fa-whatsapp" style="font-size:16px"></i>
                            Send via WhatsApp
                        </button>
                    </div>

                </div>
                <!-- /content-followup -->

            </div>
        </div>

        <!-- ══ VIEW 3: النجاح ══ -->
        <div class="pop-view" id="view-success">
            <div class="success-view">
                <div class="success-icon">
                    <i class="fas fa-circle-check"></i>
                </div>

                <!-- الرقم المرجعي - جديد -->
                <div class="success-ref-box">
                    <i class="fas fa-hashtag"></i>
                    <span class="success-ref-label">Your reference:</span>
                    <span class="success-ref-number" id="successRefNumber">MH-2025-00189</span>
                </div>

                <h2 class="success-title">Your request was received!</h2>
                <p class="success-desc">
                    Save your reference number above for any future follow-ups.<br><br>
                    Our team has received your information and will be in touch shortly.<br>
                    You can also connect with us directly on WhatsApp right now.
                </p>
                <a href="https://wa.me/yournumber" id="finalWhatsappBtn" class="btn-whatsapp-final" target="_blank">
                    <i class="fab fa-whatsapp" style="font-size:20px"></i>
                    Continue on WhatsApp
                </a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ══════════════════════════════════════════
    //  بيانات الدول
    // ══════════════════════════════════════════
    const COUNTRIES = [
        { flag:'🇵🇸', name:'Palestine',           code:'+970', max:9  },
        { flag:'🇮🇱', name:'Israel',              code:'+972', max:9  },
        { flag:'🇯🇴', name:'Jordan',              code:'+962', max:9  },
        { flag:'🇪🇬', name:'Egypt',               code:'+20',  max:10 },
        { flag:'🇸🇦', name:'Saudi Arabia',        code:'+966', max:9  },
        { flag:'🇦🇪', name:'UAE',                 code:'+971', max:9  },
        { flag:'🇰🇼', name:'Kuwait',              code:'+965', max:8  },
        { flag:'🇶🇦', name:'Qatar',               code:'+974', max:8  },
        { flag:'🇧🇭', name:'Bahrain',             code:'+973', max:8  },
        { flag:'🇴🇲', name:'Oman',                code:'+968', max:8  },
        { flag:'🇱🇧', name:'Lebanon',             code:'+961', max:8  },
        { flag:'🇸🇾', name:'Syria',               code:'+963', max:9  },
        { flag:'🇮🇶', name:'Iraq',                code:'+964', max:10 },
        { flag:'🇾🇪', name:'Yemen',               code:'+967', max:9  },
        { flag:'🇱🇾', name:'Libya',               code:'+218', max:9  },
        { flag:'🇹🇳', name:'Tunisia',             code:'+216', max:8  },
        { flag:'🇩🇿', name:'Algeria',             code:'+213', max:9  },
        { flag:'🇲🇦', name:'Morocco',             code:'+212', max:9  },
        { flag:'🇸🇩', name:'Sudan',               code:'+249', max:9  },
        { flag:'🇸🇴', name:'Somalia',             code:'+252', max:8  },
        { flag:'🇩🇯', name:'Djibouti',            code:'+253', max:8  },
        { flag:'🇲🇷', name:'Mauritania',          code:'+222', max:8  },
        { flag:'🇰🇲', name:'Comoros',             code:'+269', max:7  },
        { flag:'🇺🇸', name:'United States',       code:'+1',   max:10 },
        { flag:'🇨🇦', name:'Canada',              code:'+1',   max:10 },
        { flag:'🇬🇧', name:'United Kingdom',      code:'+44',  max:10 },
        { flag:'🇩🇪', name:'Germany',             code:'+49',  max:11 },
        { flag:'🇫🇷', name:'France',              code:'+33',  max:9  },
        { flag:'🇮🇹', name:'Italy',               code:'+39',  max:10 },
        { flag:'🇪🇸', name:'Spain',               code:'+34',  max:9  },
        { flag:'🇳🇱', name:'Netherlands',         code:'+31',  max:9  },
        { flag:'🇧🇪', name:'Belgium',             code:'+32',  max:9  },
        { flag:'🇵🇹', name:'Portugal',            code:'+351', max:9  },
        { flag:'🇦🇹', name:'Austria',             code:'+43',  max:11 },
        { flag:'🇨🇭', name:'Switzerland',         code:'+41',  max:9  },
        { flag:'🇸🇪', name:'Sweden',              code:'+46',  max:10 },
        { flag:'🇳🇴', name:'Norway',              code:'+47',  max:8  },
        { flag:'🇩🇰', name:'Denmark',             code:'+45',  max:8  },
        { flag:'🇫🇮', name:'Finland',             code:'+358', max:10 },
        { flag:'🇵🇱', name:'Poland',              code:'+48',  max:9  },
        { flag:'🇨🇿', name:'Czech Republic',      code:'+420', max:9  },
        { flag:'🇭🇺', name:'Hungary',             code:'+36',  max:9  },
        { flag:'🇷🇴', name:'Romania',             code:'+40',  max:9  },
        { flag:'🇬🇷', name:'Greece',              code:'+30',  max:10 },
        { flag:'🇹🇷', name:'Turkey',              code:'+90',  max:10 },
        { flag:'🇷🇺', name:'Russia',              code:'+7',   max:10 },
        { flag:'🇺🇦', name:'Ukraine',             code:'+380', max:9  },
        { flag:'🇮🇳', name:'India',               code:'+91',  max:10 },
        { flag:'🇵🇰', name:'Pakistan',            code:'+92',  max:10 },
        { flag:'🇧🇩', name:'Bangladesh',          code:'+880', max:10 },
        { flag:'🇱🇰', name:'Sri Lanka',           code:'+94',  max:9  },
        { flag:'🇳🇵', name:'Nepal',               code:'+977', max:10 },
        { flag:'🇦🇫', name:'Afghanistan',         code:'+93',  max:9  },
        { flag:'🇮🇷', name:'Iran',                code:'+98',  max:10 },
        { flag:'🇨🇳', name:'China',               code:'+86',  max:11 },
        { flag:'🇯🇵', name:'Japan',               code:'+81',  max:10 },
        { flag:'🇰🇷', name:'South Korea',         code:'+82',  max:10 },
        { flag:'🇮🇩', name:'Indonesia',           code:'+62',  max:12 },
        { flag:'🇲🇾', name:'Malaysia',            code:'+60',  max:10 },
        { flag:'🇵🇭', name:'Philippines',         code:'+63',  max:10 },
        { flag:'🇹🇭', name:'Thailand',            code:'+66',  max:9  },
        { flag:'🇻🇳', name:'Vietnam',             code:'+84',  max:10 },
        { flag:'🇸🇬', name:'Singapore',           code:'+65',  max:8  },
        { flag:'🇦🇺', name:'Australia',           code:'+61',  max:9  },
        { flag:'🇳🇿', name:'New Zealand',         code:'+64',  max:9  },
        { flag:'🇿🇦', name:'South Africa',        code:'+27',  max:9  },
        { flag:'🇳🇬', name:'Nigeria',             code:'+234', max:10 },
        { flag:'🇰🇪', name:'Kenya',               code:'+254', max:9  },
        { flag:'🇬🇭', name:'Ghana',               code:'+233', max:9  },
        { flag:'🇪🇹', name:'Ethiopia',            code:'+251', max:9  },
        { flag:'🇹🇿', name:'Tanzania',            code:'+255', max:9  },
        { flag:'🇺🇬', name:'Uganda',              code:'+256', max:9  },
        { flag:'🇧🇷', name:'Brazil',              code:'+55',  max:11 },
        { flag:'🇲🇽', name:'Mexico',              code:'+52',  max:10 },
        { flag:'🇦🇷', name:'Argentina',           code:'+54',  max:10 },
        { flag:'🇨🇴', name:'Colombia',            code:'+57',  max:10 },
        { flag:'🇨🇱', name:'Chile',               code:'+56',  max:9  },
        { flag:'🇵🇪', name:'Peru',                code:'+51',  max:9  },
        { flag:'🇻🇪', name:'Venezuela',           code:'+58',  max:10 },
    ];

    // ══════════════════════════════════════════
    //  State
    // ══════════════════════════════════════════
    let selectedChannel   = 'whatsapp';
    let selectedGender    = '';
    let selectedSymptoms  = [];
    let selectedImpact    = '';
    let selectedCountry   = COUNTRIES[0];
    let foundChildRecord  = null; // يخزن بيانات الطفل المُجلب (للـ follow-up)

    // ══════════════════════════════════════════
    //  Country Picker
    // ══════════════════════════════════════════
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
            countryList.innerHTML = '<div style="padding:12px;text-align:center;font-size:12px;color:#9ca3af">No results</div>';
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
        phoneInput.placeholder = '0'.repeat(c.max);
        if (phoneInput.value.length > c.max) {
            phoneInput.value = phoneInput.value.slice(0, c.max);
        }
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
        if (!document.getElementById('countryPicker').contains(e.target)) {
            countryDropdown.classList.remove('open');
        }
    });

    phoneInput.addEventListener('input', () => {
        phoneInput.value = phoneInput.value.replace(/\D/g, '').slice(0, selectedCountry.max);
        updateCounter();
    });

    buildCountryList();
    selectCountry(COUNTRIES[0]);

    // ══════════════════════════════════════════
    //  تبديل الـ Views
    // ══════════════════════════════════════════
    function switchView(targetId) {
        document.querySelectorAll('.pop-view').forEach(v => {
            v.classList.remove('active');
            v.style.display = 'none';
        });
        const target = document.getElementById(targetId);
        target.style.display = 'block';
        requestAnimationFrame(() => {
            requestAnimationFrame(() => { target.classList.add('active'); });
        });
    }

    // ══════════════════════════════════════════
    //  تبديل خطوات الاستمارة (طلب جديد)
    // ══════════════════════════════════════════
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
            if (i === current) { ps.classList.add('active'); }
        }
    }

    // ══════════════════════════════════════════
    //  تبديل تبويبات نوع الطلب - جديد
    // ══════════════════════════════════════════
    window.switchRequestTab = function(tab) {
        document.querySelectorAll('.req-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.req-content').forEach(c => c.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        document.getElementById('content-' + tab).classList.add('active');
    };

    // ══════════════════════════════════════════
    //  أزرار الترحيب → فتح الاستمارة
    // ══════════════════════════════════════════
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

    // ══════════════════════════════════════════
    //  إغلاق المودال
    // ══════════════════════════════════════════
    function hideModal() {
        document.getElementById('welcomePopup').style.display = 'none';
    }
    document.getElementById('closePopup').addEventListener('click', hideModal);
    document.getElementById('welcomePopup').addEventListener('click', function (e) {
        if (e.target === this) hideModal();
    });

    const donateBtn = document.getElementById('popupDonateAction');
    if (donateBtn) donateBtn.addEventListener('click', hideModal);

    // ══════════════════════════════════════════
    //  أزرار الجنس
    // ══════════════════════════════════════════
    document.querySelectorAll('.gender-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            selectedGender = this.dataset.value;
            hideError('gender');
        });
    });

    // ══════════════════════════════════════════
    //  أزرار الأعراض
    // ══════════════════════════════════════════
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

    // ══════════════════════════════════════════
    //  زر إضافة عرض آخر
    // ══════════════════════════════════════════
    document.getElementById('addSymptomBtn').addEventListener('click', function () {
        const wrap = document.getElementById('extraSymptomWrap');
        const isOpen = wrap.style.display === 'block';
        wrap.style.display = isOpen ? 'none' : 'block';
        this.innerHTML = isOpen
            ? '<i class="fas fa-plus" style="font-size:11px"></i> Add another symptom'
            : '<i class="fas fa-minus" style="font-size:11px"></i> Cancel';
        if (!isOpen) document.getElementById('extra_symptom').focus();
    });

    // ══════════════════════════════════════════
    //  أزرار تقييم التأثير
    // ══════════════════════════════════════════
    document.querySelectorAll('.impact-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.impact-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            selectedImpact = this.dataset.level;
            hideError('impact');
        });
    });

    // ══════════════════════════════════════════
    //  Validation helpers
    // ══════════════════════════════════════════
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
        if (!name) { showError('child_name'); ok = false; } else { hideError('child_name'); }
        if (!age || age < 3 || age > 18) { showError('child_age'); ok = false; } else { hideError('child_age'); }
        if (!selectedGender) { showError('gender'); ok = false; } else { hideError('gender'); }
        return ok;
    }

    function validateStep2() {
        let ok = true;
        const name     = document.getElementById('guardian_name').value.trim();
        const relation = document.getElementById('guardian_relation').value;
        const phone    = document.getElementById('guardian_phone').value.trim();
        if (!name)     { showError('guardian_name');     ok = false; } else { hideError('guardian_name'); }
        if (!relation) { showError('guardian_relation'); ok = false; } else { hideError('guardian_relation'); }
        if (!phone || phone.replace(/\D/g,'').length < 7) {
            showError('guardian_phone'); ok = false;
        } else { hideError('guardian_phone'); }
        return ok;
    }

    function validateStep3() {
        let ok = true;
        if (selectedSymptoms.length === 0) { showError('symptoms'); ok = false; } else { hideError('symptoms'); }
        if (!selectedImpact)               { showError('impact');   ok = false; } else { hideError('impact'); }
        const notes = document.getElementById('notes').value.trim();
        if (notes.length < 20) { showError('notes'); ok = false; } else { hideError('notes'); }
        return ok;
    }

    // ══════════════════════════════════════════
    //  التنقل بين مراحل الطلب الجديد
    // ══════════════════════════════════════════
    document.getElementById('backToWelcome').addEventListener('click', () => switchView('view-welcome'));
    document.getElementById('backStep2').addEventListener('click',    () => showStep(1));
    document.getElementById('backStep3').addEventListener('click',    () => showStep(2));

    document.getElementById('nextStep1').addEventListener('click', () => {
        if (validateStep1()) showStep(2);
    });

    document.getElementById('nextStep2').addEventListener('click', () => {
        if (validateStep2()) showStep(3);
    });

    // ══════════════════════════════════════════
    //  توليد رقم مرجعي عشوائي
    // ══════════════════════════════════════════
    function generateRefNumber() {
        const year = new Date().getFullYear();
        const num  = String(Math.floor(Math.random() * 90000) + 10000).padStart(5, '0');
        return `MH-${year}-${num}`;
    }

    // ══════════════════════════════════════════
    //  إرسال الطلب الجديد عبر Ajax
    // ══════════════════════════════════════════
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

            // عرض الرقم المرجعي في صفحة النجاح
            // إذا رجع السيرفر رقماً استخدمه، وإلا ولّد محلياً مؤقتاً
            const refNumber = data.ref_number || generateRefNumber();
            document.getElementById('successRefNumber').textContent = refNumber;

            switchView('view-success');

            if (data.whatsapp_url) {
                document.getElementById('finalWhatsappBtn').href = data.whatsapp_url;
            }

            if (selectedChannel === 'whatsapp') {
                setTimeout(() => {
                    const waUrl = data.whatsapp_url || 'https://wa.me/yournumber';
                    window.open(waUrl, '_blank');
                }, 1500);
            }

        } catch (error) {
            console.error('Submission error:', error);
            alert('Something went wrong. Please try again or contact us directly.');
            btn.disabled = false;
            btn.classList.remove('loading');
        }
    });

    // ══════════════════════════════════════════
    //  البحث عن الحالة القديمة بالرقم المرجعي - جديد
    // ══════════════════════════════════════════

    // إعادة تعيين نتائج البحث عند الكتابة
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

        if (!rawVal) {
            refInput.focus();
            return;
        }

        const btn = document.getElementById('refLookupBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';

        // إعادة تعيين الحالة
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

                // رسم الـ initials
                const initials = data.child.name
                    .split(' ')
                    .map(w => w[0])
                    .slice(0, 2)
                    .join('')
                    .toUpperCase();

                document.getElementById('childAvatarInitials').textContent = initials;
                document.getElementById('childRecordName').textContent     = data.child.name;
                document.getElementById('childRecordMeta').textContent     =
                    `Age ${data.child.age} · ${data.child.grade || '—'} · ${data.child.gender || '—'}`;
                document.getElementById('childRefBadge').textContent = refVal;

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
            btn.innerHTML = '<i class="fas fa-search"></i> Find';
        }
    };

    // إرسال المتابعة عبر واتساب - جديد
    window.sendFollowupWhatsApp = function() {
        const note = document.getElementById('followupNote').value.trim();
        const errEl = document.getElementById('err-followup-note');

        if (note.length < 20) {
            errEl.classList.add('show');
            return;
        }
        errEl.classList.remove('show');

        if (!foundChildRecord) return;

        const refVal = document.getElementById('refNumberInput').value.trim();

        // بناء رسالة الواتساب المنسقة
        const message =
            `📋 *Follow-up Request*\n` +
            `──────────────────\n` +
            `🔖 *Ref:* ${refVal}\n` +
            `👦 *Child:* ${foundChildRecord.name}` +
            (foundChildRecord.age   ? ` (Age ${foundChildRecord.age}` : '') +
            (foundChildRecord.grade ? `, ${foundChildRecord.grade})` : ')') +
            `\n──────────────────\n` +
            `📝 *New concern:*\n${note}`;

        /*
         * ── Laravel Endpoint ──
         * يُفضَّل عمل POST للـ backend أولاً لحفظ المتابعة في قاعدة البيانات
         * ثم إعادة توجيه لواتساب
         * هنا نفتح واتساب مباشرة + نرسل للـ backend في الخلفية
         */
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        fetch('/reachout/followup', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                ref_number: refVal,
                note: note,
            }),
        }).catch(err => console.error('Followup save error:', err));

        // فتح واتساب مباشرة
        const waNumber = '972568200088';
        window.open(
            `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`,
            '_blank'
        );
    };

    // Allow Enter key to trigger lookup
    document.getElementById('refNumberInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') window.lookupReference();
    });

});
</script>
</body>
</html>