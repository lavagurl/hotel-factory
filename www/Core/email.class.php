<?php

// A travailler
if(file_exists("./PHPMAILER-master/src/PHPMailer.php")){
    include "./PHPMAILER-master/src/PHPMailer.php";
}
else{
    die("PHPMailer non trouvé !"); 
}

$email = new PHPMailer();

$email ->isSMTP();
$email ->Host = 'hotelfactory.esgi@gmail.com';
$email ->SMTPAuth = true;
$email ->Username = 'hotelfactory.esgi@gmail.com';
$email ->Password = 'hotelfactory2020';
$email ->SMTPSecure = 'ssl';
$email ->Port = 465;

$email -> setFrom('hotelfactory.esgi@gmail.com', 'HotelFactory');
$email -> addAddress('mailDuDestinataire à récuperer', 'Nom du destinataire');

$email -> isHTML(true);

$email -> Subject = "Confirmation d'inscription";
$email -> Body = 'Mail en HTML';
$email -> AltBody = 'Body du mail en non-html';
