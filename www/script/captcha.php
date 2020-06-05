<?php

session_start();
header("Content-type: image/png");

$image = imagecreate(500,200); // Créer une image avec sa largueur et sa hauteur.

//$backgroundcolor = imagecolorallocate($image, rand(0,255),rand(0,255),rand(0,255));

//$writingcolor = imagecolorallocate($image, rand(0,255),rand(0,255),rand(0,255));

//imagestring($image, 5, 10, 10, "test", $writingcolor);
//imagestring($image, 5, 50, 50, "test2", $writingcolor);

// Generer une chaine de caractères aleatoires d'une longueur aleatoire entre 6 et 8
// Afficher cette chaine dans l'image
// -> Avec une police aléatoire par caractère au format ttf se trouvant dans le dossier fonts
// -> si je rajoute un fichier ttf, il doit être automatiquement pris en compte
// -> avec une position aléatoire par caractère
// -> avec un angle aléatoire par caractère
// -> avec une couleur aléatoire par caratère
// -> avec une taille aléatoire par caractère
// -> la couleur de fond doit être aléatoire

// ajouter par dessus un nombre aléatoire de formes géométriques de couleurs déjà utilisés par le texte sur des positions aléatoires
// Attention doit être lisible


$charAllowed = "azertyuiopqsdfghjklmwxcvbn0132456789";
$charAllowed = str_shuffle($charAllowed);

$captcha = substr($charAllowed, 0, rand(6,8));
$_SESSION["captcha"] = $captcha;

$listOfFonts = glob("fonts/*.ttf"); 

$background = imagecolorallocate($image, rand(160,255), rand(160,255), rand(160,255));

$x = rand(40,60);

for ($i=0; $i < strlen($captcha) ; $i++) { 
    
    $color[] = imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));

    imagettftext($image, rand(40,80), rand(-20,20), $x, rand(70,150), $color[$i], $listOfFonts[rand(0, count($listOfFonts)-1)], $captcha[$i]);

    $x+= rand(40,60);
}

$nbShapes = rand(4,6);

for ($i=0; $i < $nbShapes; $i++) { 
    
    $j = rand(0,2);

    switch ($j) {
        case 0:
            imageline($image, rand(0,500), rand(0,200), rand(0,500), rand(0,200), $color[rand(0, count($color)-1)]);
            break;
        case 1:
            imageellipse($image, rand(0,500), rand(0,200), rand(0,500), rand(0,200), $color[rand(0, count($color)-1)]);
        break;
        default:
            imagerectangle($image, rand(0,500), rand(0,200), rand(0,500), rand(0,200), $color[rand(0, count($color)-1)]);
            break;
    }
}

imagepng($image);