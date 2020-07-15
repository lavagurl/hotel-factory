<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\Helper;
use HotelFactory\core\View;
use HotelFactory\managers\CommentManager;
use HotelFactory\managers\QuestionManager;
use HotelFactory\models\Comment;
use HotelFactory\models\Question;


class DashboardAdminController extends Controller
{
    public function defaultAction()
    {
        Helper::checkRole(1);
        $myView = new View("admin/dashboard/home", "back");

    }

    public function adminPagesAction()
    {
        Helper::checkRole(1);
        $myView = new View("admin/dashboard/pages", "back");

    }

    public function adminDesignAction()
    {
        Helper::checkRole(1);
        $myView = new View("admin/dashboard/design", "back");

    }

    public function adminCommentsAction()
    {
        Helper::checkRole(1);
        $commentManager = new CommentManager();
        $comments = $commentManager->findAll();
        $configTableComments = Comment::showCommentTable($comments);
        $myView = new View("admin/dashboard/comments", "back");
        $myView->assign("configTableComments", $configTableComments);

    }

    public function adminPermissionsAction()
    {
        Helper::checkRole(1);

    }

    public function adminSettingsAction()
    {
        Helper::checkRole(1);
        $myView = new View("admin/dashboard/settings", "back");
    }

    public function adminFaqAction()
    {
        Helper::checkRole(1);
        //$configFromAnswers = AnswersForm::getForm();

        $questionManager = new QuestionManager();
        $questions = $questionManager->findAll();
        $configTableQuestions = Question::showQuestionTable($questions);
        $myView = new View("admin/dashboard/faq", "back");
        $myView->assign("configTableQuestions", $configTableQuestions);
    }

}
