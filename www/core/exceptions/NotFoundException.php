<?php

namespace HotelFactory\core\exceptions;
use Exception;

class  NotFoundException extends Exception
{

    public function __construct($message, $code = 404)
    {
        parent::__construct($message, $code);
    }

}
