<?php

namespace HotelFactory\managers;
use HotelFactory\core\Manager;
use HotelFactory\models\Service;


class ServiceManager extends Manager {


    public function __construct()
    {
        parent::__construct(Service::class, 'service');
    }


}