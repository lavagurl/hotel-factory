<?php
    use HotelFactory\core\Helper;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hotel Factory</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

</head>
<body>
<div>
    <ul>
        <li> <a href="<?= Helper::getUrl("User","index")?>">Mon profil</a> </li>
        <li> <a href="<?= Helper::getUrl("User","logout")?>">Se déconnecter</a> </li>
    </ul>
</div>
<ul>
    <?php if($_SESSION['role'] == 1): ?>
        <li> <a href="<?= Helper::getUrl("User","default")?>">Accueil</a> </li>
        <li> <a href="<?= Helper::getUrl("Page","default")?>">Mes pages</a> </li>
        <li> <a href="<?= Helper::getUrl("Comment","list")?>">Commentaires</a> </li>
        <li> <a href="<?= Helper::getUrl("User","list")?>">Permissions</a> </li>
        <li> <a href="<?= Helper::getUrl("Question","list")?>">FAQ</a> </li>
        <li> <a href="<?= Helper::getUrl("Hotel","list")?>">Hotels</a> </li>
    <?php elseif($_SESSION['role'] == 2): ?>

        <li> <a href="<?= Helper::getUrl("User","default")?>">Accueil</a> </li>
        <li> <a href="<?= Helper::getUrl("Page","default")?>">Mes pages</a> </li>
        <li> <a href="<?= Helper::getUrl("Hotel","createHotel")?>">Mon hotel</a> </li>
        <li> <a href="<?= Helper::getUrl("Comment","formComment")?>">Paramètres</a> </li>
        <li> <a href="<?= Helper::getUrl("Question","list")?>">FAQ</a> </li>

    <?php elseif($_SESSION['role'] == 3): ?>
        <li> <a href="<?= Helper::getUrl("User","default")?>">Accueil</a> </li>
        <li> <a href="<?= Helper::getUrl("Comment","list")?>">Commentaires</a> </li>
        <li> <a href="<?= Helper::getUrl("Question","list")?>">FAQ</a> </li>
    <?php endif; ?>
</ul>

<div>
    <?php include "views/".$this->view.".view.php";?>
</div>
</body>
</html>
