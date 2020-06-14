<?php

namespace HotelFactory\Controllers;
use HotelFactory\Core\View;

class HomeController
{
    public function defaultAction()
    {
        $myView = new View("home", "front");
    }
}
