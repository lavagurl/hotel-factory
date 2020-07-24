<?php

namespace HOTEL\models;

class Role extends Model
{
    protected $id;
    protected $caption;

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setCaption($caption)
    {
        $this->caption=$caption;
    }


    /* GETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public static function showRoleTable($roles){

        $tabRoles = [];
        foreach($roles as $role){
            $tabRoles[] = [
                "id" => $role->getId(),
                "caption" => $role->getCaption()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Caption"
            ],

            "fields"=>[
                "Role"=>[]
            ]
        ];

        $tab["fields"]["Role"] = $tabRoles;

        return $tab;
    }

}

