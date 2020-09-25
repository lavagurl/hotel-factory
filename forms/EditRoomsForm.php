<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class EditRoomsForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Room", "edit"),
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
                    "placeholder"=>"Nom de la chambre",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46,
                    "class"=>"form-control form-control-user"
                ],

                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"Description de la chambre",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46,
                    "class"=>"form-control form-control-user"
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"Prix",
                    "required"=>true,
                    "class"=>"form-control form-control-user"
                ]
            ]
        ];
    }
}

