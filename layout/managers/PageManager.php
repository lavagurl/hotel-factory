<?php

namespace HOTEL\managers;

use HOTEL\core\Manager;
use HOTEL\models\Page;

class PageManager extends Manager
{
    public function __construct()
    {
        parent::__construct(Page::class, 'page');
    }

}