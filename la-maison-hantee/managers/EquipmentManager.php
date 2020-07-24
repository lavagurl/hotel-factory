<?php

namespace HOTEL\managers;
use HOTEL\core\Manager;
use HOTEL\models\Equipment;


class EquipmentManager extends Manager {


    public function __construct()
    {
        parent::__construct(Equipment::class, 'equipment');
    }


}