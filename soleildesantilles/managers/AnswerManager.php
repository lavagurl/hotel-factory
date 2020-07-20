<?php

namespace HOTEL\managers;

use HOTEL\core\Manager;
use HOTEL\models\Answer;


class AnswerManager extends Manager {


    public function __construct()
    {
        parent::__construct(Answer::class, 'faq_answer');
    }
}