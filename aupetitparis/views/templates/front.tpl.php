<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Template de front</title>
</head>
<body>
<ul>
    <li><a href="/home">Accueil</a></li>
    <li><a href="">Services</a></li>
    <li><a href="">Chambres</a></li>
    <li><a href="">Avis</a></li>
</ul>
<div>
    <?php include "views/".$this->view.".view.php";?>
</div>
</body>
</html>
