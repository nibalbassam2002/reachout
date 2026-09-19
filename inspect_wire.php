<?php
$img = imagecreatefrompng('public/reachout/img/wire-v.png');
$w = imagesx($img);
$h = imagesy($img);

// Let's measure the width of non-transparent pixels at each Y to detect barbs (barbs are wider than the center wire)
$widths = [];
for ($y = 0; $y < $h; $y++) {
    $min_x = $w;
    $max_x = 0;
    for ($x = 0; $x < $w; $x++) {
        $rgba = imagecolorat($img, $x, $y);
        $alpha = ($rgba & 0x7F000000) >> 24;
        if ($alpha < 100) {
            if ($x < $min_x) $min_x = $x;
            if ($x > $max_x) $max_x = $x;
        }
    }
    $row_w = ($max_x >= $min_x) ? ($max_x - $min_x + 1) : 0;
    $widths[$y] = $row_w;
}

// Find peaks where width > 12 (barbs)
$barbs = [];
for ($y = 1; $y < $h - 1; $y++) {
    if ($widths[$y] > 14 && $widths[$y] >= $widths[$y - 1] && $widths[$y] >= $widths[$y + 1]) {
        // Debounce within 30px
        $last = end($barbs);
        if (!$last || ($y - $last) > 30) {
            $barbs[] = $y;
        }
    }
}

echo "Detected barbs at Y positions:\n";
foreach ($barbs as $b) {
    echo "  Barb at Y = $b (width = {$widths[$b]}px)\n";
}
echo "Total barbs in 622px: " . count($barbs) . "\n";
