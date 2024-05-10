<?php

namespace App\Controller;

class LogOut
{
    public static function LogOut():void{
        if(isset($_SESSION["id"]) && isset($_SESSION["name"])){
            unset($_SESSION["id"]);
            unset($_SESSION["name"]);
        }
    }

}