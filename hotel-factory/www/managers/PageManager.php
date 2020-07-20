<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\Page;

class PageManager extends Manager
{
    public function __construct()
    {
        parent::__construct(Page::class, 'page');
    }

}