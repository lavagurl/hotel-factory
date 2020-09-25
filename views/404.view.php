<?php

use HotelFactory\core\Helper;

if (empty($_SESSION['role'])) :
  $chemin = Helper::getUrl("Home", "default");
else :
  $chemin = Helper::getUrl("User", "default");
endif;

?>
<div class="row">
  <div class="col"></div>
  <div class="col-6">
    <img src="/script/images/404.jpg" style="display: inline-block;
    width: 100%;
    height: auto;" />
    <center>
      <h1>Erreur 404: la page n'existe pas.</h1>
      <a href="/home">Retour à l'accueil</a>
    </center>
  </div>
  <div class="col"></div>
</div>