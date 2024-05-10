<?php

namespace App\View;

class HeaderView extends  View
{
    public static function createView():void{
        require __DIR__."/public/Header.php";


    }
}