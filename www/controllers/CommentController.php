<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
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
        $myView = new View("admin/dashboard/comments", "back");
        $myView->assign("configTableComments", $configTableComments);
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


    public function commentAction()
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