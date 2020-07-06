<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\managers\AnswerManager;
use HotelFactory\models\Answer;
use HotelFactory\core\View;

class AnswerController extends Controller
{

    public function default(){
        $answerManager = new AnswerManager();
        $answer = $answerManager->find($_POST['id']);
        $configTableAnswers = Answer::showAnswerTable($answer);
        $myView = new View("admin/dashboard/answer", "back");
        $myView->assign("configTableAnswers", $configTableAnswers);
    }


    public function listAction(){
        $answerManager = new AnswerManager();
        $answers = $answerManager->findAll();
        $configTableAnswers = Answer::showAnswerTable($answers);
        $myView = new View("admin/dashboard/faq", "back");
        $myView->assign("configTableAnswers", $configTableAnswers);
    }

    public function updateAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $answerManager = new AnswerManager();
            $answer = $answerManager->find($_POST['id']);
            $answer = $answer->hydrate($_POST);
            $answerManager->save($answer);
        }
        header("Location: /dashboard/faq");
    }


    public function createAction()
    {
        if(isset($_POST) && !(empty($_POST)))
        {
            $answer = new Answer();
            $answer = $answer->hydrate($_POST);
            $answerManager = new AnswerManager();
            $answerManager->save($answer);

        }
        header("Location: /dashboard/faq");
    }


}