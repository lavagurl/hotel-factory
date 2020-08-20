<?php
    use HotelFactory\core\Helper;
?>
<div>
    <h1>Inscription</h1>
    <p>
        Votre compte a bien été enregistré.<br/>
        Merci de vérifier vos emails afin de valider votre compte.
    </p>
    </br>
    <a href="<?= Helper::getUrl("User","login")?>">Se connecter</a>
    </br>
    <a href="<?= Helper::getUrl("Home","default")?>">Retour à l'accueil</a>
</div>