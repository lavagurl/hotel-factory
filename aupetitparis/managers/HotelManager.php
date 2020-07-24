<?php

namespace HotelFactory\managers;
use HotelFactory\core\Manager;
use HotelFactory\models\Hotel;


class HotelManager extends Manager {


    public function __construct()
    {
        parent::__construct(Hotel::class, 'hotel');
    }


}