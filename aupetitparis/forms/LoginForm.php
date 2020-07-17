<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class LoginForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("User", "login"),
                "class"=>"User",
                "id"=>"formLoginUser",
                "submit"=>"Se connecter"
            ],

            "fields"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"identifiant ou mot de passe incorrect"
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"identifiant ou mot de passe incorrect"
                ],
            ]
        ];
    }
}