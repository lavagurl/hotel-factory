<?php

namespace HotelFactory\controllers;
use HotelFactory\forms\LoginForm;
use HotelFactory\forms\RegisterForm;
use HotelFactory\managers\UserManager;
use HotelFactory\core\Validator;
use HotelFactory\models\User;
use HotelFactory\core\Helper;
use HotelFactory\core\View;

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
                Helper::redirectTo("User","login");
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors)) {
                $_POST['password'] = md5($_POST['password']);
                $userManager = new UserManager();
                $user = $userManager->findBy($_POST);
                if (count($user) == 1) {
                    $_SESSION['id'] = $user[0]->getId();
                    $_SESSION['role'] = $user[0]->getIdHfRole();
                    echo ($_SESSION['role']);
                    if ($_SESSION['role'] == 1)
                        Helper::redirectTo('DashboardAdmin', 'default');
                    elseif ($_SESSION['role'] == 2)
                         Helper::redirectTo('DashboardUser', 'default');
                } else
                    echo("identifiant ou mot de passe incorrect");
            }
            else
                echo("identifiant ou mot de passe incorrect");
        }
    }

    public function logoutAction()
    {
        session_destroy();
        header('Location: /home');
    }
}
