<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\forms\AddCommentsForm;
use HOTEL\managers\PageManager;
use HOTEL\core\View;

class ServiceController extends Controller
{


    /* Afficher les commentaires */
    public function listAction(){

        $pageManager = new PageManager();
        $pageManager = $pageManager->findBy(array("idHotel"=>$_SESSION['hotel'], "address" => $_SERVER['REQUEST_URI']));
        $myView = new View("/service/list", "front");
        $myView->assign("page", $pageManager);
        //$myView->assign("config", $configTableComments);


    }


}