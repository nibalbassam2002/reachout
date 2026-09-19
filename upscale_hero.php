<?php
// Load original uploaded image (1024 x 463)
$src = imagecreatefromjpeg('C:/Users/nibal/.gemini/antigravity-ide/brain/ae71d278-fef0-4efc-9059-ab273d7b905b/.user_uploaded/media_1789394029425.jpg');
$sw = imagesx($src);
$sh = imagesy($src);

// High-definition 2X resample (2048 x 926) with bicubic smoothing
$targetW = 2048;
$targetH = 926;
$dst = imagecreatetruecolor($targetW, $targetH);
imagealphablending($dst, false);
imagesavealpha($dst, true);

imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetW, $targetH, $sw, $sh);

// Sharpen slightly to remove blur
$matrix = [
    [-1, -1, -1],
    [-1, 16, -1],
    [-1, -1, -1]
];
$divisor = 8;
$offset = 0;
imageconvolution($dst, $matrix, $divisor, $offset);

imagejpeg($dst, 'public/reachout/img/hero_girl_wide_hd.jpg', 96);
echo "Generated HD image (2048x926) successfully!\n";
