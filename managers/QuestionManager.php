<?php

namespace HotelFactory\managers;

use HotelFactory\core\Manager;
use HotelFactory\models\Question;


class QuestionManager extends Manager {


    public function __construct()
    {
        parent::__construct(Question::class, 'faq_question');
    }
}