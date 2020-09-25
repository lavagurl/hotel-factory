<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class CreateHotelForm {

    public static function getForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("Hotel", "create"),
                "submit"=>"Enregistrer mon hotel",
                "id"=>"",
                "class"=>""
            ],

            "fields"=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de l'hotel",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "uniq"=>["table"=>"hotel","column"=>"name"],
                    "required"=>true,
                    "errorMsg"=>"entrez le nom de l'hotel"
                ],
                "address"=>[
                    "type"=>"text",
                    "placeholder"=>"L'adresse de l'hotel",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "uniq"=>["table"=>"hotel","column"=>"address"],
                    "required"=>true,
                    "errorMsg"=>"entrez l'adresse de l'hotel"
                ],
                "zipcode"=>[
                    "type"=>"text",
                    "placeholder"=>"Code Postal",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"entrez un code postal"
                ],
                "city"=>[
                    "type"=>"text",
                    "placeholder"=>"Ville",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"entrez la ville"
                ],
                "country"=>[
                    "type"=>"text",
                    "placeholder"=>"Pays",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true,
                    "errorMsg"=>"entrez le pays"
                ],

                "valid"=>[
                    "type"=>"number",
                    "value"=>1,
                    "hidden"=>"hidden",
                    "class"=>"form-control form-control-user",
                    "id"=>"",
                    "required"=>true
                ]
            ],

        ];
    }
}

