<?php

namespace HOTEL\controllers;

use HOTEL\core\Controller;
use HOTEL\core\View;

class ErrorsController extends Controller
{
  public function quatreCentQuatreAction(){
    $myView = new View('404', 'front');
  }
}

 ?>
