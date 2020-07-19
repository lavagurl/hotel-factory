<?php

namespace HotelFactory\forms;
use HotelFactory\core\Helper;

class AddPageForm
{
    public static function getForm()
    {
        return[
            "config" =>[
                "method"=>"POST",
                "action"=>Helper::getURL("Page", "update"),
                "class"=>"Page",
                "id"=>"formPage",
                "submit"=>"Enregistrer la page"

            ],
            "fields"=>[
                "title"=>[
                    "type" => 'text',
                    "name" => 'nomPage',
                    "id" =>'nomPage',
                    "value"=>''
                    
                ],
                "address"=>[
                    "type"=> 'text',
                    "name" => 'addressPage',
                    "id" => 'addressPage',
                    "value"=>''
                ],
                "content"=>[
                    "type" => 'text',
                    "placeholder" => 'Le contenu de votre page',
                    'class' => 'form-control',
                    "id" => 'contentPage',
                    "required" => 'true'
                    ]
            ],
        ];
    }
}