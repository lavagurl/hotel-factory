<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\Helper;
use HotelFactory\core\QueryBuilder;
use HotelFactory\core\tools\Message;
use HotelFactory\core\tools\Token;
use HotelFactory\forms\ForgotpasswordForm;
use HotelFactory\forms\AddUserForm;
use HotelFactory\forms\LoginForm;
use HotelFactory\forms\NewPasswordForm;
use HotelFactory\forms\RegisterForm;
use HotelFactory\mails\ConfirmAccountMail;
use HotelFactory\mails\ForgotPasswordMail;
use HotelFactory\mails\Mail;
use HotelFactory\managers\UserManager;
use HotelFactory\core\Validator;
use HotelFactory\models\User;
use HotelFactory\core\View;
use HotelFactory\managers\HotelManager;


class UserController extends Controller
{
    public function defaultAction()
    {
        $date = new \DateTime("now");
        $newDate = $date->format('Y-m-d'); 
        $myView = new View("{$_SESSION['dir']}/home", "back");
        $hotelManager = new HotelManager();
        $hotelvalide = $hotelManager->findby(array("status"=>'1'));
        $hotelnonvalide = $hotelManager->findby(array('status'=>'0'));
        //$myView = new View("{$_SESSION['dir']}/user/home", "back");
        $myView->assign("hotelvalide",count($hotelvalide));
        $myView->assign('hotelnonvalide', count($hotelnonvalide));
        
        $request = new QueryBuilder(User::class,'user');
        $request->queryCount('id');
        $request->queryWhere('creationDate','<', $newDate);
        $result = $request->queryGget();
        $usernow = $result;

        $myView->assign('usernow', $usernow[0]);

        $newDate = $date->modify("-1 month");
        $newDate = $newDate->format('Y-m-d'); 

        $request1 = new QueryBuilder(User::class,'user');
        $request1->queryCount('id');
        $request1->queryWhere('creationDate','<', $newDate);
        $result1 = $request1->queryGget();
        $user1month = $result1;

        $myView->assign('user1month', $user1month[0]);

        
        $newDate = $date->modify("-2 months");
        $newDate = $newDate->format('Y-m-d'); 

        $request2 = new QueryBuilder(User::class,'user');
        $request2->queryCount('id');
        $request2->queryWhere('creationDate','<', $newDate);
        $result2 = $request2->queryGget();
        $user2month = $result2;

        $myView->assign('user2month', $user2month[0]);
        
    }

    public function indexAction()
    {
        $id = ["id" => $_SESSION['id']];
        $userManager = new UserManager();
        $user = $userManager->findBy($id);
        $configFromUser = User::showUserTable($user);
        $myView = new View("profile", "back");
        $myView->assign("configFromUser", $configFromUser);
    }

    public function createAction()
    {
        if (isset($_POST) && !(empty($_POST))) {
            /* var_dump($_POST);
            die(); */
            $validator = new Validator();
            $configFormUser = AddUserForm::getForm();
            $errors = $validator->checkForm($configFormUser, $_POST);
            $userArray = array_merge($_POST, array("token" => Token::getToken()));
            $user = new User();
            $user = $user->hydrate($userArray);
            $userManager = new UserManager();
            $userManager->save($user);
        }
        if ($_SESSION['hotel'] == 1) :
            $route = "/dashboard/permissions";
        else :
            $route = "/settings/permissions";
        endif;
        header("Location: " . $route);
    }


    public function listAction()
    {
        $userManager = new UserManager();
        $users = $userManager->findBy(array("idHfCompany" => $_SESSION['hotel']));
        $configTableUser = User::showUserTable($users);

        $myView = new View($_SESSION['dir'] . "user/list", "back");
        $myView->assign("configTableUser", $configTableUser);
    }

    public function updateAction()
    {
        $userManager = new UserManager();
        $user = $userManager->find($_SESSION['id']);

        if (isset($_POST['role'])) :
            $userToMod = array();
            $userToMod['id'] = explode('-',$_POST['role'])[0];
            $userToMod['role'] = explode('-',$_POST['role'])[1];
            $_POST['idHfRole'] = $userToMod['role'];
            $_POST['id']=$userToMod['id'];
            if ($_SESSION['hotel'] == 1) :
                $route = "/dashboard/permissions";
            else :
                $route = "/settings/permissions";
            endif;
        else :
            $route = "/profile";
        endif;
        $user = $user->hydrate($_POST);
        $userManager->save($user);

        header("Location: " . $route);
    }


