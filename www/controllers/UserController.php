<?php

namespace HotelFactory\Controllers;
use HotelFactory\Forms\LoginForm;
use HotelFactory\Forms\RegisterForm;
use HotelFactory\Managers\UserManager;
use HotelFactory\Core\Validator;
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

        $configFormUser = RegisterForm::getForm();
        $myView = new View("register", "front");
        $myView->assign("configFormUser", $configFormUser);
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser ,$_POST);
            if(empty($errors))
            {
                $user = new User();
                $user = $user->hydrate($_POST);
                $userManager = new UserManager();
                $userManager->save($user);
                header('Location: /se-connecter');
            }
            else
            {
                print_r($errors);
            }
        }
    }

    public function loginAction()
    {
        $configFormUser = LoginForm::getForm();
        $myView = new View("login", "front");
        $myView->assign("configFormUser", $configFormUser);
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $_POST['password'] = md5($_POST['password']);
            $userManager = new UserManager();
            $user = $userManager->findBy($_POST);
            if(!empty($user))
            {

            }
        }
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

      $errors = Validator::checkForm($infoUser);

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
