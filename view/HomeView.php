<?php

namespace App\View;

class HomeView extends View
{
    public static function createView():void{
        require __DIR__."/public/home.php";
    }

}