    public function loginAction()
    {
        Helper::checkDisconnected();
        $configFormUser = LoginForm::getForm();
        $myView = new View("login", "front");
        $myView->assign("configFormUser", $configFormUser);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (isset($errors['email'])) unset($errors['email']);
            //print_r($errors);
            if (empty($errors)) {
                //cryptage du mot de passe pour qu'il corresponde à la db puis recherche de celui ci
                $_POST['password'] = sha1($_POST['password']);
                $userManager = new UserManager();
                $user = $userManager->findBy($_POST);
                if (count($user) == 1) {
                    if ($user[0]->getIdHfRole() != 4) {
                        //si un utilisateur est trouvé, sauvgarde de ses éléments de session et initialisation de son token en db
                        $_SESSION['id'] = $user[0]->getId();
                        $_SESSION['role'] = $user[0]->getIdHfRole();
                        $_SESSION['hotel'] = $user[0]->getIdHfCompany();
                        $_SESSION['token'] = Token::getToken();
                        $userManager = new UserManager();
                        $userManager->manageUserToken($_SESSION['id'], $_SESSION['token']);
                        if ($_SESSION['role'] == 1 || ($_SESSION['role'] == 3 && $_SESSION['hotel'] == 1)) {
                            $_SESSION['dir'] = "admin/";
                            header('Location: /dashboard');
                        } elseif ($_SESSION['role'] == 2 || ($_SESSION['role'] == 3 && $_SESSION['hotel'] != 1)) {
                            $_SESSION['dir'] = "user/";
                            $this->redirectTo('User', 'default');
                        }
                    } else
                        $errors[] = "Vous devez valider votre email avant de vous connecter !";
                } else
                    $errors[] = "identifiant ou mot de passe incorrect";
            }
            $_SESSION['errors_form'] = $errors;
        }
    }

    public function registerAction()
    {
        Helper::checkDisconnected();
        $configFormUser = RegisterForm::getForm();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors)) {
                //enregistrement du nouvel utilisateur
                $userArray = array_merge($_POST, array("token" => Token::getToken()));
                $user = new User();
                $user = $user->hydrate($userArray);
                $userManager = new UserManager();
                $userManager->save($user);

                //préparation et envoie du mail de confirmation
                //                $url = URL_HOST.Helper::getUrl("User","registerConfirm")."?key=".urlencode($user->getEmail())."&token=".urlencode($user->getToken());
                //                $configMail = ConfirmAccountMail::getMail($user->getEmail(), $user->getFirstname(),$url);
                //                $mail = new Mail();
                //                $mail->sendMail($configMail);
                $this->sendMailAccountConfirmation($user->getEmail(), $user->getToken(), $user->getFirstname());

                //en attente de validation du mail
                $_SESSION["newUser"] = 1;
                $this->redirectTo("User", "registerConfirm");
            } else {
                //print_r($errors);

                $_SESSION['errors_form'] = $errors;
            }
        }
        $myView = new View("register", "front");
        $myView->assign("configFormUser", $configFormUser);
    }

    private function sendMailAccountConfirmation($key, $value, $name)
    {
        $url = "https://hotel-factory.com" . Helper::getUrl("User", "registerConfirm") . "?key=" . urlencode($key) . "&token=" . urlencode($value);
        $configMail = ConfirmAccountMail::getMail($key, $name, $url);
        $mail = new Mail();
        $mail->sendMail($configMail);
    }
    public function registerConfirmAction()
    {
        Helper::checkDisconnected();
        if (!empty($_GET['key']) && !empty($_GET['token'])) {
            //acces a la page avec des paramètres
            //recherche en db d'un utilisateur correspondant à la key(email) et au token
            $requete = new QueryBuilder(User::class, 'user');
            $requete->querySelect(["id", "idHfRole"]);
            $requete->queryWhere("email", "=", htmlspecialchars(urldecode($_GET['key'])));
            $requete->queryWhere("token", "=", htmlspecialchars(urldecode($_GET['token'])));
            $result = $requete->queryGget();
            if (!empty($result)) {
                if ($result["idHfRole"] == 4) {
                    //si un utilisateur est trouvé et que son role est 4, passe le role a 2 en même temps que la réinitialisation de son token
                    $userManager = new UserManager();
                    $userManager->manageUserToken($result["id"], 0, ["idHfRole" => 2]);
                    $message = Message::mailInscriptionSucess();
                    $view = new View("message", "front");
                    $view->assign("message", $message);
                } else
                    die("votre compte est deja validé");
            } else
                die("le lien n'est pas bon");
        } else {
            if (!empty($_SESSION["newUser"]) && $_SESSION["newUser"] == 1) {
                //acces à la page sans parametres (juste apres l'inscription quand l'email n'est pas encore validé)
                //new View("registerConfirm", "front");
                $message = message::InscriptionSucess();
                $view = new View("message", "front");
                $view->assign("message", $message);
                unset($_SESSION["newUser"]);
            } else {
                $this->redirectTo("Errors", "quatreCentQuatre");
            }
        }
    }

    public function logoutAction()
    {
        //réinitialisation du token et destruction de la session
        $userManager = new UserManager();
        $userManager->manageUserToken($_SESSION['id'], 0);
        session_destroy();
        $this->redirectTo("Home", "default");
    }

    public function forgotPasswordAction()
    {
        Helper::checkDisconnected();
        $configFormUser = ForgotpasswordForm::getForm();
        $myView = new View("forgot_password", "front");
        $myView->assign("configFormUser", $configFormUser);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors)) {
                $requete = new QueryBuilder(User::class, 'user');
                $requete->querySelect(["id"]);
                $requete->queryWhere("email", "=", $_POST['email']);
                $result = $requete->queryGget();
                if (!empty($result)) {

                    $token = Token::getToken();
                    $userManager = new UserManager();
                    $userManager->manageUserToken($result["id"], $token);
                    $url = URL_HOST . Helper::getUrl("User", "newPassword") . "?id=" . urlencode($result["id"]) . "&token=" . urlencode($token);
                    $configMail = ForgotPasswordMail::getMail($_POST['email'], $url);
                    $mail = new Mail();
                    $mail->sendMail($configMail);
                }
            } else
                print_r($errors);
        }
    }
    public function newPasswordAction()
    {
        Helper::checkDisconnected();
        $configFormUser = NewPasswordForm::getForm();
        if (!empty($_GET['id']) && !empty($_GET['token'])) {
            $requete = new QueryBuilder(User::class, 'user');
            $requete->querySelect(["id"]);
            $requete->queryWhere("id", "=", htmlspecialchars(urldecode($_GET['id'])));
            $requete->queryWhere("token", "=", htmlspecialchars(urldecode($_GET['token'])));
            $result = $requete->queryGget();
            if (!empty($result)) {
                $myView = new View("new_password", "front");
                $myView->assign("configFormUser", $configFormUser);
                $userManager = new UserManager();
                $userManager->manageUserToken($result["id"], 0);
                $_SESSION["idPassword"] = $result["id"];
            } else {
                $message = Message::linkNoValid();
                $view = new View("message", "front");
                $view->assign("message", $message);
            }
        } else {
            if (empty($_SESSION["idPassword"]))
                die("erreurs");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["idPassword"])) {
            $validator = new Validator();
            $errors = $validator->checkForm($configFormUser, $_POST);
            if (empty($errors)) {
                $user = new User();
                $user->setPassword($_POST["password"]);
                $user->setId($_SESSION["idPassword"]);
                $userManager = new UserManager();
                $userManager->save($user);
                unset($_SESSION["idPassword"]);
                $message = message::newPasswordSucess();
                $view = new View("message", "front");
                $view->assign("message", $message);
            } else {
                print_r($errors);
                $myView = new View("newPassword", "front");
                $myView->assign("configFormUser", $configFormUser);
            }
        }
    }

    public function deleteAction()
    {
        //la supression du compte d'un utilisateur désactive le compte et le déconnecte
        if (!empty($_SESSION["id"])) {
            $userManager = new UserManager();
            $userManager->manageUserToken($_SESSION['id'], 0, ["idHfRole" => 4]);
            session_destroy();
            $this->redirectTo("Home", "default");
        }
        //la suppresion de compte par un admin permet de supprimer le compte en db
        if (!empty($_SESSION["role"]) && !empty($_GET["idDelete"]) && $_SESSION['role'] == 1) {
            $userManager = new UserManager();
            $userManager->delete($_GET["idDelete"]);
        }
    }

    public function formRegisterModeratorAction()
    {
        $configRegisterUserForm = AddUserForm::getForm();
        $myView = new View($_SESSION['dir'] . "user/create", "back");
        $myView->assign("configRegisterUserForm", $configRegisterUserForm);
    }
}
