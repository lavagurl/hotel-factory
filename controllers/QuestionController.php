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

        if(($_SESSION['role'] == 1 || $_SESSION['role'] == 3) && $_SESSION['hotel'] == 1){
            $questionsInactive = $questionManager->findBy(array("status"=>0));
            $questionsInactive = Question::showQuestionTable($questionsInactive);

            $myView = new View("{$_SESSION['dir']}faq/list", "back");

            $myView->assign("questionsActive", $questionsActive);
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
        if(isset($_POST) && !(empty($_POST)))
        {
            $questionManager = new QuestionManager();
            var_dump($_POST);
            $questionAr = array();
            $questionAr['id'] = explode('-',$_POST['active'])[0];
            $questionAr['active'] = explode('-',$_POST['active'])[1];
            $question = $questionManager->find($questionAr['id']);
            if(isset($_POST['active'])):
                $questionAr['status'] = $questionAr['active'];
            endif;
            $question = $question->hydrate($questionAr);
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
        Helper::redirectTo("Question", "list");
    }


}