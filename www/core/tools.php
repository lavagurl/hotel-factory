<?php

namespace HotelFactory\core;

class tools
{
    public static function generateToken()
    {
        $token = '';
        for($i = 0; $i <15; $i++ )
        {
            $token .= mt_rand(0,9);
        }
        return sha1($token);
    }
}
