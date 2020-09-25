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
                "action"=>Helper::getURL("Page", "create"),
                "class"=>"Page",
                "id"=>"formPage",
                "submit"=>"Enregistrer la page"

            ],
            "fields"=>[
                "title"=>[
                    "type" => 'text',
                    "name" => 'nomPage',
                    "placeholder" => 'Titre de la page',
                    "id" =>'nomPage',
                    "class"=>"form-control form-control-user"
                ],
                "address"=>[
                    "type"=> 'text',
                    "name" => 'addressPage',
                    "id" => 'addressPage',
                    "uniq"=>["table"=>"page","column"=>"address"],
                    "hidden"=>"hidden",
                    "placeholder" => 'Entrez le chemin',
                    "class"=>"form-control form-control-user"
                ],
                "content"=>[
                    "type" => 'text',
                    "placeholder" => 'Le contenu de votre page',
                    "class"=>"form-control form-control-user",
                    "id" => 'contentPage',
                ]
            ],
        ];
    }
}