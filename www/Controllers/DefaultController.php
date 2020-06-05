<?php
namespace HotelFactory\Controllers;

use HotelFactory\Core\View;

class DefaultController
{
    public function defaultAction()
    {
        $firstname = "Julien";

        // View dashboard sur le template back
        $myView = new View("dashboard");
        $myView->assign('firstname', $firstname);
    }
}