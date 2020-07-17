<?php

namespace HotelFactory\forms;

class SuccessMessage {

    public static function InscriptionSucess(){
        return [
            "title"=>"Inscription",

            "body"=>[
                "Votre compte à bien été enregistrer.",
                    "Merci de vérifier vos emails afin de valider votre compte."
            ]
        ];
    }
    public static function mailInscriptionSucess(){
        return [
            "title"=>"Inscription",

            "body"=>[
                "Votre email à été validé avec succes.",
                "Vous pouvez maintenant vous connecter à votre espace."
            ]
        ];
    }

    public static function sendMailForgotPasswordSucess(){
        return [
            "title"=>"Mot de passe oublié",

            "body"=>[
                "Votre compte à bien été enregistrer.",
                "Merci de vérifier vos emails afin de valider votre compte."
            ]
        ];
    }
    public static function newPasswordSucess(){
        return [
            "title"=>"Changement de mot de passe",

            "body"=>[
                "Votre mot de passe à été changé avec succes",
                "Vous pouvez maintenant vous connecter à votre espace avec votre nouveau mot de passe."
            ]
        ];
    }
}