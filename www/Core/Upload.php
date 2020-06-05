<?php


namespace HotelFactory\core;


class Upload
{
    public static function checkUpload(){
        $target_dir = "public/img";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        $upload0k = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Verification si c'est bien une image

        if (isset($_POST["submit"])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check != false){
                echo "Le fichier est une image - ".$check["mime"].".";
                $upload0k = 1;
            } else {
                echo "Le fichier n'est pas une image";
                $upload0k = 0;
            }
        }

        // Verification que le fichier n'existe pas

        if(file_exists($target_file)){
            echo "Le fichier existe deja et ne sera uploade";
        }

        // Verification du format du fichier

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
            echo "Format d'image invalide. Veuillez selectionner un fichier .jpeg ou .png ou .jgp";
            $upload0k = 0;
        }

        // Verification taille fichier

        if($_FILES["fileToUpload"]["size"] > 1000000){
            echo "Le fichier est trop lourd";
            $upload0k = 0;
        }

        // Verification si les conditions d'upload sont bonnes et lancement du telechargement

        if ($upload0k == 0){
            echo "Le fichier n'a pas pu etre telecharge a cause d'une erreur.";
        } else {
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                echo "Fichier uploade avec succes.";
            } else {
                echo "Erreur : le fichier n'a pas pu etre uploade.";
            }
        }

    }
}