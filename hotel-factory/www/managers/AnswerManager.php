<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\Answer;


class AnswerManager extends Manager {


    public function __construct()
    {
        parent::__construct(Answer::class, 'faq_answer');
    }
}