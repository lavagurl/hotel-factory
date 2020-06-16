<?php 

namespace HotelFactory\Core\Connection;

interface ResultInterface 
{

    public function getArrayResult();
    public function getOneOrNullResult();
    public function getValueResult();
}