<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class EditServicesForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Service", "edit"),
                "submit"=>"Modifier"
            ],

            "fields"=>[
                "id"=>[
                    "type"=>"number",
                    "required"=>true,
                    "hidden"=>"hidden"
                ],

                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du service",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ],

                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"Description du service",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"prix",
                    "required"=>true,
                ]
            ]
        ];
    }
}

