<?php

namespace HotelFactory\controllers;
use HotelFactory\core\builders\QueryBuilder;
use HotelFactory\core\Controller;
use HotelFactory\core\tools\Token;
use HotelFactory\forms\forgotpasswordForm;
use HotelFactory\forms\LoginForm;
use HotelFactory\forms\NewpasswordForm;
use HotelFactory\forms\RegisterForm;
use HotelFactory\forms\SuccessMessage;
use HotelFactory\mails\ConfirmAccountMail;
use HotelFactory\mails\ForgotPasswordMail;
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
                //enregistrement du nouvel utilisateur
                $userArray = array_merge($_POST,array("token"=> Token::getToken()));
                $user = new User();
                $user = $user->hydrate($userArray);
                $userManager = new UserManager();
                $userManager->save($user);

                //préparation et envoie du mail de confirmation
                $url = URL_HOST.Helper::getUrl("User","registerConfirm")."?key=".urlencode($user->getEmail())."&token=".urlencode($user->getToken());
                $configMail = ConfirmAccountMail::getMail($user->getEmail(), $user->getFirstname(),$url);
                $mail = new Mail();
                $mail->sendMail($configMail);

                //en attente de validation du mail
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
            //acces a la page avec des paramètres
            //recherche en db d'un utilisateur correspondant à la key(email) et au token
            $requete = new QueryBuilder(User::class, 'user');
            $requete->querySelect(["id","idHfRole"]);
            $requete->queryWhere("email", "=", htmlspecialchars(urldecode($_GET['key'])));
            $requete->queryWhere("token", "=", htmlspecialchars(urldecode($_GET['token'])));
            $result = $requete->queryGget();
            if (!empty($result))
            {
                if ($result["idHfRole"] == 4)
                {
                    //si un utilisateur est trouvé et que son role est 4, passe le role a 2 en même temps que la réinitialisation de son token
                    $userManager = new UserManager();
                    $userManager->manageUserToken($result["id"],0,["idHfRole"=>2]);
                    $successMessage = SuccessMessage::mailInscriptionSucess();
                    $view = new View("success", "front");
                    $view->assign("successMessage",$successMessage);
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
                //acces à la page sans parametres (juste apres l'inscription quand l'email n'est pas encore validé)
                //new View("registerConfirm", "front");
                $successMessage = SuccessMessage::InscriptionSucess();
                $view = new View("success", "front");
                $view->assign("successMessage",$successMessage);
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
                //cryptage du mot de passe pour qu'il corresponde à la db puis recherche de celui ci
                $_POST['password'] = sha1($_POST['password']);
                $userManager = new UserManager();
                $user = $userManager->findBy($_POST);
                if (count($user) == 1)
                {
                    //si un utilisateur est trouvé, sauvgarde de ses éléments de session et initialisation de son token en db
                    $_SESSION['id'] = $user[0]->getId();
                    $_SESSION['role'] = $user[0]->getIdHfRole();
                    $_SESSION['token'] = Token::getToken();
                    $userManager = new UserManager();
                    $userManager->manageUserToken($_SESSION['id'],$_SESSION['token']);
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
        //réinitialisation du token et destruction de la session
        $userManager = new UserManager();
        $userManager->manageUserToken($_SESSION['id'],0);
        session_destroy();
        $this->redirectTo("Home","default");
    }

    public function forgotPasswordAction()
    {
        $configFormUser = ForgotpasswordForm::getForm();
        $myView = new View("user/forgotPassword", "front");
        $myView->assign("configFormUser", $configFormUser);

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors))
            {
                $requete = new QueryBuilder(User::class, 'user');
                $requete->querySelect(["id"]);
                $requete->queryWhere("email", "=", $_POST['email']);
                $result = $requete->queryGget();
                if (!empty($result))
                {
                    $token = Token::getToken();
                    $userManager = new UserManager();
                    $userManager->manageUserToken($result["id"],$token);
                    $url = URL_HOST.Helper::getUrl("User","newPassword")."?id=".urlencode($result["id"])."&token=".urlencode($token);
                    $configMail = ForgotPasswordMail::getMail($_POST['email'],$url);
                    $mail = new Mail();
                    $mail->sendMail($configMail);
                }
            }
            else
                print_r($errors);
        }
    }
    public function newPasswordAction()
    {
        $configFormUser = NewPasswordForm::getForm();
        if(!empty($_GET['id']) && !empty($_GET['token']))
        {
            $requete = new QueryBuilder(User::class, 'user');
            $requete->querySelect(["id"]);
            $requete->queryWhere("id", "=", htmlspecialchars(urldecode($_GET['id'])));
            $requete->queryWhere("token", "=", htmlspecialchars(urldecode($_GET['token'])));
            $result = $requete->queryGget();
            if (!empty($result))
            {
                $myView = new View("user/newPassword", "front");
                $myView->assign("configFormUser", $configFormUser);
                $userManager = new UserManager();
                $userManager->manageUserToken($result["id"],0);
                $_SESSION["idPassword"] = $result["id"];
            }
            else
                die("le lien n'est pas valide");
        }
        else
        {
            if(empty($_SESSION["idPassword"]))
                die("erreurs");
        }

        if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["idPassword"]))
        {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors))
            {
                $user = new User();
                $user->setPassword($_POST["password"]);
                $user->setId($_SESSION["idPassword"]);
                $userManager = new UserManager();
                $userManager->save($user);
                unset($_SESSION["idPassword"]);
                $successMessage = SuccessMessage::newPasswordSucess();
                $view = new View("success", "front");
                $view->assign("successMessage",$successMessage);
            }
            else
            {
                print_r($errors);
                $myView = new View("user/newPassword", "front");
                $myView->assign("configFormUser", $configFormUser);
            }
        }
    }

    public function deleteAction()
    {
        //la supression du compte d'un utilisateur désactive le compte et le déconnecte
        if(!empty($_SESSION["id"]))
        {
            $userManager = new UserManager();
            $userManager->manageUserToken($_SESSION['id'],0,["idHfRole"=>4]);
            session_destroy();
            $this->redirectTo("Home","default");
        }
        //la suppresion de compte par un admin permet de supprimer le compte en db
        if(!empty($_SESSION["role"]) && !empty($_GET["idDelete"]) && $_SESSION['role'] == 1)
        {
            $userManager = new UserManager();
            $userManager->delete($_GET["idDelete"]);
        }
    }
}
