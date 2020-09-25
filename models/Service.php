<?php

namespace HotelFactory\models;

class Service extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $idHotel;


    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function setDescription($description){
        $this->description=$description;
    }

    public function setPrice($price)
    {
        $this->price=$price;
    }

    public function setIdHotel($idHotel)
    {
        $this->idHotel=$idHotel;
    }
    
    public function setStatus($status)
    {
        $this->status=$status;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getIdHotel()
    {
        return $this->idHotel;
    }
    
    public function getStatus()
    {
        return $this->status;
    }


    public static function showServiceTable($services){
        $tabServices = [];
        foreach($services as $service){
            $tabServices[] = [
                "id" => $service->getId(),
                "name" => $service->getName(),
                "description" => $service->getDescription(),
                "price" => $service->getPrice(),
                "status" => $service->getStatus(),

            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Description",
                "Prix"
            ],

            "fields"=>[
                "Service"=>[]
            ]
        ];

        $tab["fields"]["Service"] = $tabServices;


        return $tab;
    }

}

?>