<?php

if(empty($_SESSION['role'])) {
  $chemin = "/home";
}elseif($_SESSION['role'] == "1"){
  $chemin = "/dashboard";
}elseif($_SESSION['role']=="2"){
  $chemin = "/settings";
}

?>
<div>
  <h1>Erreur 404</h1>
  <p>Vous êtes perdu ?</p>
  <a href="<?php echo $chemin; ?>">Retour à l'accueil</a>
</div>
