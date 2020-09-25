<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddUserForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("User", "create"),
                "submit"=>"Envoyer"
            ],

            "fields"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Prénom",
                    "required"=>true,
                    "errorMsg"=>"Votre prénom doit faire entre 1 et 50 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom",
                    "required"=>true,
                    "errorMsg"=>"Votre nom doit faire entre 1 et 100 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Email",
                    "required"=>true,
                    "uniq"=>["table"=>"user","column"=>"email"],
                    "errorMsg"=>"Adresse mail invalide ou déja utilisée"
                ],
                "password"=>[
                    "type"=>"text",
                    "placeholder"=>"Mot de passe",
                    "required"=>true,
                    "errorMsg"=>"Votre mot de passe doit faire entre 8 et 20 caractères avec une minuscule, une majuscule, un nombre et un caractère spécial"
                ],
                "birthdate"=>[
                    "type"=>"date",
                    "required"=>true,
                    "errorMsg"=>"Vous devez avoir plus de 18 ans pour vous inscrire"
                ],
                "idHfRole"=>[
                    "type"=>"number",
                    "value"=>3,
                    "hidden"=>"hidden"
                ],
                "idHfCompany"=>[
                    "type"=>"number",
                    "value"=>1,
                    "hidden"=>"hidden"
                ]
    }
        ];
    }
}
