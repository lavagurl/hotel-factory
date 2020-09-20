<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\forms\AnswersForm;
use HotelFactory\managers\AnswerManager;
use HotelFactory\managers\QuestionManager;
use HotelFactory\models\Answer;
use HotelFactory\core\View;
use HotelFactory\models\Question;

class AnswerController extends Controller
{

    public function __construct()
    {

    }

    public function defaultAction(){
        $answerManager = new AnswerManager();
        $answer = $answerManager->find($_POST['id']);
        $configTableAnswers = Answer::showAnswerTable($answer);
        $myView = new View("{$_SESSION['dir']}/faq/default", "back");
        $myView->assign("configTableAnswers", $configTableAnswers);
    }


    public function listAction(){
        $answerManager = new AnswerManager();
        $answers = $answerManager->findAll();
        $configTableAnswers = Answer::showAnswerTable($answers);
        $myView = new View("{$_SESSION['dir']}/faq/list", "back");
        $myView->assign("configTableAnswers", $configTableAnswers);
    }

    public function showAction(){
        $id = ["id"=>$_GET['id']];
        $questionManager = new QuestionManager();
        $question = $questionManager->findBy($id);
        $configFromQuestion = Question::showQuestionTable($question);

        $configFormAnswer = AnswersForm::getForm();

        $myView = new View("{$_SESSION['dir']}faq/show", "back");
        $myView->assign("configFromQuestion", $configFromQuestion);
        $myView->assign("configFormAnswer", $configFormAnswer);
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
        if(isset($_POST) && !(empty($_POST))):
            $answer = new Answer();
            $answer = $answer->hydrate($_POST);
            $answerManager = new AnswerManager();
            $answerManager->save($answer);
            header("Location: /dashboard/faq");
        endif;
    }


}