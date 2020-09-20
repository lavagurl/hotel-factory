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
        <li> <a href="/profile">Mon profil</a> </li>
        <li> <a href="/se-deconnecter">Se déconnecter</a> </li>
    </ul>
</div>
<ul>
    <?php if($_SESSION['role'] == 1): ?>
        <li> <a href="/dashboard">Accueil</a> </li>
        <li> <a href="/dashboard/mes-pages">Mes pages</a> </li>
        <li> <a href="/dashboard/comments">Commentaires</a> </li>
        <li> <a href="/dashboard/permissions">Permissions</a> </li>
        <li> <a href="/dashboard/faq">FAQ</a> </li>
        <li> <a href="/dashboard/hotels">Hotels</a> </li>
    <?php elseif($_SESSION['role'] == 2): ?>

        <li> <a href="/settings">Accueil</a> </li>
        <li> <a href="/settings/mes-pages">Mes pages</a> </li>
    <?php if(isset($_SESSION['hotel']) && !(empty($_SESSION['hotel']))): ?>
        <li> <a href="/settings/update_hotel">Mon hotel</a> </li>
        <?php else: ?>
            <li> <a href="/settings/create_hotel">Mon hotel</a> </li>
    <?php endif; ?>
        <li> <a href="/settings/parametres">Paramètres</a> </li>
        <li> <a href="/settings/faq">FAQ</a> </li>

    <?php elseif($_SESSION['role'] == 3): ?>
        <li> <a href="/dashboard">Accueil</a> </li>
        <li> <a href="/dashboard/comments">Commentaires</a> </li>
        <li> <a href="/dashboard/faq">FAQ</a> </li>
    <?php endif; ?>
</ul>

<div>
    <?php include "views/".$this->view.".view.php";?>
</div>
</body>
</html>
