<?php

 // Parser fichier yaml
 $listOfRoutes=yaml_parse_file("../routes.yml");
 //générer fichier php transformant le fichier yaml en fichier php sous forme de tableau

    $data = var_export($listOfRoutes, true); //retranscrit le contenu d'une variable en php brut

 file_put_contents("../cache/routes.cache.php", "<?php".$data);


// récuperer le fichier yaml

// Mettre dans une variable

// var export pour récuperer une chaine de caractères

// la mettre dans un fichier php (file_put_contents)