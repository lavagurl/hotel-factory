<?php
namespace HotelFactory\Managers;

use HotelFactory\Core\Connection\PDOConnection;
use HotelFactory\Core\Manager;
use HotelFactory\Models\User;

class UserManager extends Manager {

    public function __construct()
    {
        parent::__construct(User::class, 'users');
    }

    public function getUserAdmin()
    {

    }
}

