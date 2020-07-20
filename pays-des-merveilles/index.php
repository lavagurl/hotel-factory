<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();


use HOTEL\core\ConstantLoader;
use HOTEL\core\MiddleWareManager;
use HOTEL\core\Router;
use HOTEL\managers\HotelManager;


function myAutoloader($class)
{
    $class = str_replace('HOTEL','',$class);
    $class = str_replace('\\', '/', $class).'.php';
    if($class[0] == '/')
        $class = substr($class, 1);
    if (file_exists($class))
        include ($class);
}

spl_autoload_register("myAutoloader");

new ConstantLoader();

$hotelManager = new HotelManager();
$subdomain = explode('.', $_SERVER['SERVER_NAME']);
$result = $hotelManager->findBy(array("route"=>$subdomain[0]));
$_SESSION['hotel'] = $result[0]->getId();


$uri = $_SERVER["REQUEST_URI"];
MiddleWareManager::launch('onRequest');
new Router();