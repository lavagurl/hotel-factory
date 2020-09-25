<?php
use HotelFactory\core\Helper; ?>

<div class="row">
  <div  class="col">
    
  </div>

  <div style="padding-top: 1.5rem;" class="col">
  <center><h1>Connexion</h1></center>
    <?php $this->addModal("form", $configFormUser); ?>
    <center><a href="<?= Helper::getUrl("User", "forgotPassword") ?>">Mot de passe oublié</a> / <a href="/home">Retour à l'accueil</a></center>
    
  </div>


  <div class="col">
  </div>


</div>
