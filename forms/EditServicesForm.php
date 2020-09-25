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
                    "cols"=>46,
                    "class"=>"form-control form-control-user"
                ],

                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"Description du service",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46,
                    "class"=>"form-control form-control-user"
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"prix",
                    "required"=>true,
                    "class"=>"form-control form-control-user"
                ]
            ]
        ];
    }
}

