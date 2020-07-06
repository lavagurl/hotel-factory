<?php

namespace HotelFactory\forms;
use HotelFactory\Core\Helper;

class AnswersForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Answer", "create"),
                "submit"=>"Envoyer"
            ],

            "fields"=>[
                "answer"=>[
                    "type"=>"text",
                    "placeholder"=>"Répondez ici",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ]

            ]
        ];
    }
}

