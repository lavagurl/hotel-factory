<?php

namespace HotelFactory\controllers;
use HotelFactory\core\View;

class ErrorsController
{
  public function quatreCentQuatreAction(){
    $myView = new View('404', 'front');
  }
}

 ?>
