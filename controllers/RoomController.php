<?php

namespace HotelFactory\controllers;

use HotelFactory\forms\EditRoomsForm;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\Controller;
use HotelFactory\forms\AddRoomForm;
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
        $myView = new View("{$_SESSION['dir']}/room/list", "back");
        $myView->assign("configTableRooms", $configTableRooms);

    }

    public function formRoomAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->findBy(array("idUser"=>$_SESSION['id']));
        $configFormRooms = AddRoomForm::getForm();
        $myView = new View("{$_SESSION['dir']}/room/create", "back");
        array_push($configFormRooms, array("idHotel"=>$hotels[0]->getId()));
        $myView->assign("configFormRooms", $configFormRooms);
        //$myView->assign("id",$hotels[0]->getId());
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {

            if(isset($_POST['idHotel'])):
                $_POST['idHotel'] = $_SESSION['hotel'];
            endif;
            $qte = $_POST["quantity"];
            $i=0;
            while ( $i<$qte ) {
                $room = new Room();
                $room = $room->hydrate($_POST);
                print_r($room);
                $roomManager = new RoomManager();
                $roomManager->save($room);
                $i=$i+1;
            }
        }
        header("Location: /settings/room/list");
    }

    /* Mettre à jour un Roomaire */
    public function updateAction()
    {
        $roomManager = new RoomManager();
        $room = $roomManager->find($_POST['id']);
        $room = $room->hydrate($_POST);
        $roomManager->save($room);
        header("Location: /dashboard/rooms");
    }


    public function editFormAction(){
        $roomManager = new RoomManager();
        $room = $roomManager->findBy(array("idUser"=>$_SESSION['id']));
        $configFormRooms = EditRoomsForm::getForm();
        $myView = new View("{$_SESSION['dir']}/room/edit", "back");
        $myView->assign("configFormRoom", $configFormRooms);
    }


    /* Mettre à jour un Service */
    public function editAction()
    {
        $roomManager = new RoomManager();
        $room = $roomManager->find($_POST['id']);
        $room = $room->hydrate($_POST);
        $roomManager->save($room);
        header("Location: /settings/room/list");
    }


    public function deleteAction()
    {
        $roomManager = new RoomManager();
        $roomManager->delete($_GET['id']);
        header("Location: /settings/room/list");
    }

}