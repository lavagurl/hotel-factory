<?php

namespace HOTEL\controllers;
use HOTEL\core\Controller;
use HOTEL\managers\HotelManager;
use HOTEL\core\View;
use HOTEL\models\Hotel;

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