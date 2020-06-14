<?php

namespace HotelFactory\Models;
use HotelFactory\Core\Helper;
use HotelFactory\Core\QueryBuilder;

class User extends QueryBuilder
{
    protected $id;
    protected $email;
    protected $password;
    protected $name;
    protected $firstname;
    protected $birthdate;
    protected $creation_date;

    public function __construct()
    {
        parent::__construct();
    }

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setEmail($email)
    {
        $this->email=$email;
    }

    public function setPassword($password)
    {
        $this->password=$password;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function setFirstname($firstname)
    {
        $this->firstname=$firstname;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate=$birthdate;
    }

    public function setCreationDate($id)
    {
        $this->creation_date=$creation_date;
    }

      /* GETTERS */

    public function getId()
    {
      return $this->id;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function getPassword()
    {
      return $this->password;
    }

    public function getName()
    {
      return $this->name;
    }

    public function getFirstname()
    {
      return $this->firstname;
    }

    public function getBirthdate()
    {
      return $this->birthdate;
    }

    public function getCreationDate()
    {
      return $this->creation_date;
    }

    /* FONCTIONS */

    public static function getRegisterForm(){
      return [
          "config"=>[
              "method"=>"POST",
              "action"=>Helper::getUrl("User", "register"),
              "class"=>"User",
              "id"=>"formRegisterUser",
              "submit"=>"S'inscrire"
          ],

          "fields"=>[
              "firstname"=>[
                  "type"=>"text",
                  "placeholder"=>"Votre prénom",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "min-length"=>2,
                  "max-length"=>50,
                  "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères"
              ],
              "name"=>[
                  "type"=>"text",
                  "placeholder"=>"Votre nom",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "min-length"=>2,
                  "max-length"=>100,
                  "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères"
              ],
              "email"=>[
                  "type"=>"email",
                  "placeholder"=>"Votre email",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "uniq"=>["table"=>"users","column"=>"email"],
                  "errorMsg"=>"Le format de votre email ne correspond pas"
              ],
              "password"=>[
                  "type"=>"password",
                  "placeholder"=>"Votre mot de passe",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
              ],
              "passwordConfirm"=>[
                  "type"=>"password",
                  "placeholder"=>"Confirmation",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "confirmWith"=>"pwd",
                  "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
              ],
              "captcha"=>[
                  "type"=>"captcha",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "placeholder"=>"Veuillez saisir les caractères",
                  "errorMsg"=>"Captcha incorrect"
              ],
              "birthdate"=>[
                  "type"=>"date",
                  "class"=>"form-control form-control-user",
                  "id"=>"",
                  "required"=>true,
                  "errorMsg"=>"Date invalide"
              ]
          ]
      ];
    }


}

 ?>
