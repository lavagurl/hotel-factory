<?php

namespace HotelFactory\models;

class Room extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $idHotel;
    protected $status;

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


    public static function showRoomTable($rooms){
        $tabRooms = [];
        foreach($rooms as $room){

            $tabRooms[] = [
                "id" => $room->getId(),
                "name" => $room->getName(),
                "description" => $room->getDescription(),
                "price" => $room->getPrice(),
                "idHotel" => $room->getIdHotel(),
                "status" => $room->getStatus()
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