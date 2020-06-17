<?php

namespace HotelFactory\Models;
use HotelFactory\Core\Helper;

class User extends Model
{
    protected $id;
    protected $email;
    protected $password;
    protected $name;
    protected $firstname;
    protected $birthdate;
    protected $creation_date;

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
        $this->email=$email;
    }

    public function setPassword($password)
    {
        $this->password=md5($password);
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

    public function setCreationDate($creation_date)
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
}

 ?>
