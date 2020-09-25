<?php

namespace HotelFactory\models;
use HotelFactory\core\Helper;
use HotelFactory\managers\UserManager;

class Comment extends Model
{
    protected $id;
    protected $message;
    protected $idHfUser;
    protected $active;
    protected $idHotel;


    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setMessage($message)
    {
        $this->message=$message;
    }

    public function setIdHfUser($idHfUser){
        $this->idHfUser=$idHfUser;
    }

    public function setActive($active)
    {
        $this->active=$active;
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

    public function getMessage()
    {
        return $this->message;
    }

    public function getIdHfUser()
    {
        return $this->idHfUser;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getIdHotel()
    {
        return $this->idHotel;
    }



    public static function showCommentTable($comments){
        $userManager = new UserManager();


        $tabComments = [];
        foreach($comments as $comment){
            $user = $userManager->find($comment->getIdHfUser());

            $tabComments[] = [
                "id" => $comment->getId(),
                "message" => $comment->getMessage(),
                "idHfUser" => $user->getId(),
                "active" => $comment->getActive(),
                "idHotel" => $comment->getIdHotel()

            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Message",
                "User",
                "Active",
                "IdHotel",
            ],

            "config"=>[
                "method"=>"POST",
                "action"=>Helper::getUrl("User", "update"),
                "class"=>"Comment",
                "id"=>"",
            ],

            "fields"=>[
                "Comment"=>[]
            ]
        ];

        $tab["fields"]["Comment"] = $tabComments;


        return $tab;
    }

}

?>