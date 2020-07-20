<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\forms\AddRoomsForm;
use HOTEL\managers\HotelManager;
use HOTEL\managers\RoomManager;
use HOTEL\models\Hotel;
use HOTEL\models\Room;
use HOTEL\core\View;
use HOTEL\managers\PageManager;
use HOTEL\models\Page;

class RoomController extends Controller
{


    /* Afficher les Roomaires */
    public function listAction()
    {
        $pageManager = new PageManager();
        $pageManager = $pageManager->findBy(array("idHotel"=>$_SESSION['hotel'], "address" => $_SERVER['REQUEST_URI']));
        $roomManager = new RoomManager();
        $rooms = $roomManager->findBy(array("idHotel"=> $_SESSION['hotel']));
        $configTableRooms = Room::showRoomTable($rooms);
        $myView = new View("/room/list", "front");
        $myView->assign("config", $configTableRooms);
        $myView->assign("page", $pageManager);

    }

    public function formRoomAction(){
        $configFormRooms = AddRoomsForm::getForm();
        $myView = new View("{$_SESSION['dir']}dashboard/settings", "back");
        $myView->assign("configFormRooms", $configFormRooms);
    }

    /* Mettre à jour un Roomaire */
    public function updateAction()
    {
        $roomManager = new RoomManager();
        $room = $roomManager->find($_POST['id']);
        $room = $room->hydrate($_POST);
        $roomManager->save($room);
        header("Location: /dashboard/Rooms");
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $room = new Room();
            $room = $room->hydrate($_POST);
            $roomManager = new RoomManager();
            $roomManager->save($room);

        }
        header("Location: /settings/parametres");
    }


}