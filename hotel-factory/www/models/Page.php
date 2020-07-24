<?php

namespace HotelFactory\models;

use HotelFactory\managers\HotelManager;

class Page extends Model
{
    protected $id;
    protected $title;
    protected $address;
    protected $content;
    protected $idhotel;

    /* SETTERS */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setIdHotel($idhotel)
    {
        $this->idHotel = $idhotel;
    }

    /* GETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getIdHotel()
    {
        return $this->idHotel;
    }

    public static function showPageTable($pages)
    {
        $hotelManager = new HotelManager;
        $tabPages = [];

        foreach($pages as $page)
        {
            $hotel = $hotelManager->find($page->getIdHotel());


            $tabPages[] = [
                "id" => $page->getId(),
                "title" => $page->getTitle(),
                "address" => $page->getAddress(),
                //"content" => $page->getContent(),
                //"idHotel" => $hotel->getName()
            ];

        }
        $tab = [
            "colonnes"=>[
                "Id",
                "Titre de la page",
                "Addresse de la page",
                //"Content",
                //"IdHotel"
            ],

            "fields"=>[
                "Page"=>[]
            ]
        ];

        $tab["fields"]["Page"] = $tabPages;

        return $tab;
    }

    public static function formPageTable($pages)
    {
        $hotelManager = new HotelManager;
        $tabPages = [];

        foreach($pages as $page)
        {
            $hotel = $hotelManager->find($page->getIdHotel());


            $tabPages[] = [
                "id" => $page->getId(),
                //"title" => $page->getTitle(),
                //"address" => $page->getAddress(),
                "content" => $page->getContent(),
                //"idHotel" => $hotel->getName()
            ];

        }
        $tab = [
            "colonnes"=>[
                "Id",
                //"Titre de la page",
                //"Addresse de la page",
                "Content",
                //"IdHotel"
            ],

            "fields"=>[
                "Page"=>[]
            ]
        ];

        $tab["fields"]["Page"] = $tabPages;

        return $tab;
    }



}