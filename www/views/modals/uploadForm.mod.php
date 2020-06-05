<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
<form action="<?php \Projet_annuel\core\Upload::checkUpload(); ?>" method="post" enctype="multipart/form-data">
    Selectionnez une image a uploader
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Charger l'image" name="submit">
</form>
</body>
</html>
