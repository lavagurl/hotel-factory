<?php

namespace HotelFactory\managers;
use HotelFactory\core\Manager;
use HotelFactory\models\Room;


class RoomManager extends Manager {


    public function __construct()
    {
        parent::__construct(Room::class, 'room');
    }


}