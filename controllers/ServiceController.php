<?php

namespace HotelFactory\controllers;

use HotelFactory\forms\EditServicesForm;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\Controller;
use HotelFactory\forms\AddServiceForm;
use HotelFactory\managers\ServiceManager;
use HotelFactory\models\Service;
use HotelFactory\core\View;

class ServiceController extends Controller
{


    /* Afficher les Services */
    public function listAction(){
        $serviceManager = new ServiceManager();
        $services = $serviceManager->findAll();
        $configTableServices = Service::showServiceTable($services);
        $myView = new View("{$_SESSION['dir']}/service/list", "back");
        $myView->assign("configTableService", $configTableServices);

    }

    public function formServiceAction(){
        $hotelManager = new HotelManager();
        $hotels = $hotelManager->findBy(array("idUser"=>$_SESSION['id']));
        $configFormServices = AddServiceForm::getForm();
        $myView = new View("{$_SESSION['dir']}/service/create", "back");
        array_push($configFormServices, array("idHotel"=>$hotels[0]->getId()));
        $myView->assign("configFormService", $configFormServices);
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            if(isset($_POST['idHotel'])):
                $_POST['idHotel'] = $_SESSION['hotel'];
            endif;

            $service = new Service();
            $service = $service->hydrate($_POST);
            //print_r($service);
            $serviceManager = new ServiceManager();
            $serviceManager->save($service);
        }
        header("Location: /settings/service/list");
    }


    public function editFormAction(){
        $serviceManager = new ServiceManager();
       // $service = $serviceManager->findBy(array("idUser"=>$_SESSION['id']));
        $configFormServices = EditServicesForm::getForm();
        $myView = new View("{$_SESSION['dir']}/service/edit", "back");
        $myView->assign("configFormService", $configFormServices);
    }


    /* Mettre à jour un Service */
    public function editAction()
    {
        $serviceManager = new ServiceManager();
        $service = $serviceManager->find($_POST['id']);
        $service = $service->hydrate($_POST);
        $serviceManager->save($service);
        header("Location: /settings/service/list");
    }


    public function deleteAction()
    {
        $serviceManager = new ServiceManager();
        /*$service = $serviceManager->find($_GET['id']);
        print_r($service);
        //$service = $service->hydrate($_POST);*/
        $serviceManager->delete($_GET['id']);
        header("Location: /settings/service/list");
    }



}