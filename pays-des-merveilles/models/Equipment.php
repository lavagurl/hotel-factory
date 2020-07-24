<?php

namespace HOTEL\models;

class Equipment extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $idTypeEquipment;


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

    public function setIdTypeEquipment($idTypeEquipment)
    {
        $this->idTypeEquipment=$idTypeEquipment;
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

    public function getIdTypeEquipment()
    {
        return $this->idTypeEquipment;
    }



    public static function showEquipmentTable($equipments){

        $tabEquipments = [];
        foreach($equipments as $equipment){

            $tabEquipments[] = [
                "id" => $equipment->getId(),
                "name" => $equipment->getName(),
                "description" => $equipment->getDescription(),
                "idHotel" => $equipment->getIdTypeEquipment()

            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Nom",
                "Description",
                "Hotel"
            ],

            "fields"=>[
                "Equipment"=>[]
            ]
        ];

        $tab["fields"]["Equipment"] = $tabEquipments;


        return $tab;
    }

}

?>