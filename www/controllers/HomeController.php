<?php

namespace HotelFactory\controllers;
use HotelFactory\Core\Controller;
use HotelFactory\core\View;
use HotelFactory\mails\ConfirmAccountMail;
use HotelFactory\mails\mail;

class HomeController extends Controller
{
    public function defaultAction()
    {
        $myView = new View("home", "front");
//        $url = "token";
//        $configMail = ConfirmAccountMail::getMail("hotelfactorytest@gmail.com", "toto",$url);
//        new mail($configMail);
    }
}
