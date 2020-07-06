<?php

namespace HotelFactory\controllers;
use HotelFactory\Core\Controller;
use HotelFactory\core\QueryBuilder;
use HotelFactory\core\tools;
use HotelFactory\forms\LoginForm;
use HotelFactory\forms\RegisterForm;
use HotelFactory\mails\ConfirmAccountMail;
use HotelFactory\mails\Mail;
use HotelFactory\managers\UserManager;
use HotelFactory\core\Validator;
use HotelFactory\models\User;
use HotelFactory\core\Helper;
use HotelFactory\core\View;

class UserController extends Controller
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
                $userArray = array_merge($_POST,array("token"=>Tools::generateToken()));
                $user = new User();
                $user = $user->hydrate($userArray);
                $userManager = new UserManager();
                $userManager->save($user);
                $url = "http://localhost/confirmation?key=".urlencode($user->getEmail())."&token=".urlencode($user->getToken());
                $configMail = ConfirmAccountMail::getMail($user->getEmail(), $user->getFirstname(),$url);
                new Mail($configMail);
                $_SESSION["newUser"] = 1;
                $this->redirectTo("User","registerConfirm");
            }
            else
            {
                print_r($errors);
            }
        }
    }
    public function registerConfirmAction()
    {
        if(!empty($_GET['key']) && !empty($_GET['token']))
        {
            $requete = new QueryBuilder(User::class, 'user');
            $requete->querySelect(["id","idHfRole"]);
            $requete->queryWhere("email", "=", htmlspecialchars(urldecode($_GET['key'])));
            $requete->queryWhere("token", "=", htmlspecialchars(urldecode($_GET['token'])));
            $result = $requete->queryGget();
            if (!empty($result))
            {
                if ($result["idHfRole"] == 4)
                {
                    $user = new User();
                    $user->setId($result["id"]);
                    $user->setIdHfRole(2);
                    $userManager = new UserManager();
                    $userManager->save($user);
                    new View("registerConfirmMail", "front");
                }
                else
                    die("votre compte est deja validé");
            }
            else
                die("le lien n'est pas bon");
        }
        else
        {
            if (!empty($_SESSION["newUser"]) && $_SESSION["newUser"] == 1)
            {
                new View("registerConfirm", "front");
                unset($_SESSION["newUser"]);
            }
            else
            {
                $this->redirectTo(  "Errors","quatreCentQuatre");
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
                $_POST['password'] = sha1($_POST['password']);
                $userManager = new UserManager();
                $user = $userManager->findBy($_POST);
                if (count($user) == 1) {
                    $_SESSION['id'] = $user[0]->getId();
                    $_SESSION['role'] = $user[0]->getIdHfRole();
                    echo ($_SESSION['role']);
                    if ($_SESSION['role'] == 1)
                        $this->redirectTo('DashboardAdmin', 'default');
                    elseif ($_SESSION['role'] == 2)
                        $this->redirectTo('DashboardUser', 'default');
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
