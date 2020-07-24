<?php

namespace HotelFactory\models;
use HotelFactory\managers\RoleManager;

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
        $this->password=sha1($password);
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

    public function setToken($token)
    {
        $this->token = $token;
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

    public function getToken()
    {
        return $this->token;
    }

    public static function showUserTable($users){
        $roleManager = new RoleManager();

        $tabUsers = [];
        foreach($users as $user){
            $role = $roleManager->find($user->getIdHfRole());

            $tabUsers[] = [
                "id" => $user->getId(),
                "name" => $user->getName(),
                "firstname" => $user->getFirstname(),
                "email" => $user->getEmail(),
                "birthdate" => $user->getBirthdate(),
                "creationDate" => $user->getCreationDate(),
                "idHfRole" => $role->getId()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Prénom",
                "Email",
                "Date de naissance",
                "Date de création",
                "Role"
            ],

            "fields"=>[
                "User"=>[]
            ]
        ];

        $tab["fields"]["User"] = $tabUsers;


        return $tab;
    }

}

?>