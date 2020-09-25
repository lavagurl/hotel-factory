<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class EditHotelForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Hotel", "edit"),
                "submit"=>"Modifier",
                "id"=>"",
                "class"=>""
            ],


            "fields"=>[
                "id"=>[
                    "type"=>"number",
                    "required"=>true,
                    "hidden"=>"hidden",
                ],

                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de l'Hotel",
                    "required"=>true,
                    "class"=>"form-control form-control-user input-center"
                ],

                "address"=>[
                    "type"=>"text",
                    "placeholder"=>"Adresse",
                    "required"=>true,
                    "class"=>"form-control form-control-user input-center"
                ],
                "zipcode"=>[
                    "type"=>"text",
                    "placeholder"=>"Zipcode",
                    "required"=>true,
                    "class"=>"form-control form-control-user input-center"
                ],

                "country"=>[
                    "type"=>"text",
                    "placeholder"=>"Prix",
                    "required"=>true,
                    "class"=>"form-control form-control-user input-center"
                ]
            ]
        ];
    }
}

