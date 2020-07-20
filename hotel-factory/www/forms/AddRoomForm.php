<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddRoomForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Room", "create"),
                "submit"=>"Envoyer"
            ],

            "fields"=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de la chambre",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ],
                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"Description de la chambre",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"prix",
                    "required"=>true,
                ],
                "quantity"=>[
                    "type"=>"number",
                    "placeholder"=>"quantité",
                    "required"=>true,
                ]


            ]
        ];
    }
}

