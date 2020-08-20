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
        $this->title = strip_tags($title);
    }

    public function setAddress($address)
    {
        $this->address = strip_tags($address);
    }

    public function setContent($content)
    {
        $this->content =strip_tags($content,['a','abbr','address','area','article','aside','audio',
        'b','base','bdo','blockquote','br','button','canvas','caption','cite','code','col','colgroup',
        'command','datalist','dd','del','details','dfn','div','dl','dt','em','embed','fieldset','figcaption',
        'figure','footer','form','h1','h2','h3','h4','h5','h6','head','header','hgroup','hr','i','iframe',
        'img','input','ins','keygen','kbd','label','legend','li','link','map','mark','math','menu','meter',
        'nav','object','ol','optgroup','option','output','p','param','pre','progress','q','samp','section',
        'select','small','source','span','strong','style','sub','summary','sup','svg','table','tbody','td',
        'textarea','tfoot','th','thead','time','title','tr','track','ul','var','video','wbr']);
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