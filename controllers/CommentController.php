<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\Helper;
use HotelFactory\forms\AddCommentsForm;
use HotelFactory\managers\CommentManager;
use HotelFactory\models\Comment;
use HotelFactory\core\View;
use HotelFactory\core\QueryBuilder;

class CommentController extends Controller
{

    /* Afficher les commentaires */
    public function listAction(){
        $commentManager = new CommentManager();
        $comments = $commentManager->findBy(array("idHotel"=>$_SESSION["hotel"]));
        $configTableComments = Comment::showCommentTable($comments);
        //print_r($configTableComments);
        $myView = new View("{$_SESSION['dir']}/comment/list", "back");
        $myView->assign("configTableComments", $configTableComments);
     /*   $var!=$_SESSION['hotel'];
        $commentManager = new CommentManager();
        $comments = $commentManager->findBy(array("idHotel"=>$var));
        $configTableComments = Comment::showCommentTable($comments);
                    $myView = new View("{$_SESSION['dir']}/comment/list", "back");
            $myView->assign("configTableComments", $result);*/
    }

/*

  
    }

    /* Afficher les commentaires signalés */
    public function signalAction(){
        $commentManager = new CommentManager();
        $comments = $commentManager->findNot($_SESSION["hotel"]);
        $configTableComments = Comment::showCommentTable($comments);
        $myView = new View("{$_SESSION['dir']}/comment/signal", "back");
        $myView->assign("configTableComments", $configTableComments);
    }
  

    public function formCommentAction(){
        $configFormComments = AddCommentsForm::getForm();
        $myView = new View("{$_SESSION['dir']}/comment/create", "back");
        $myView->assign("configFormComments", $configFormComments);
    }


    /* Mettre à jour un commentaire */
    public function updateAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $commentVals = array();
            $commentVals['id'] = explode('-',$_POST['active'])[0];
            $commentVals['active'] = explode('-',$_POST['active'])[1];

            $commentManager = new CommentManager();
            $comment = $commentManager->find($commentVals['id']);
            $comment = $comment->hydrate($commentVals);
            $commentManager->save($comment);
        }
        $header = ($_SESSION['role'] != 1)? "/settings/comment/list": "/dashboard/comments";
        
        header("Location: ".$header);
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
                $comment = new Comment();
                $comment = $comment->hydrate($_POST);
                $commentManager = new CommentManager();
                $commentManager->save($comment);

        }
        $this->redirectTo('Comment','formComment');
    }

    public function verifiedAction()
    {
        if(isset($_GET) && !(empty($_GET)))
        {
        $commentManager = new CommentManager();
        $comment = $commentManager->find($_GET['id']);
         $comment->setActive(0);
         var_dump($comment);

        $commentManager->save($comment);
    }
        $this->redirectTo('Comment','signal');
    
    }

    public function destroyAction(){
        if(isset($_GET) && !(empty($_GET)))
        {
            $commentManager = new CommentManager();
            $commentManager->delete($_GET['id']);


        }
        if(isset($_GET["signal"]) && !(empty($_GET["signal"]))){
            $this->redirectTo('Comment','signal');

        }else{

            header("Location: /dashboard/comments");
        }
}


}