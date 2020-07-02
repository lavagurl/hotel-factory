<?php

namespace HotelFactory\models;
use HotelFactory\core\Helper;

class User extends Model
{
    protected $id;
    protected $email;
    protected $password;
    protected $name;
    protected $firstname;
    protected $birthdate;
    protected $creationDate;
    protected $idHfRole;

//    public function __construct()
//    {
//        parent::__construct(Model::class, 'Models');
//    }

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setEmail($email)
    {
        $this->email=strtolower($email);
    }

    public function setPassword($password)
    {
        $this->password=md5($password);
    }

    public function setName($name)
    {
        $this->name=strtoupper($name);
    }

    public function setFirstname($firstname)
    {
        $this->firstname=ucfirst(strtolower($firstname));
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate=$birthdate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate=$creationDate;
    }
    public function setIdHfRole($idHfRole)
    {
        $this->idHfRole=$idHfRole;
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
      return $this->creationDate;
    }
    public function getIdHfRole()
    {
        return $this->idHfRole;
    }
}

 ?>
