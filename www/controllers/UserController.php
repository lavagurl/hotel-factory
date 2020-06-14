<?php

namespace HotelFactory\Controllers;
use HotelFactory\Models\User;
use HotelFactory\Core\Helper;
use HotelFactory\Core\View;

class UserController
{

    public function indexAction()
    {
      $user = new User();

    }


    public function defaultAction()
    {
    }

    public function registerAction()
    {
        $configFormUser = User::getRegisterForm();
        $myView = new View("register", "front");
        $myView->assign("configFormUser", $configFormUser);
    }

    public function loginAction()
    {
        $_SESSION['status'] = "1";
        $myView = new View("login", "front");
    }

    public function logCheckAction(){
      //header('Location: /dashboard?email='.$_POST['email']);
      if($_POST['email'] == "quintasmarie@gmail.com"){
        $_SESSION["role"] = '1';
        header('Location: /dashboard');
      }else{
        $_SESSION["role"] = '2';
        header('Location: /settings');
      }
    }

    public function logoutAction()
    {
        session_destroy();
        header('Location: /home');
    }

    public function saveAction($params){
      $infoUser = $params['POST'];
      $user = new User();

      $errors = Validator::checkForm($infoContact);

      if(count($errors) > 0){
        $user->setEmail($infoUser['email']);
        $user->setPassword($infoUser['password']);
        $user->setName($infoUser['name']);
        $user->setFirstname($infoUser['firstname']);
        $user->setBirthdate($infoUser['birthdate']);
        $user->setCreationDate($infoUser['creation_date']);

        $config = $user->getRegisterForm();
        $myView = new View("/se-connecter", "front");
        $myView->assign('config', $config);
      }
    }


}
