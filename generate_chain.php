<?php
// Script to generate high-detail interlocking chain corner with real transparent holes
$svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <!-- Realistic steel/gunmetal gradient with bright specular ridge -->
    <linearGradient id="chainSteel" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1e293b" />
      <stop offset="20%" stop-color="#64748b" />
      <stop offset="45%" stop-color="#f1f5f9" />
      <stop offset="55%" stop-color="#cbd5e1" />
      <stop offset="85%" stop-color="#475569" />
      <stop offset="100%" stop-color="#0f172a" />
    </linearGradient>

    <!-- Warm Reachout Gold / Bronze gradient for alternating links -->
    <linearGradient id="chainGold" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#78350f" />
      <stop offset="25%" stop-color="#d97706" />
      <stop offset="50%" stop-color="#fef3c7" />
      <stop offset="75%" stop-color="#b45309" />
      <stop offset="100%" stop-color="#451a03" />
    </linearGradient>

    <!-- Realistic drop shadow -->
    <filter id="chainDropShadow" x="-30%" y="-30%" width="160%" height="160%">
      <feDropShadow dx="3" dy="4" stdDeviation="3.5" flood-color="#051726" flood-opacity="0.45" />
    </filter>

    <clipPath id="topArcClip">
      <rect x="-30" y="-30" width="60" height="30" />
    </clipPath>
    <clipPath id="leftArcClip">
      <rect x="-30" y="-30" width="30" height="60" />
    </clipPath>
  </defs>

  <g filter="url(#chainDropShadow)">

    <!-- ══ LINK 1: Far Right Horizontal Link ══ -->
    <g transform="translate(90, 18)">
      <!-- Outer dark outline for contrast -->
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="#091422" stroke-width="7" />
      <!-- Metallic core body -->
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="url(#chainSteel)" stroke-width="5" />
      <!-- Specular shine line -->
      <path d="M -10 -7 L 10 -7" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.9" />
    </g>

    <!-- ══ LINK 2: Interlocking Link (Gold/Bronze) Connecting L1 to Corner ══ -->
    <g transform="translate(68, 18) rotate(15)">
      <!-- Back / Under layer -->
      <rect x="-15" y="-7" width="30" height="14" rx="7" fill="none" stroke="#261204" stroke-width="6.5" />
      <rect x="-15" y="-7" width="30" height="14" rx="7" fill="none" stroke="url(#chainGold)" stroke-width="4.5" />
      <path d="M -8 -5 L 8 -5" stroke="#ffffff" stroke-width="1" stroke-linecap="round" opacity="0.8" />
    </g>

    <!-- Overlay part of Link 1 looping over Link 2 (interlocking illusion) -->
    <g transform="translate(90, 18)" clip-path="url(#leftArcClip)">
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="#091422" stroke-width="7" />
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="url(#chainSteel)" stroke-width="5" />
    </g>

    <!-- ══ LINK 3: Approaching Corner ══ -->
    <g transform="translate(46, 20) rotate(-12)">
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="#091422" stroke-width="7" />
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="url(#chainSteel)" stroke-width="5" />
      <path d="M -9 -6.5 L 9 -6.5" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.9" />
    </g>

    <!-- ══ LINK 4: The Corner Pivot Link (Angled at -45° to wrap the 90° corner) ══ -->
    <g transform="translate(26, 26) rotate(-45)">
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="#261204" stroke-width="7" />
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="url(#chainGold)" stroke-width="5" />
      <path d="M -9 -6.5 L 9 -6.5" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.95" />
    </g>

    <!-- Overlay part of Link 3 over Link 4 -->
    <g transform="translate(46, 20) rotate(-12)" clip-path="url(#leftArcClip)">
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="#091422" stroke-width="7" />
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="url(#chainSteel)" stroke-width="5" />
    </g>

    <!-- ══ LINK 5: Vertical Connector Link ══ -->
    <g transform="translate(20, 48) rotate(78)">
      <rect x="-16" y="-7.5" width="32" height="15" rx="7.5" fill="none" stroke="#091422" stroke-width="6.5" />
      <rect x="-16" y="-7.5" width="32" height="15" rx="7.5" fill="none" stroke="url(#chainSteel)" stroke-width="4.5" />
      <path d="M -8 -5.5 L 8 -5.5" stroke="#ffffff" stroke-width="1.1" stroke-linecap="round" opacity="0.9" />
    </g>

    <!-- ══ LINK 6: Mid Vertical Link (Gold) ══ -->
    <g transform="translate(18, 70) rotate(88)">
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="#261204" stroke-width="7" />
      <rect x="-17" y="-8.5" width="34" height="17" rx="8.5" fill="none" stroke="url(#chainGold)" stroke-width="5" />
      <path d="M -9 -6.5 L 9 -6.5" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.9" />
    </g>

    <!-- Overlay part of Link 5 over Link 6 -->
    <g transform="translate(20, 48) rotate(78)" clip-path="url(#topArcClip)">
      <rect x="-16" y="-7.5" width="32" height="15" rx="7.5" fill="none" stroke="#091422" stroke-width="6.5" />
      <rect x="-16" y="-7.5" width="32" height="15" rx="7.5" fill="none" stroke="url(#chainSteel)" stroke-width="4.5" />
    </g>

    <!-- ══ LINK 7: Bottom-most Vertical Link ══ -->
    <g transform="translate(18, 94) rotate(90)">
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="#091422" stroke-width="7" />
      <rect x="-18" y="-9" width="36" height="18" rx="9" fill="none" stroke="url(#chainSteel)" stroke-width="5" />
      <path d="M -10 -7 L 10 -7" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round" opacity="0.9" />
    </g>

    <!-- Decorative small steel rivet anchor at corner -->
    <circle cx="26" cy="26" r="4.5" fill="#0f172a" />
    <circle cx="26" cy="26" r="3.2" fill="url(#chainGold)" />
    <circle cx="25" cy="25" r="1.2" fill="#ffffff" opacity="0.8" />
  </g>
</svg>';

file_put_contents('public/reachout/img/chain-corner.svg', $svg);
echo "Refined chain SVG saved successfully!\n";
