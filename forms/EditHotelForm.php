<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class EditHotelForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Hotel", "edit"),
                "submit"=>"Modifier"
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
                ],

                "address"=>[
                    "type"=>"text",
                    "placeholder"=>"Adresse",
                    "required"=>true,
                ],
                "zipcode"=>[
                    "type"=>"text",
                    "placeholder"=>"Zipcode",
                    "required"=>true,
                ],

                "country"=>[
                    "type"=>"text",
                    "placeholder"=>"Prix",
                    "required"=>true,
                ],
                "route"=>[
                    "type"=>"text",
                    "placeholder"=>"Route",
                    "required"=>true
                ]
            ]
        ];
    }
}

