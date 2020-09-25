<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddRoomForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Room", "create"),
                "submit"=>"Envoyer",
                "id"=>'',
                "class"=>""
            ],

            "fields"=>[
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
                    "placeholder"=>"prix",
                    "required"=>true,
                    "class"=>"form-control form-control-user"
                ],
                "quantity"=>[
                    "type"=>"number",
                    "placeholder"=>"quantité",
                    "required"=>true,
                    "class"=>"form-control form-control-user"
                ]


            ]
        ];
    }
}

