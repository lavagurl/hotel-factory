<?php

namespace HotelFactory\Controllers;
use HotelFactory\Core\Helper;
use HotelFactory\Core\View;

class DashboardUserController
{

  public function defaultAction()
  {
    Helper::checkRole(2);
    $myView = new View("user/dashboard/home", "back");

  }

  public function userPagesAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/pages", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }

  }

  public function userDesignAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/design", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }
  }

  public function userSettingsAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/settings", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }

  }

}

 ?>
