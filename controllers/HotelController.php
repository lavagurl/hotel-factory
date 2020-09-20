<?php

namespace HotelFactory\controllers;
use HotelFactory\core\Controller;
use HotelFactory\core\QueryBuilder;
use HotelFactory\forms\CreateHotelForm;
use HotelFactory\forms\EditHotelForm;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\View;
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
            $hotel = new Hotel();
            $hotel = $hotel->hydrate($_POST);
            $hotelManager = new HotelManager();
            $hotelManager->save($hotel);
        }
        header("Location: /settings/create_hotel");
    }

    public function createHotelAction()
    {
        if($_SESSION['role'] == "2"){
            $hotelManager = new HotelManager();
            $hotel = $hotelManager->findBy(array("idUser"=>$_SESSION['id']));
            //var_dump($hotel);
            $configFormHotel = CreateHotelForm::getForm();
            $myView = new View("{$_SESSION['dir']}/hotel/create", "back");
            $myView->assign("configFormHotel", $configFormHotel);

            $tab = [
                "fields" => [
                    "idHotel" => $hotel[0]->getId()
                ]
            ];

            if(isset($hotel)):
                array_push($configFormHotel, $tab);
            endif;

        }else{
            header('Location: /vous-etes-perdu');
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
            $dest = "../../".$_POST['route'];

            $this->generateClientAction($src, $dest, $_POST['id']);


        }

        header("Location: /dashboard/hotels");

    }

    /*public function editAction(){
        if($_SESSION['role'] == "2"){
            $hotelManager = new HotelManager();
            $hotel = $hotelManager->findBy(array("idUser"=>$_SESSION['id']));
            $configFormHotel = CreateHotelForm::getForm();
            $myView = new View("{$_SESSION['dir']}/hotel/edit", "back");
            $myView->assign("configFormHotel", $configFormHotel);

            $tab = [
                "fields" => [
                    "idHotel" => $hotel[0]->getId()
                ]
            ];

            if(isset($hotel)):
                array_push($configFormHotel, $tab);
            endif;

        }else{
            header('Location: /vous-etes-perdu');
        }
    }*/

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
                "title" => "La chambre",
                "address" => "/room/show",
                "content" => "<h1>La chambre</h1>",
                "idHotel" => $id
            ],
            "2" => [
                "title" => "Les services",
                "address" => "/service/list",
                "content" => "<h1>Les services</h1> ",
                "idHotel" => $id
            ],
            "3" => [
                "title" => "Home",
                "address" => "/home",
                "content" => "<h1>Accueil </h1> ",
                "idHotel" => $id
            ],
            "4" => [
                "title" => "Les commentaires",
                "address" => "/comment/list",
                "content" => "<h1>Les commentaires</h1> ",
                "idHotel" => $id
            ],
            "5" => [
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

        //print_r($objects);



    }


}