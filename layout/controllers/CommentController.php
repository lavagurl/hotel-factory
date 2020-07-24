<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\forms\AddCommentsForm;
use HOTEL\managers\CommentManager;
use HOTEL\managers\PageManager;
use HOTEL\models\Comment;
use HOTEL\core\View;

class CommentController extends Controller
{


    /* Afficher les commentaires */
    public function listAction(){
        $commentManager = new CommentManager();
        $comments = $commentManager->findAll();
        $configTableComments = Comment::showCommentTable($comments);

        $pageManager = new PageManager();
        $pageManager = $pageManager->findBy(array("idHotel"=>$_SESSION['hotel'], "address" => $_SERVER['REQUEST_URI']));
        $myView = new View("/comment/list", "front");
        $myView->assign("page", $pageManager);
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