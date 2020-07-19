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
        //$request->queryWhere('token','=',$_SESSION['token']); A décommenter quand le token sera rajouté
        $result = $request->queryGget();
        

        if (!empty($result))
        {
            $pageRequest = new PageManager;
            $pageResult = $pageRequest->findBy(array("idHotel"=>$result));
            $configPage = Page::showPageTable($pageResult);
            //print_r($pageResult);
            $myView = new View('admin/page/list','back');
            $myView -> assign('pageResult',$configPage);
        }
    }

    public function formpageAction()
    {
        $id = ["id"=>$_GET['id']];
        $pageManager = new PageManager();
        $page = $pageManager->findBy($id);
        //$configFormPage = AddPageForm::getForm();
        $configFormPage = Page::formPageTable($page);
        //echo '<pre>';
        //print_r($configFormPage);
        //echo '</pre>';
        $myView = new View("{$_SESSION['dir']}/page/update", "back");
        $myView->assign("configFormPage", $configFormPage);
    }

    public function updateAction()
    {
        $pageManager = new PageManager();
        var_dump($_POST);
        $page = $pageManager->find($_POST['id']);
        $page = $page->hydrate($_POST);
        $pageManager->save($page);
        $this->redirectTo('Page','default');
    }
}