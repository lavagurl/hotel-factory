<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\View;
use HotelFactory\forms\AddCommentsForm;
use HotelFactory\forms\QuestionsForm;
use HotelFactory\managers\QuestionManager;
use HotelFactory\models\Question;

class DashboardUserController extends Controller
{

  public function defaultAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/home", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }

  }

  public function userPagesAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/pages", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }

  }

  public function userDesignAction()
  {
    if($_SESSION['role'] == "2"){
      $myView = new View("user/dashboard/design", "back");
    }else{
      header('Location: /vous-etes-perdu');
    }
  }

  public function userSettingsAction()
  {
    if($_SESSION['role'] == "2"){
      $configFormComments = AddCommentsForm::getForm();
      $myView = new View("user/dashboard/settings", "back");
      $myView->assign("configFormComments", $configFormComments);
    }else{
      header('Location: /vous-etes-perdu');
    }

  }

  public function userFaqAction()
  {
      if($_SESSION['role'] == "2"){
        $questionManager = new QuestionManager();
        $questions = $questionManager->findAll();
        $configTableQuestions = Question::showQuestionTable($questions);
        $configFromQuestions = QuestionsForm::getForm();
        $myView = new View("user/dashboard/faq", "back");
        $myView->assign("configFromQuestions", $configFromQuestions);
        $myView->assign("configTableQuestions", $configTableQuestions);
      }else{
        header('Location : /vous-etes-perdu');
      }
  }

}

 ?>
