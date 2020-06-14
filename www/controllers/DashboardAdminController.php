<?php

namespace HotelFactory\Controllers;
use HotelFactory\Models\User;
use HotelFactory\Core\View;

class DashboardAdminController
{
    public function defaultAction()
    {
      if($_SESSION['role'] == "1"){
        $myView = new View("admin/dashboard/home", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }

    }

    public function adminPagesAction()
    {
      if($_SESSION['role'] == "1"){
        $myView = new View("admin/dashboard/pages", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }

    }

    public function adminDesignAction()
    {
      if($_SESSION['role'] == "1"){
        $myView = new View("admin/dashboard/design", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }

    }

    public function adminCommentsAction()
    {
      if($_SESSION['role'] == "1"){
        $myView = new View("admin/dashboard/comments", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }

    }

    public function adminPermissionsAction()
    {
      if($_SESSION['role'] == "1"){
        $user = new User();
        $myView = new View("admin/dashboard/permissions", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }

    }

    public function adminSettingsAction()
    {
      if($_SESSION['role'] == "1"){
        $myView = new View("admin/dashboard/settings", "back");
      }else{
        header('Location : /vous-etes-perdu');
      }
    }

}
