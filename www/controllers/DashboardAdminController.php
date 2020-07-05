<?php

namespace HotelFactory\controllers;
use HotelFactory\Core\Controller;
use HotelFactory\models\User;
use HotelFactory\core\View;
use HotelFactory\managers\UserManager;

class DashboardAdminController extends Controller
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
        $myView = new View("admin/dashboard/permissions", "back");
          $query = new UserManager();
          $query->findAll();
          print_r($query);
          $datas = array();
          foreach($query as $data){
            $user = new User();
            $user = $user->hydrate($data);
            $datas=array_push($user);
          }
          print_r($datas);
          $myView->assign("datas", $datas);
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
