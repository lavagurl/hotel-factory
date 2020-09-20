<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class RegisterInternalUserForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("User", "registerUser"),
                "class"=>"User",
                "id"=>"formRegisterUser",
                "submit"=>"S'inscrire"
            ],

            "fields"=>[
                "firstname"=>[
                    "label"=>"Prénom: ",
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "min-length"=>2,
                    "max-length"=>50,
                    "errorMsg"=>"Votre prénom doit faire entre 1 et 50 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "name"=>[
                    "label"=>"Nom: ",

                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "min-length"=>2,
                    "max-length"=>100,
                    "errorMsg"=>"Votre nom doit faire entre 1 et 100 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "email"=>[
                    "label"=>"Email: ",

                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "uniq"=>["table"=>"user","column"=>"email"],
                    "errorMsg"=>"Adresse mail invalide ou déja utilisée"
                ],
                "password"=>[
                    "label"=>"Mot de passe: ",
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"Votre mot de passe doit faire entre 8 et 20 caractères avec une minuscule, une majuscule, un nombre et un caractère spécial"
                ],
                "passwordConfirm"=>[
                    "label"=>"Confirmation de mot de passe: ",
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "confirmWith"=>"pwd",
                    "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
                ],
                "birthdate"=>[
                    "label"=>"Date de naissance: ",
                    "type"=>"date",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"Vous devez avoir plus de 18 ans pour vous inscrire"
                ]

            ]


        ];
    }
}