<?php

namespace App\View;

class RegisterView extends View
{
    public static function createView()
    {
        require_once __DIR__."/public/Register.php";
    }

}