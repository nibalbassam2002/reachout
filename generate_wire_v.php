<?php
$h_svg = file_get_contents('public/reachout/img/wire-h.svg');

// Extract all path elements from wire-h.svg
preg_match_all('/<path[^>]+>/', $h_svg, $matches);
$paths = implode("\n", $matches[0]);

// Create wire-v.svg with width 22, height 693, rotating the horizontal paths by 90 degrees
$v_svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="22" height="693" viewBox="0 0 22 693" fill="none" xmlns="http://www.w3.org/2000/svg">
  <g transform="matrix(0 1 1 0 0 0)">
    ' . $paths . '
  </g>
</svg>';

file_put_contents('public/reachout/img/wire-v.svg', $v_svg);
echo "wire-v.svg created successfully with size: " . strlen($v_svg) . " bytes\n";
