<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

use HotelFactory\Core\ConstantLoader;

//include_once 'autoloader.php';
function myAutoloader($class)
{
  $class = explode("\\",$class)[count(explode("\\",$class))-1];
  if (file_exists("core/".$class.".php")) {
      include "core/".$class.".php";
  } elseif (file_exists("models/".$class.".php")) {
      include "models/".$class.".php";
  } elseif (file_exists("services/".$class.".php")) {
      include "services/".$class.".php";
  } elseif (file_exists("managers/".$class.".php")) {
      include "managers/".$class.".php";
  } elseif (file_exists("forms/".$class.".php")) {
      include "forms/".$class.".php";
  } elseif (file_exists("connection/".$class.".php")) {
      include "connection/".$class.".php";
  } elseif (file_exists($class.".php")){
      include $class.".php";
  }

}

spl_autoload_register("myAutoloader");

new ConstantLoader();


$uri = $_SERVER["REQUEST_URI"];


$listOfRoutes = yaml_parse_file("routes.yml");


if (!empty($listOfRoutes[$uri])) {
    $c =  $listOfRoutes[$uri]["controller"]."Controller";
    $a =  $listOfRoutes[$uri]["action"]."Action";

    $pathController = "controllers/".$c.".php";
    $c = "\\HotelFactory\\Controllers\\".$c;

    if (file_exists($pathController)) {
        include $pathController;
        //Vérifier que la class existe et si ce n'est pas le cas faites un die("La class controller n'existe pas")
        if (class_exists($c)) {
            $controller = new $c();

            //Vérifier que la méthode existeet si ce n'est pas le cas faites un die("L'action' n'existe pas")
            if (method_exists($controller, $a)) {

                //EXEMPLE :
                //$controller est une instance de la class UserController
                //$a = userAction est une méthode de la class UserController
                $controller->$a();
            } else {
                die("L'action' n'existe pas");
            }
        } else {
            die("La class controller n'existe pas");
        }
    } else {
        die("Le fichier controller n'existe pas");
    }
} else {
    header('Location: /vous-etes-perdu');
}
