<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddServiceForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Service", "create"),
                "submit"=>"Envoyer",
                "id"=>"",
                "class"=>""
            ],

            "fields"=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du service",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46,
                    "id"=>"",
                    "class"=>"form-control form-control-user"
                ],

                "description"=>[
                    "type"=>"text",
                    "placeholder"=>"Description du service",
                    "required"=>true,
                    "rows"=>5,
                    "cols"=>46,
                    "id"=>'',
                    "class"=>"form-control form-control-user"
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"prix",
                    "required"=>true,
                    "id"=>'',
                    "class"=>"form-control form-control-user"
                ]
            ]
        ];
    }
}

