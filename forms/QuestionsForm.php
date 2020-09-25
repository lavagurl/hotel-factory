<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class QuestionsForm {

    public static function getForm(){
        return [
            "config"=>[
                "id"=>"",
                "class"=>"",
                "method"=>"POST",
                "action"=>Helper::getUrl("Question", "create"),
                "submit"=>"Envoyer"
            ],

            "fields"=>[
                "question"=>[
                    "type"=>"text",
                    "placeholder"=>"Entrez ici votre question",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ]
            ]
        ];
    }
}

