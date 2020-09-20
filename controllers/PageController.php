<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\QueryBuilder;
use HotelFactory\core\View;
use HotelFactory\forms\AddPageForm;
use HotelFactory\managers\PageManager;
use HotelFactory\models\Page;
use HotelFactory\models\User;

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
}