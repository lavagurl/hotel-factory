<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\forms\AddRoomsForm;
use HotelFactory\managers\RoomManager;
use HotelFactory\models\Room;
use HotelFactory\core\View;

class RoomController extends Controller
{


    /* Afficher les Roomaires */
    public function listAction(){
        $roomManager = new RoomManager();
        $rooms = $roomManager->findAll();
        $configTableRooms = Room::showRoomTable($rooms);
        $myView = new View("{$_SESSION['dir']}dashboard/Rooms", "back");
        $myView->assign("configTableRooms", $configTableRooms);

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