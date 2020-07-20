<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\core\View;
use HOTEL\managers\HotelManager;
use HOTEL\managers\PageManager;
use HOTEL\models\Page;

class HomeController extends Controller
{
    public function defaultAction()
    {
        $pageManager = new PageManager();
        $pageManager = $pageManager->findBy(array("idHotel"=>$_SESSION['hotel'], "address" => $_SERVER['REQUEST_URI']));
        $myView = new View("home", "front");
        $myView->assign("page", $pageManager);
    }

    public function contactAction()
    {
        $pageManager = new PageManager();
        $pageManager = $pageManager->findBy(array("idHotel"=>$_SESSION['hotel'], "address" => $_SERVER['REQUEST_URI']));
        $myView = new View("contact", "front");
        $myView->assign("page", $pageManager);
    }
}
