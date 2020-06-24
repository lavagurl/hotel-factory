<?php 

namespace HotelFactory\Connection;

interface ResultInterface 
{

    public function getArrayResult();
    public function getOneOrNullResult();
    public function getValueResult();
}