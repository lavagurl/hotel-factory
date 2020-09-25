<?php

namespace HotelFactory\core\tools;

class Message
{

    public static function InscriptionSucess()
    {
        return [
            "title" => "Inscription",

            "body" => [
                "Votre compte a bien été enregistré.",
                "Merci de vérifier vos emails afin de valider votre compte."
            ]
        ];
    }

    public static function mailInscriptionSucess()
    {
        return [
            "title" => "Inscription",

            "body" => [
                "Votre email a été validé avec succes.",
                "Vous pouvez maintenant vous connecter à votre espace."
            ]
        ];
    }

    public static function sendMailForgotPasswordSucess()
    {
        return [
            "title" => "Mot de passe oublié",

            "body" => [
                "Votre compte a bien été enregistré.",
                "Merci de vérifier vos emails afin de valider votre compte."
            ]
        ];
    }

    public static function newPasswordSucess()
    {
        return [
            "title" => "Changement de mot de passe",

            "body" => [
                "Votre mot de passe a été changé avec succes",
                "Vous pouvez maintenant vous connecter à votre espace avec votre nouveau mot de passe."
            ]
        ];
    }

    public static function linkNoValid()
    {
        return [
            "title" => "Validation",

            "body" => [
                "Le lien n'est pas valide"
            ]
        ];
    }
}