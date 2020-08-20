<?php
use HotelFactory\core\Helper;
?>
<div>
  <h1>Inscription</h1>
  <?php $this->addModal("form", $configFormUser); ?>

</br>
<a href="<?= Helper::getUrl("User","login")?>">Se connecter</a>
</br>
<a href="<?= Helper::getUrl("Home","default")?>">Retour à l'accueil</a>
</div>
