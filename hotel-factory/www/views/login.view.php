<?php
use HotelFactory\core\Helper;
?>
<div>
  <h1>Connexion</h1>
    <?php

    $this->addModal("form", $configFormUser); ?>
    </br>
    <a href="<?= Helper::getUrl("User","forgotPassword")?>">Mot de passe oublié</a>
    </br></br>
    <a href="<?= Helper::getUrl("Home","default")?>">Retour à l'accueil</a>
</div>
