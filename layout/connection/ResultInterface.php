<?php 

namespace HOTEL\connection;

interface ResultInterface 
{

    public function getArrayResult();
    public function getOneOrNullResult();
    public function getValueResult();
}