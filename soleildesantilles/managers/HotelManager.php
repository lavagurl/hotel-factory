<?php

namespace HOTEL\managers;
use HOTEL\core\Manager;
use HOTEL\models\Hotel;


class HotelManager extends Manager {


    public function __construct()
    {
        parent::__construct(Hotel::class, 'hotel');
    }


}