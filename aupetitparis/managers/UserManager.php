<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\User;


class UserManager extends Manager {


    public function __construct()
    {
        parent::__construct(User::class, 'user');
    }

    public function getUserAdmin()
    {
       
    }
}