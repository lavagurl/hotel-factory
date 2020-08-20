<?php
    use HotelFactory\core\Helper;
?>
<div>
  <h1>Bienvenue !</h1>
  <a href="<?= Helper::getUrl("User","login")?>">Se connecter</a>
</br>
  <a href="<?= Helper::getUrl("User","register")?>">S'inscrire</a>

    <div>
        <?php $this->addModal("show_comments", $configTableComments); ?>
    </div>

    <div>
        <a href="<?= Helper::getUrl("Home","conditions")?>">Conditions d'utilisation</a>
    </div>

</div>
