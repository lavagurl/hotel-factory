<?php

namespace HotelFactory\Forms;
use HotelFactory\Core\Helper;

class RegisterForm {
    
    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("User", "register"),
                "class"=>"User",
                "id"=>"formRegisterUser",
                "submit"=>"S'inscrire"
            ],

            "fields"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "min-length"=>2,
                    "max-length"=>50,
                    "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères"
                ],
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "min-length"=>2,
                    "max-length"=>100,
                    "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "uniq"=>["table"=>"users","column"=>"email"],
                    "errorMsg"=>"Le format de votre email ne correspond pas"
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
                ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "confirmWith"=>"pwd",
                    "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
                ],
                "captcha"=>[
                    "type"=>"captcha",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "placeholder"=>"Veuillez saisir les caractères",
                    "errorMsg"=>"Captcha incorrect"
                ],
                "birthdate"=>[
                    "type"=>"date",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"Date invalide"
                ]
            ]
        ];
    }
}