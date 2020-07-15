<?php


namespace HotelFactory\forms;


use HotelFactory\core\Helper;

class PageBuilderForm
{
    public static function getForm()
    {
        return[
            "config" =>[
                "method"=>"POST",
                "action"=>Helper::getURL("PageBuilder", "default"),
                "class"=>"Page",
                "id"=>"formPageBuilder",
                "submit"=>"Créer la page"

            ],
            "fields"=>[
                "nomPage"=>[
                    "type" => 'text',
                    "placeholder" => 'Le nom de la page',
                    "class" => 'form-control',
                    "id" =>'nomPage',
                    "required"=>true,
                    "min-length"=> 2,
                    "max-length"=> 50,
                    "errorMsg" => 'Votre nom de page doit faire entre 2 et 50 caractères et aucun ne doit être spéciaux.'
                ],
                "addressPage"=>[
                    "type"=> 'text',
                    "placeholder" => 'Adresse de la page',
                    "class" => 'form-control',
                    "id" => 'addressPage',
                    "required"=>true,
                    "min-length" => 2,
                    "max-length" => 20,
                    "errorMsg" => "L'adresse de la page doit faire entre 2 et 20 caractères et aucun d'eux ne doivent être spéciaux"
                ],

            ],
            "contentfield"=>[
                "contentfield"=>[
                "type" => 'textarea',
                "placeholder" => 'La contenu de votre page',
                'class' => 'form-control',
                "id" => 'contentPage',
                "required" => 'true'
                ]
            ]

        ];
    }
}