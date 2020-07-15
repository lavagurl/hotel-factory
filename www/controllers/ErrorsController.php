<?php

namespace HotelFactory\controllers;

use HotelFactory\core\Controller;
use HotelFactory\core\View;

class ErrorsController extends Controller
{
  public function quatreCentQuatreAction(){
    $myView = new View('404', 'front');
  }
}

 ?>
