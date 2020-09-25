<?php

namespace HotelFactory\core;

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
                $method = 'check' . ucfirst($key); //"check" avec le name des inputs du formulaire
                if (method_exists(get_called_class(), $method)) { //Vérifie que la méthode existe dans la classe appelée
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
        if (!preg_match("#^[\p{Latin}' -]+$#u", $firstname) || count_chars($firstname) < 50)
            return false;
        return true;
    }

    private function checkName($name)
    {
        if (!preg_match("#^[\p{Latin}' -]+$#u", $name) || count_chars($name) < 100)
            return false;
        return true;
    }

    private function checkEmail($email, $config)
    {
        if (array_key_exists("uniq", $config))
            if (!$this->uniq($email, $config["uniq"])) {
                return false;
            } else {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            }
    }

    private function checkPassword($password)
    {
        return preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,20}$#', $password);
    }

    private function checkPasswordConfirm($passwordConfirm)
    {
        return $this->password == $passwordConfirm;
    }

    private function checkCaptcha($captcha)
    {
        return strtolower($captcha) == $_SESSION["captcha"];
    }

    private function checkBirthdate($birthdate)
    {
        try {
            $birthdate = new \DateTime($birthdate);
            $date18 = new \DateTime("now");
            $date18->modify('-18 years');

            $date120 = new \DateTime("now");
            $date120->modify('-120 years');
        
            return $date18 >= $birthdate && $date120 <= $birthdate;
        } catch( \Throwable $t) {
            return false;
        }

    }

    public function uniq($data, $table)
    {
        $requete = new QueryBuilder(User::class, $table["table"]);
        $requete->querySelect("*");
        $requete->queryWhere($table["column"], "=", $data);
        $result = $requete->queryGget();
        if($result && in_array($data, $result)){
            return false;
        } else {
            return true;
        }
    }
}
