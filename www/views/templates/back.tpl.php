<?php  use HotelFactory\core\Helper; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Template de back</title>
</head>
<body>
  <div>
    <img src="#" alt="Photo de profil utilisateur" />
    <ul>
      <li> <a href="/profile">Mon profil</a> </li>
      <li> <a href="/se-deconnecter">Se déconnecter</a> </li>
    </ul>
  </div>
  <ul>
      <?php if($_SESSION['role'] == "1"): ?>
          <li> <a href="/dashboard">Accueil</a> </li>
          <li> <a href="/dashboard/mes-pages">Mes pages</a> </li>
          <li> <a href="/dashboard/apparences">Apparences</a> </li>
          <li> <a href="/dashboard/comments">Commentaires</a> </li>
          <li> <a href="/dashboard/permissions">Permissions</a> </li>
          <li> <a href="/dashboard/parametres">Paramètres</a> </li>
          <li> <a href="/dashboard/faq">FAQ</a> </li>
      <?php else: ?>

    <li> <a href="/settings">Accueil</a> </li>
    <li> <a href="/settings/mes-pages">Mes pages</a> </li>
    <li> <a href="/settings/apparences">Apparences</a> </li>
    <li> <a href="/settings/parametres">Paramètres</a> </li>
    <li> <a href="/settings/faq">FAQ</a> </li>

      <?php endif; ?>
  </ul>

  <div>
          <?php include "views/".$this->view.".view.php";?>
  </div>
</body>
</html>
