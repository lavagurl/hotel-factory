<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
use HotelFactory\core\ConstantLoader;
use HotelFactory\core\MiddleWareManager;
use HotelFactory\core\Router;

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

/*if(!(isset($_SESSION)) || empty($_SESSION['token'])){
    Helper::getUrl("Home", "default");
}*/


$uri = $_SERVER["REQUEST_URI"];
MiddleWareManager::launch('onRequest');
new Router();