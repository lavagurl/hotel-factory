<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\managers\QuestionManager;
use HotelFactory\core\View;
use HotelFactory\models\Question;

class QuestionController extends Controller
{


    public function listAction(){
        $questionManager = new QuestionManager();
        $questions = $questionManager->findAll();
        $configTableQuestions = Question::showQuestionTable($questions);
        $myView = new View("admin/dashboard/faq", "back");
        $myView->assign("configTableQuestions", $configTableQuestions);
    }

    public function updateAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $questionManager = new QuestionManager();
            $question = $questionManager->find($_POST['id']);
            $question = $question->hydrate($_POST);
            $questionManager->save($question);
        }
        header("Location: /dashboard/faq");
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $question = new Question();
            $question = $question->hydrate($_POST);
            $questionManager = new QuestionManager();
            $questionManager->save($question);

        }
        header("Location: /settings/faq");
    }


}