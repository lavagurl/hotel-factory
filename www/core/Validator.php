<?php

namespace HotelFactory\Core; 

use HotelFactory\Models\User;
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
                $method = 'check'.ucfirst($key);
                if (method_exists(get_called_class(),$method))
                {
                    if (!$this->$method($data[$key])) {
                        $errosMsg[$key] = $config["errorMsg"];
                    }
                }
            }
        }
        return $errosMsg;
    }

    public function checkFirstname($firstname)
    {
        if (!preg_match("#^[\p{Latin}' -]+$#u", $firstname) || count_chars($firstname) < 50)
            return false;
        return true;
    }
    public function checkName($name)
    {
        if (!preg_match("#^[\p{Latin}' -]+$#u", $name) || count_chars($name) < 100)
            return false;
        return true;
    }
    private function checkEmail($email)
    {
        $result = "";
        $requete = new QueryBuilder(User::class, 'user');
        $requete->querySelect("email");
        $requete->queryWhere("email","=", $email);
        $result = $requete->queryGget();
        echo ($result == $email);
        if($result == $email)
            return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function checkPassword($password)
    {
        return preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,20}$#', $password);
    }

    public function checkPasswordConfirm($passwordConfirm)
    {
        return $this->password == $passwordConfirm;
    }

    public function checkCaptcha($captcha)
    {
        return strtolower($captcha) == $_SESSION["captcha"];
    }
    public function checkBirthdate($birthdate)
    {
        $birthdate = new \DateTime($birthdate);
        $date = new \DateTime("now");
        $date->modify('-18 years');
        return $date>= $birthdate;
    }



}



?>
