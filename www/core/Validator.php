<?php

namespace HotelFactory\Core; 

class Validator
{
  public static function checkForm($configForm, $datas){
    $errosMsg = [];

    foreach ($datas as $key => $value) {
      if($key == 'email' && !self::checkEmail($value)){
        $errosMsg['email'] = "Format de l'email incorrect";
      }

      if($key == 'password'){
        $password = $value;
        if(!self::checkPassword($value)){
          $errosMsg['password'] = "Format du mot de passe incorrect";
        }
      }

      if($key == 'passwordConf'){
        if($password != $value){
          $errorsMsg['passwordConf'] = "Mots de passe différents";
        }
      }

      if($key == 'name' && !self::checkName($value)){
        $errosMsg['name'] = "Champs vide";
      }

      if($key == 'firstname' && !self::checkFirstname($value)){
        $errosMsg['firstname'] = "Champs vide";
      }

      if($key == 'birthdate' && !self::checkBirthdate($value)){
        $errosMsg['birthdate'] = "Date invalide";
      }
    }

    return $errosMsg;
  }

  public static function maxString($string, $length){
    return strlen(trim($string))<=$length;
  }

  public static function minString($string, $length){
    return strlen(trim($string))>=$length;
  }

  public static function checkEmail($email){

  }

  public static function checkPassword($password){
    return strlen($password)>=6 && strl($password)<=18 &&
    preg_match("/[a-z]/", $password) &&
    preg_match("/[A-Z]/", $password) &&
    preg_match("/[0-9]/", $password);
  }

  public static function checkName($name){
    $correct = true;
    if(strlen($name)>0){

    }
    return $correct;
  }

  public static function checkFirstname($firstname){
    $correct = true;

    return $correct;
  }

  public static function checkBirthdate($birthdate){
    $correct = true;

    return $correct;
  }



}



?>
