<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\User;


class UserManager extends Manager {


    public function __construct()
    {
        parent::__construct(User::class, 'user');
    }

    public function manageUserToken($id,$token,$values = null)
    {
        $user = new User();
        //utilisation de l'hydrate si on veux passer d'autres attribut en plus que l'id et le token
        if(!empty($values))
        {
            $user = $user->hydrate($values);
        }
        //innitialisation du token dans la db pour l'id indiqué
        $user->setId($id);
        $user->setToken($token);
        $this->save($user);
    }
}