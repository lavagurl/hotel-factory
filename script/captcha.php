<?php
session_start();
header("Content-type: image/png");

$width = 300;
$hight = 80;
$image = imagecreate($width, $hight);
$back = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));


$charsAuthorized = "abcdefghijklmnopqrstuvwxyz0123456789";
$charsAuthorized = str_shuffle($charsAuthorized);
$lengthCaptcha = rand(3,6);
$captcha = substr($charsAuthorized, 0, $lengthCaptcha);
$_SESSION["captcha"] = $captcha;

$listOfFonts = glob(dirname(__FILE__)."/fonts/*.ttf");

for($i=0;$i<$lengthCaptcha;$i++){
    $colors[] = imagecolorallocate($image, rand(150,250), rand(150,250), rand(150,250));

    imagefttext($image, rand($hight/5,$hight/4), rand(0,360), $width/($lengthCaptcha+4)+($width/$lengthCaptcha)*$i, rand($hight/3,$hight*2/3), $colors[$i], $listOfFonts[array_rand($listOfFonts)], $captcha[$i]);
}

$nbGeo = rand(4,10);
for($i=0 ; $i<=$nbGeo ; $i++){

    $draw = rand(1,3);
    switch ($draw) {
        case 1:
            imagerectangle($image, rand(0,400), rand(0,200), rand(0,400), rand(0,200), $colors[array_rand($colors)]);
            break;

        case 2:
            imageellipse($image, rand(0,400), rand(0,200), rand(0,400), rand(0,200), $colors[array_rand($colors)]);
            break;

        default:
            imageline($image, rand(0,400), rand(0,200), rand(0,400), rand(0,200), $colors[array_rand($colors)]);
            break;
    }

}

imagepng($image);


