<?php
$im = imagecreatefromjpeg('public/reachout/img/hero_girl_wide.jpg');
$w = imagesx($im);
$h = imagesy($im);
echo "W: $w, H: $h\n";

// In the original, the two men are on the left (from x=0 to x=320).
// The girl is roughly from x=450 to x=600.
// If we crop from x=280 to x=1024:
// The girl will be at (450 - 280) = 170px (which is 23% from the left)!
// And the right side will have (1024 - 280) = 744px of space!
$cropX = 260; // cut out the two men on the left
$cropW = $w - $cropX;
$cropped = imagecrop($im, ['x' => $cropX, 'y' => 0, 'width' => $cropW, 'height' => $h]);
if ($cropped) {
    imagejpeg($cropped, 'public/reachout/img/hero_girl_cropped.jpg', 96);
    echo "Cropped successfully! New width: $cropW, height: $h\n";
}
