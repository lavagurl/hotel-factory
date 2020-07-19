<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\Helper;
use HotelFactory\forms\QuestionsForm;
use HotelFactory\managers\QuestionManager;
use HotelFactory\core\View;
use HotelFactory\models\Question;

class QuestionController extends Controller
{

    public function listAction(){
        $questionManager = new QuestionManager();
        $questionsActive = $questionManager->findBy(array("status"=>1));
        $questionsActive = Question::showQuestionTable($questionsActive);

        if($_SESSION['role'] == 1 || $_SESSION['role'] == 3){
            $questionsInactive = $questionManager->findBy(array("status"=>0));
            $questionsInactive = Question::showQuestionTable($questionsInactive);

            $myView = new View("{$_SESSION['dir']}faq/list", "back");

            $myView->assign("questionsActive",$questionsActive);
            $myView->assign("questionsInactive", $questionsInactive);

        }else{
            $configFromQuestions = QuestionsForm::getForm();

            $myView = new View("{$_SESSION['dir']}faq/list", "back");

            $myView->assign("configFromQuestions", $configFromQuestions);
            $myView->assign("configTableQuestions", $questionsActive);
        }

    }


    public function updateAction()
    {
        print_r($_POST);
        Helper::checkRole(1);
        if(isset($_POST) && !(empty($_POST)))
        {
            $questionManager = new QuestionManager();
            $question = $questionManager->find($_POST['id']);
            if(isset($_POST['active'])):
                $_POST['status'] = $_POST['active'];
            endif;
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
        $this->redirectTo("Question", "list");
    }


}