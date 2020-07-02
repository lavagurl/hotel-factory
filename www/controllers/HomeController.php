<?php

namespace HotelFactory\controllers;
use HotelFactory\core\View;

class HomeController
{
    public function defaultAction()
    {
        $myView = new View("home", "front");
    }
}
