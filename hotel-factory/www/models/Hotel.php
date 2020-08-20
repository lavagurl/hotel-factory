<?php

namespace HotelFactory\models;
use HotelFactory\Managers\HotelManager;

class Hotel extends Model
{
    protected $id;
    protected $name;
    protected $address;
    protected $zipcode;
    protected $city;
    protected $country;
    protected $status;
    protected $route;
    protected $idUser;


    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setName($name)
    {
        $this->name=strip_tags($name);
    }

    public function setAddress($address)
    {
        $this->address=strip_tags($address);
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode=strip_tags($zipcode);
    }

    public function setCity($city)
    {
        $this->city=strip_tags($city);
    }

    public function setCountry($country)
    {
        $this->country=strip_tags($country);
    }
    public function setStatus($status)
    {
        $this->status=$status;
    }

    public function setRoute($route)
    {
        $this->route=strip_tags($route);
    }

    public function setIdUser($idUser)
    {
        $this->idUser=$idUser;
    }


    /* GETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }


    public static function showHotelTable($hotels){

        $tabHotels = [];
        foreach($hotels as $hotel){

            $tabHotels[] = [
                "id" => $hotel->getId(),
                "name" => $hotel->getName(),
                "status" => $hotel->getStatus(),
                "route" => $hotel->getRoute()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Confirmé?",
                "Acceder au site"
            ],

            "fields"=>[
                "Hotel"=>[]
            ]
        ];

        $tab["fields"]["Hotel"] = $tabHotels;


        return $tab;
    }


    public static function showDetailsHotel($hotel){

        $tabHotels = [];

            $tabHotels[] = [
               "id" => $hotel->getId(),
                "name" => $hotel->getName(),
                "address"=>$hotel->getAddress(),
                "zipcode"=>$hotel->getZipcode(),
                "city"=>$hotel->getCity(),
                "country"=>$hotel->getCountry(),
                "status" => $hotel->getStatus(),
                "route" => $hotel->getRoute()
            ];

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Adresse",
                "Code Postal",
                "Ville",
                "Pays",
                "Confirmé?",
                "Route"
            ],

            "fields"=>[
                "Hotel"=>[]
            ]
        ];

        $tab["fields"]["Hotel"] = $tabHotels;


        return $tab;
    }


}