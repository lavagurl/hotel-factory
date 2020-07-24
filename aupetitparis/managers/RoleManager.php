<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\Role;


class RoleManager extends Manager {


    public function __construct()
    {
        parent::__construct(Role::class, 'role');
    }
}