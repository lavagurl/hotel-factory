<?php

namespace HotelFactory\controllers;
use HotelFactory\core\Controller;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\View;
use HotelFactory\models\Hotel;

class HotelController extends Controller
{

    public function createAction()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST" )
        {
            $hotel = new Hotel();
            $hotel = $hotel->hydrate($_POST);
            $hotelManager = new HotelManager();
            $hotelManager->save($hotel);
        }
        header("Location: /create_hotel");
    }

    public function listAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->findAll();
        $configTableHotel = Hotel::showHotelTable($hotels);
        $myView = new View("admin/dashboard/hotels", "back");
        $myView->assign("configTableHotel", $configTableHotel);
    }

    public function showAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->find($_GET['id']);
        $configDetailsHotel = Hotel::showDetailsHotel($hotels);
        $myView = new View("admin/dashboard/details_hotel", "back");
        $myView->assign("configDetailsHotel", $configDetailsHotel);
    }

    public function validationHotelAction($route){
        $controllers = ["User", "Room", "Equipment", "Service"];
        $actions = ["default", "index", "list", "create", "update", "edit", "show", "destroy"];

        $file = fopen("routes.yml", "a+");
        if(file_exists("routes.yml")){
            if(1==1){
                fwrite($file,"/:"."\n"."  controller: Home"."\n"."  action: home"."\n\n");
                fwrite($file, "/home:"."\n"."  controller: Home"."\n"."  action: home"."\n\n");
                foreach ($controllers as $controller){
                    foreach ($actions as $action){
                        $charRoute = "/".strtolower($controller)."/".$action.":";
                        $charController = "  controller: ".$controller;
                        $charAction = "  action: ".$action;
                        $line = $charRoute."\n".$charController."\n".$charAction."\n\n";
                        fwrite($file, $line);
                    }

                }
                fclose($file);
                return true;
                echo "ça marche";
            } else {
                echo "on ne peut pas écrire dans le fichier";
            }
        }else {
            echo "le fichier n'existe pas";
        }

        //return false;

    }

    public function updateAction()
    {
        print_r($_POST);

        if(isset($_POST) && !(empty($_POST)))
        {
            $hotelManager = new HotelManager();
            $hotel = $hotelManager->find($_POST['id']);
            $hotel = $hotel->hydrate($_POST);
            $hotelManager->save($hotel);
            $this->validationHotelAction($_POST['route']);
        }
        //header("Location: /dashboard/hotels");

    }


}