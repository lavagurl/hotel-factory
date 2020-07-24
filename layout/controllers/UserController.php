<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\core\Helper;
use HOTEL\core\Tools;
use HOTEL\forms\LoginForm;
use HOTEL\forms\RegisterForm;
use HOTEL\mails\ConfirmAccountMail;
use HOTEL\mails\Mail;
use HOTEL\managers\UserManager;
use HOTEL\core\Validator;
use HOTEL\models\User;
use HOTEL\core\View;


class UserController extends Controller
{
    public function defaultAction()
    {
        $myView = new View("{$_SESSION['dir']}dashboard/home", "back");

    }

    public function indexAction()
    {
        $id = ["id"=>$_SESSION['id']];
        $userManager = new UserManager();
        $user = $userManager->findBy($id);
        $configFromUser = User::showUserTable($user);
        $myView = new View("profile", "back");
        $myView->assign("configFromUser", $configFromUser);

    }


    public function listAction(){
        $userManager = new UserManager();
        $users = $userManager->findAll();
        $configTableUser = User::showUserTable($users);

        $myView = new View("admin/dashboard/permissions", "back");
        $myView->assign("configTableUser", $configTableUser);
    }

    public function updateAction()
    {
        $userManager = new UserManager();
        $user = $userManager->find($_SESSION['id']);
        if(isset($_POST['role'])):
            $_POST['idHfRole'] = $_POST['role'];
            $route = "/dashboard/permissions";
            else:
            $route = "/profile";
        endif;
        $user = $user->hydrate($_POST);
        $userManager->save($user);

        header("Location: ".$route);
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
                $userArray = array_merge($_POST,array("token"=>Tools::generateToken()));
                $user = new User();
                $user = $user->hydrate($userArray);
                $userManager = new UserManager();
                $userManager->save($user);
                $url = "http://localhost/confirmation?key='".urlencode($user->getId())."'&token='".urlencode(sha1($user->getToken()))."'";
                $configMail = ConfirmAccountMail::getMail($user->getEmail(), $user->getFirstname(),$url);
                new Mail($configMail);
                Helper::redirectTo("User","registerConfirm");
            }
            else
            {
                print_r($errors);
            }
        }
    }
    public function registerConfirmAction()
    {
        $myView = new View("registerConfirm", "front");
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
                    if ($_SESSION['role'] == 1 ||$_SESSION['role'] == 3) {
                        $_SESSION['dir'] = "admin/";
                    }elseif($_SESSION['role'] == 2){
                        $_SESSION['dir'] = "user/";
                    }
                    Helper::redirectTo('User', 'default');
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