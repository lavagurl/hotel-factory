<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

use HotelFactory\core\ConstantLoader;
use HotelFactory\Core\MiddleWareManager;
use HotelFactory\core\Router;

//include_once 'autoloader.php';
function myAutoloader($class)
{
    $class = str_replace('HotelFactory','',$class);
    $class = str_replace('\\', '/', $class).'.php';
    if($class[0] == '/')
        $class = substr($class, 1);
    if (file_exists($class))
        include ($class);
}

spl_autoload_register("myAutoloader");

new ConstantLoader();


$uri = $_SERVER["REQUEST_URI"];
MiddleWareManager::launch('onRequest');
new Router();
//$listOfRoutes = yaml_parse_file("routes.yml");
//
//
//if (!empty($listOfRoutes[$uri])) {
//    $c =  $listOfRoutes[$uri]["controller"]."Controller";
//    $a =  $listOfRoutes[$uri]["action"]."Action";
//
//    $pathController = "controllers/".$c.".php";
//    $c = "\\HotelFactory\\Controllers\\".$c;
//
//    if (file_exists($pathController)) {
//        include $pathController;
//        //Vérifier que la class existe et si ce n'est pas le cas faites un die("La class controller n'existe pas")
//        if (class_exists($c)) {
//            $controller = new $c();
//
//            //Vérifier que la méthode existeet si ce n'est pas le cas faites un die("L'action' n'existe pas")
//            if (method_exists($controller, $a)) {
//
//                //EXEMPLE :
//                //$controller est une instance de la class UserController
//                //$a = userAction est une méthode de la class UserController
//                $controller->$a();
//            } else {
//                die("L'action' n'existe pas");
//            }
//        } else {
//            die("La class controller n'existe pas");
//        }
//    } else {
//        die("Le fichier controller n'existe pas");
//    }
//} else {
//    header('Location: /vous-etes-perdu');
//}
