<?php

namespace HOTEL\managers;

use HOTEL\core\Manager;
use HOTEL\models\User;


class UserManager extends Manager {


    public function __construct()
    {
        parent::__construct(User::class, 'user');
    }

    public function getUserAdmin()
    {
       
    }
}