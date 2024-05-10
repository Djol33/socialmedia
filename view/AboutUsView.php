<?php

namespace App\View;

class AboutUsView extends View
{
    public static function createView():void{
        require __DIR__."/public/about-us.php";
    }
}