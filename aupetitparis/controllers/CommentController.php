<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\forms\AddCommentsForm;
use HotelFactory\managers\CommentManager;
use HotelFactory\models\Comment;
use HotelFactory\core\View;

class CommentController extends Controller
{


    /* Afficher les commentaires */
    public function listAction(){
        $commentManager = new CommentManager();
        $comments = $commentManager->findAll();
        $configTableComments = Comment::showCommentTable($comments);
        $myView = new View("{$_SESSION['dir']}dashboard/comments", "back");
        $myView->assign("configTableComments", $configTableComments);

    }

    public function formCommentAction(){
        $configFormComments = AddCommentsForm::getForm();
        $myView = new View("{$_SESSION['dir']}dashboard/settings", "back");
        $myView->assign("configFormComments", $configFormComments);
    }

    /* Mettre à jour un commentaire */
    public function updateAction()
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->find($_POST['id']);
        $comment = $comment->hydrate($_POST);
        $commentManager->save($comment);
        header("Location: /dashboard/comments");
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
        header("Location: /settings/parametres");
    }


}