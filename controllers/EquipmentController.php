<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\forms\AddEquipmentsForm;
use HotelFactory\core\View;
use HotelFactory\managers\EquipmentManager;
use HotelFactory\models\Equipment;

class EquipmentController extends Controller
{


    /* Afficher les Equipmentaires */
    public function listAction(){
        $equipmentManager = new EquipmentManager();
        $equipment = $equipmentManager->findAll();
        $configTableEquipments = Equipment::showEquipmentTable($equipment);
        $myView = new View("{$_SESSION['dir']}dashboard/Equipments", "back");
        $myView->assign("configTableEquipments", $configTableEquipments);

    }

    public function formEquipmentAction(){
        $configFormEquipments = AddEquipmentsForm::getForm();
        $myView = new View("{$_SESSION['dir']}dashboard/settings", "back");
        $myView->assign("configFormEquipments", $configFormEquipments);
    }

    /* Mettre à jour un Equipmentaire */
    public function updateAction()
    {
        $equipmentManager = new EquipmentManager();
        $equipment = $equipmentManager->find($_POST['id']);
        $equipment = $equipment->hydrate($_POST);
        $equipmentManager->save($equipment);
        header("Location: /dashboard/Equipments");
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $equipment = new Equipment();
            $equipment = $equipment->hydrate($_POST);
            $equipmentManager = new EquipmentManager();
            $equipmentManager->save($equipment);

        }
        header("Location: /settings/parametres");
    }


}