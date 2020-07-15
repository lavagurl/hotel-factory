<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\View;
use HotelFactory\forms\PageBuilderForm;

class PageBuilderController extends Controller
{
    public function defaultAction()
    {
        $configFormCreatePage = PageBuilderForm::getForm();
        $myView = new View('admin/dashboard/pagebuilder','back');
        $myView->assign("configFormCreatePage",$configFormCreatePage);
    }
}