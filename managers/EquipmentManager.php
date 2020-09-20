<?php

namespace HotelFactory\managers;
use HotelFactory\core\Manager;
use HotelFactory\models\Equipment;


class EquipmentManager extends Manager {


    public function __construct()
    {
        parent::__construct(Equipment::class, 'equipment');
    }


}