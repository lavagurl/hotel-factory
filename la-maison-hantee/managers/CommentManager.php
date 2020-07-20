<?php

namespace HOTEL\managers;
use HOTEL\core\Manager;
use HOTEL\models\Comment;


class CommentManager extends Manager {


    public function __construct()
    {
        parent::__construct(Comment::class, 'comment');
    }


}