<?php

namespace HotelFactory\controllers;
use HotelFactory\core\Controller;
use HotelFactory\core\QueryBuilder;
use HotelFactory\forms\CreateHotelForm;
use HotelFactory\forms\EditHotelForm;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\View;
use HotelFactory\core\Validator;
use HotelFactory\managers\PageManager;
use HotelFactory\managers\UserManager;
use HotelFactory\models\Hotel;
use HotelFactory\models\Page;
use HotelFactory\models\User;

class HotelController extends Controller
{

    public function createAction()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST" )
        {
            $validator = new Validator();
            $name = $validator->uniq($_POST['name'],array("table"=>"hotel","column"=>"name"));
            if($name == true ){
                $hotel = new Hotel();
                $hotel = $hotel->hydrate($_POST);
                $hotelManager = new HotelManager();
                $hotelManager->save($hotel);
            }
        }
        header("Location: /settings/create_hotel");
    }

    public function createHotelAction()
    {
        
        $hotelManager = new HotelManager();
        $hotel = $hotelManager->findBy(array("idUser"=>$_SESSION['id']));
        $configFormHotel = CreateHotelForm::getForm();
        $myView = new View("{$_SESSION['dir']}/hotel/create", "back");
        $myView->assign("configFormHotel", $configFormHotel);

        if($hotel != NULL){
            if($hotel[0]->getValid() == 1){
                if($hotel[0]->getStatus() == 1){
                    $valid = true;
                    $myView->assign("valid", $valid);
                }
            }else{
                $errors[] = "Hotel pas encore validé";
                $_SESSION['errors_form'] = $errors;
            }
        }else {
            $errors[] = "Vous n'avez pas créé d'hotel";
            $_SESSION['errors_form'] = $errors;
        }

        if(empty($_SESSION['hotel']) && empty($hotel)){
            $bool = true;
            $myView->assign("bool", $bool);
        }else{
            $errors[] = "Vous n'avez pas créé d'hotel";
            $_SESSION['errors_form'] = $errors;
        }

    }

    public function listAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->findAll();
        $configTableHotel = Hotel::showHotelTable($hotels);
        $myView = new View("admin/hotel/list", "back");
        $myView->assign("configTableHotel", $configTableHotel);
    }

    public function showAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->find($_GET['id']);
        $configDetailsHotel = Hotel::showDetailsHotel($hotels);
        $myView = new View("admin/hotel/show", "back");
        $myView->assign("configDetailsHotel", $configDetailsHotel);
    }

    public function updateAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $hotelManager = new HotelManager();
            $hotel = $hotelManager->find($_POST['id']);

            $routeFinal = trim($_POST['route']);
            $routeFinal = preg_replace('#&#', '', $routeFinal);
            $routeFinal = strtolower(htmlentities( $routeFinal, ENT_NOQUOTES, 'utf-8'));
            $routeFinal = preg_replace('#&([a-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|&amp|uml|);#', '\1', $routeFinal);
            $routeFinal = preg_replace('#[0-9]#','', $routeFinal); 
            $routeFinal = preg_replace('#[^a-z]+#i', '', $routeFinal);
            $_POST['route'] = $routeFinal;

            $validator = new Validator();
            $route = $validator->uniq($routeFinal,array("table"=>"hotel","column"=>"route"));
            
            if($route == true){
                $userManager = new UserManager();
                $user = $userManager->find($hotel->getIdUser());
                $tab = array();
                $tab['id'] = $user->getId();
                $tab['idHfCompany'] = $hotel->getId();
                $user = $user->hydrate($tab);
                $userManager->save($user);

                $hotel = $hotel->hydrate($_POST);
                $hotelManager->save($hotel);

                $src = "../../layout";
                $dest = "../../".$routeFinal;

                $this->generateClientAction($src, $dest, $_POST['id']);

            }else{
                echo "Erreur : cette route existe déjà";
               

            }
            header("Location: /dashboard/hotels");


        }

        

    }

    public function editFormAction(){
        $hotelManager = new HotelManager();
        $hotel = $hotelManager->find($_SESSION['hotel']);
        $configFormHotel = EditHotelForm::getForm();
        $myView = new View("{$_SESSION['dir']}/hotel/edit", "back");
        $myView->assign("configFormHotel", $configFormHotel);
    }


    /* Mettre à jour un Service */
    public function editAction()
    {
        $hotelManager = new HotelManager();
        $hotel = $hotelManager->find($_POST['id']);
        $hotel = $hotel->hydrate($_POST);
        $hotelManager->save($hotel);
        header("Location: /settings/update_hotel");
    }

    public function generateClientAction($source, $destination, $id){
        $cmd ="cp -rn ".$source." ".$destination." | chmod -R 777 ".$destination;
        shell_exec($cmd);

        $tab = [
            "0" => [
                "title" => "Les chambres",
                "address" => "/room/list",
                "content" => "<h1>Les chambres</h1>",
                "idHotel" => $id
            ],
            "1" => [
                "title" => "Les services",
                "address" => "/service/list",
                "content" => "<h1>Les services</h1> ",
                "idHotel" => $id
            ],
            "2" => [
                "title" => "Home",
                "address" => "/home",
                "content" => "<h1>Accueil </h1> ",
                "idHotel" => $id
            ],
            "3" => [
                "title" => "Les commentaires",
                "address" => "/comment/list",
                "content" => "<h1>Les commentaires</h1> ",
                "idHotel" => $id
            ],
            "4" => [
                "title" => "Contact",
                "address" => "/home/contact",
                "content" => "<h1>Contact </h1></br> <ul><li>N° : 0687093345</li><li>Mail : monjolimail@gmail.com</li></ul>",
                "idHotel" => $id
            ]
        ];

        $objects = array();
        foreach ($tab as $object) {
            if(!empty($object['content'])){
                json_encode($object['content']);
            }
            $page = new Page();
            $page = $page->hydrate($object);
            $pageManager = new PageManager();
            $pageManager->save($page);
            array_push($objects, $object);
        }

    }

    public function deleteAction()
    {
        $hotelManager = new HotelManager();
        $hotel = $hotelManager->find($_SESSION['hotel']);

        $userManager = new UserManager();
        $users = $userManager->findBy(array("idHfCompany"=>$_SESSION['hotel'], "idHfRole"=>3));
        
        if($users != NULL){
            foreach($users as $user){
                $user = $userManager->delete($user->getId());
            }
        }else{
            echo "Pas de modérateur";
        }

        $folder = $hotel->getRoute();
        $cmd ="mv ../../".$folder." ../../archives/".$folder;
        shell_exec($cmd);
        

        $hotel = $hotelManager->delete($_SESSION['hotel']);
        $user = $userManager->find($_SESSION['id']);
        
        $user->setIdHfCompany(NULL);
        $user->setPassword(NULL);
        $userManager->save($user);
        
        unset($_SESSION['hotel']);

        header("Location: /se-deconnecter");

    }


}