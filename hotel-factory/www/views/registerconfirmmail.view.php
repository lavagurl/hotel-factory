<?php
    use HotelFactory\core\Helper;
?>
<div>
    <h1>Inscription</h1>
    <p>
        Votre email a été validé avec succès.<br/>
        Vous pouvez maintenant vous connecter à votre espace.
    </p>
    </br>
    <a href="<?= Helper::getUrl("User","login")?>">Se connecter</a>
    </br>
    <a href="<?= Helper::getUrl("Home","default")?>">Retour à l'accueil</a>
</div>