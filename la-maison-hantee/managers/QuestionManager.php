<?php

namespace HOTEL\managers;

use HOTEL\core\Manager;
use HOTEL\models\Question;


class QuestionManager extends Manager {


    public function __construct()
    {
        parent::__construct(Question::class, 'faq_question');
    }
}