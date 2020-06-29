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
    protected $id_hf_role;

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

    public function setCreation_date($creation_date)
    {
        $this->creation_date=$creation_date;
    }
    public function setId_hf_role($id_hf_role)
    {
        $this->id_hf_role=$id_hf_role;
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

    public function getCreation_date()
    {
      return $this->creation_date;
    }
    public function getId_hf_role()
    {
        return $this->id_hf_role;
    }
}

 ?>
