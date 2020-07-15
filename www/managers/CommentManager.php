<?php

namespace HotelFactory\managers;
use HotelFactory\core\Manager;
use HotelFactory\models\Comment;


class CommentManager extends Manager {


    public function __construct()
    {
        parent::__construct(Comment::class, 'comment');
    }


}