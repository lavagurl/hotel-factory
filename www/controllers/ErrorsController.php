<?php

namespace HotelFactory\Controllers;
use HotelFactory\Core\View;

class ErrorsController
{
  public function quatreCentQuatreAction(){
    $myView = new View('404', 'front');
  }
}

 ?>
