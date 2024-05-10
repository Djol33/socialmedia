<?php

namespace App\Controller;

class AllFriends extends Controller
{

    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"] =="GET"){
            $url = explode("/", $_SERVER["REQUEST_URI"])[2];

            $str = explode("=", $url)[1];
        }
    }
}