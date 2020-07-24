<?php

namespace HOTEL\models;

class Room extends Model
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



    public static function showRoomTable($rooms){
        $tabRooms = [];
        foreach($rooms as $room){

            $tabRooms[] = [
                "id" => $room->getId(),
                "name" => $room->getName(),
                "description" => $room->getDescription(),
                "price" => $room->getPrice(),
                "idHotel" => $room->getIdHotel()

            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Description",
                "Prix",
                "Hotel"
            ],

            "fields"=>[
                "Room"=>[]
            ]
        ];

        $tab["fields"]["Room"] = $tabRooms;


        return $tab;
    }

}

?>