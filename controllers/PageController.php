<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\QueryBuilder;
use HotelFactory\core\View;
use HotelFactory\forms\AddPageForm;
use HotelFactory\managers\PageManager;
use HotelFactory\models\Page;
use HotelFactory\models\User;
use HotelFactory\models\Hotel;
use HotelFactory\managers\HotelManager;
use HotelFactory\core\Validator;



class PageController extends Controller
{
    public function defaultAction()
    {
        $request = new QueryBuilder(User::class,'user');
        $request->querySelect('idHfCompany');
        $request->queryWhere('id','=',$_SESSION['id']);
        $result = $request->queryGget();
        if (!empty($result))
        {
            $pageRequest = new PageManager;
            $pageResult = $pageRequest->findBy(array("idHotel"=>$result[0]));
            $configPage = Page::showPageTable($pageResult);
            $myView = new View("{$_SESSION['dir']}/page/list","back");
            $myView -> assign('pageResult',$configPage);
        }else{
            echo "ya rien";
        }
    }
    

    public function formpageAction()
    {
        //if(!(empty($_GET['id']) && $_GET[''] )
        $id = ["id"=>$_GET['id']];
        $pageManager = new PageManager();
        $page = $pageManager->findBy($id);
        $configFormPage = Page::formPageTable($page);
        $myView = new View("{$_SESSION['dir']}/page/update", "back");
        $myView->assign("configFormPage", $configFormPage);
    }

    public function updateAction()
    {
        $pageManager = new PageManager();
        $page = $pageManager->find($_POST['id']);
        $page = $page->hydrate($_POST);
        $pageManager->save($page);
        $this->redirectTo('Page','default');
    }

    
    public function statusAction()
    {
        if(isset($_GET) && !(empty($_GET)))
        {
        $pageManager = new PageManager();
        $page = $pageManager->find($_GET['id']);
        //var_dump($page);
            echo $_GET['status'];
        
        if($_GET["status"]==0){
            $page->setStatus(1);
            //print_r($page);
        }else{
            $page->setStatus(0);
            print_r($page);
            echo "h";
        }
        $pageManager->save($page);
        }
        $this->redirectTo('Page','default'); 
    }

    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
                $routeFinal = trim($_POST['title']);
                $routeFinal = preg_replace('#&#', '', $routeFinal);
                $routeFinal = strtolower(htmlentities( $routeFinal, ENT_NOQUOTES, 'utf-8'));
                $routeFinal = preg_replace('#&([a-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|&amp|uml|);#', '\1', $routeFinal);
                $routeFinal = preg_replace('#[0-9]#','', $routeFinal); 
                $routeFinal = preg_replace('#[^a-z]+#i', '', $routeFinal);
                $routeFinal = '/'.$routeFinal;

                $validator = new Validator();
                $route = $validator->uniq($routeFinal,array("table"=>"page","column"=>"address"));

                if($route == false){
                    $hotel = new Hotel();
                    $hotelManager = new HotelManager();
                    $hotel = $hotelManager->find($_SESSION['hotel']);

                    $_POST['address'] = $routeFinal;
                    $page = new Page();
                    $page = $page->hydrate($_POST);
                    $pageManager = new PageManager();
                    $pageManager->save($page);
    
                    $base = "../../".$hotel->getRoute()."/views/pages/base.view.php";
                    $chemin = "../../".$hotel->getRoute()."/views/pages".$page->getAddress().".view.php";
                    $cmd ="cp ".$base." ".$chemin." | chmod 777 ".$chemin;
    
                    $cmd2 = "chmod 777 ../../".$hotel->getRoute()."/routes.yml";
                    shell_exec($cmd2);
                    $content = file_get_contents("../../".$hotel->getRoute()."/routes.yml");
                    file_put_contents("../../".$hotel->getRoute()."/routes.yml", $content."\n".$page->getAddress().":\n  controller: Page\n  action: show");
    
                    shell_exec($cmd);
                    $this->redirectTo('Page','default');
    
                }else{
                    echo "Erreur : cette page existe déjà";
                }
               
        }
    }
    
    public function formCreatePageAction(){
        $configFormPage = AddPageForm::getForm();
        $myView = new View("{$_SESSION['dir']}/page/create", "back");
        $myView->assign("configFormPage", $configFormPage);
    }
}