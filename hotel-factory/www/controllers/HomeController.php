<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\View;
use HotelFactory\managers\CommentManager;
use HotelFactory\models\Comment;

class HomeController extends Controller
{
    public function defaultAction()
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->findAll();
        $configTableComments = Comment::showCommentTable($comments);
        $myView = new View("home", "front");
        $myView->assign("configTableComments", $configTableComments);
    }

    public function conditionsAction()
    {
        new View("conditions","front");
    }
}
