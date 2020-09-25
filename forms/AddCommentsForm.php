<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddCommentsForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Comment", "create"),
                "submit"=>"Envoyer",
                "id"=>'test',
                "class"=>''
            ],

            "fields"=>[
                "message"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre avis en quelques mots (300 mots)",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ]

            ]
        ];
    }
}

