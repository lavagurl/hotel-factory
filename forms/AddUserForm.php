<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddUserForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>($_SESSION['hotel'] == 1)?"/dashboard/user/add_moderator":"/settings/user/add_moderator",
                "submit"=>"Envoyer"
            ],

            "fields"=>[
                "firstname"=>[
                    "id"=>"",
                    "class"=>"form-control form-control-user",
                    "type"=>"text",
                    "placeholder"=>"Prénom",
                    "required"=>true,
                    "errorMsg"=>"Votre prénom doit faire entre 1 et 50 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "name"=>[
                    "id"=>"",
                    "class"=>"form-control form-control-user",
                    "type"=>"text",
                    "placeholder"=>"Nom",
                    "required"=>true,
                    "errorMsg"=>"Votre nom doit faire entre 1 et 100 caractères et ne doit pas contenir de caractères spéciaux ni de nombres"
                ],
                "email"=>[
                    "id"=>"",
                    "class"=>"form-control form-control-user",
                    "type"=>"email",
                    "placeholder"=>"Email",
                    "required"=>true,
                    "uniq"=>["table"=>"user","column"=>"email"],
                    "errorMsg"=>"Adresse mail invalide ou déja utilisée"
                ],
                "password"=>[
                    "id"=>"",
                    "class"=>"form-control form-control-user",
                    "type"=>"text",
                    "placeholder"=>"Mot de passe",
                    "required"=>true,
                    "errorMsg"=>"Votre mot de passe doit faire entre 8 et 20 caractères avec une minuscule, une majuscule, un nombre et un caractère spécial"
                ],
                "birthdate"=>[
                    "id"=>"",
                    "class"=>"form-control form-control-user",
                    "type"=>"date",
                    "required"=>true,
                    "errorMsg"=>"Vous devez avoir plus de 18 ans pour vous inscrire"
                ],
                "idHfRole"=>[
                    "type"=>"number",
                    "value"=>3,
                    "hidden"=>"hidden",
                    "required"=>true
                ],
                "idHfCompany"=>[
                    "type"=>"number",
                    "value"=>$_SESSION['hotel'],
                    "hidden"=>"hidden",
                    "required"=>true
                ]
            ]
        ];
    }
}

