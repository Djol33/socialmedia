<?php

namespace App\View;

class CreatePostView extends View
{
    public static function createView()
    {
        require_once __DIR__."/public/createpost.php";
    }
}