<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Template de front</title>
</head>
<body>
<ul>
    <li><a href="/home">Accueil</a></li>
    <li><a href="/room/list">Chambres</a></li>
    <li><a href="/service/list">Services</a></li>
    <li><a href="/comment/list">Commentaire</a></li>
    <li><a href="/home/contact">Nous contacter</a></li>
</ul>
<div>
    <?php include "views/".$this->view.".view.php";?>
</div>
</body>
</html>
