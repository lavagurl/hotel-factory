<?php

namespace HotelFactory\mails;

class ConfirmAccountMail {

    public static function getMail($email,$prenom,$url){
        return [
            "sender"=>[
                "email"=>"ne-pas-repondre@hotelfactory.com",
                "pseudo"=>"Administrateur HotelFactory"
            ],

            "addressee"=>[
                "email"=>$email,
                "pseudo"=>$prenom
            ],

            "body"=>[
                "html" => "true",
                "subject" => "Confirmation de votre compte",
                "body" => "Bonjour et bienvenu $prenom! Afin de valider votre compte, veillez cliquer sur ce lien <a href=\"$url\">Confirmation</a> ou le copier dans un nouvel onglet : $url<br/>
                          A bientot sur HotelFactory!",
                "altBody" => "Bonjour et bienvenu $prenom! Afin de valider votre compte, veillez cliquer sur ce lien $url ou le copier dans un nouvel onglet <br/>
                          A bientot sur HotelFactory!"
            ]
        ];
    }
}