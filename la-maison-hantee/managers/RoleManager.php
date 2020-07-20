<?php

namespace HOTEL\managers;

use HOTEL\core\Manager;
use HOTEL\models\Role;


class RoleManager extends Manager {


    public function __construct()
    {
        parent::__construct(Role::class, 'role');
    }
}