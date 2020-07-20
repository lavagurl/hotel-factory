<?php

namespace HOTEL\managers;
use HOTEL\core\Manager;
use HOTEL\models\Service;


class ServiceManager extends Manager {


    public function __construct()
    {
        parent::__construct(Service::class, 'service');
    }


}