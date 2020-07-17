<?php

namespace HotelFactory\core;

use HotelFactory\core\builders\QueryBuilder;
use HotelFactory\models\User;
use function Sodium\compare;

class Validator
{
    public function checkForm($configForm, $data)
    {
        $errosMsg = [];

        if (count($configForm["fields"]) == count($data)) {
            foreach ($configForm["fields"] as $key => $config) {
                $this->$key = $data[$key];
                //Vérifie que l'on a bien les champs attendus
                //Vérifier les required
                if (!array_key_exists($key, $data) || ($config["required"] && empty($data[$key]))) {
                    return ["Tentative de hack !!!"];
                }
                //Utilisation de la méthode de vérification de champs si celle ci éxiste
                $method = 'check' . ucfirst($key);
                if (method_exists(get_called_class(), $method)) {
                    if (!$this->$method($data[$key], $config)) {
                        $errosMsg[$key] = $config["errorMsg"];
                    }
                }
            }
        }
        return $errosMsg;
    }

    private function checkFirstname($firstname)
    {
        //utilisation des caractères de l'alphabet avec accent avec une longueur max de 50 caractères
        if (!preg_match("#^[\p{Latin}' -]+$#u", $firstname) || count_chars($firstname) <= 50)
            return false;
        return true;
    }

    private function checkName($name)
    {
        //utilisation des caractères de l'alphabet avec accent avec une longueur max de 100 caractères
        if (!preg_match("#^[\p{Latin}' -]+$#u", $name) || count_chars($name) <= 100)
            return false;
        return true;
    }

    private function checkEmail($email, $config)
    {
        //vérification de la validité du format du mail
        if(array_key_exists("uniq",$config))
            //si un champ uniq existe
            if(!$this->uniq($email,$config["uniq"]))
                return false;

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function checkPassword($password)
    {
        //1 majuscule 1 minuscule 1 caractere spécial 1 chiffre le tout entre 8 et 20 caractères
        return preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,20}$#', $password);
    }

    private function checkPasswordConfirm($passwordConfirm)
    {
        //vérifie que les mots de passes sont identiques
        return $this->password == $passwordConfirm;
    }

    private function checkCaptcha($captcha)
    {
        //vérification que le captcha entré est correct
        return strtolower($captcha) == $_SESSION["captcha"];
    }

    private function checkBirthdate($birthdate)
    {
        //vérifie la majorité de la personne
        $birthdate = new \DateTime($birthdate);
        $date = new \DateTime("now");
        $date->modify('-18 years');
        return $date >= $birthdate;
    }

    private function uniq($data,$table)
    {
        //vérifi dans la db que la valeur n'existe pas pour un champs donnée
        $requete = new QueryBuilder(User::class, $table["table"]);
        $requete->querySelect($table["column"]);
        $requete->queryWhere($table["column"], "=", $data);
        $result = $requete->queryGget();
        if($result["column"] == $data)
            return false;
        return true;
    }


}




