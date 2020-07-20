<?php

namespace HOTEL\managers;
use HOTEL\core\Manager;
use HOTEL\models\Room;


class RoomManager extends Manager {


    public function __construct()
    {
        parent::__construct(Room::class, 'room');
    }


}