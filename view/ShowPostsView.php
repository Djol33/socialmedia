<?php

namespace App\View;

class ShowPostsView
{
    public static function createView(...$rows)
    {
        require __DIR__."/public/show-posts.php";
    }
}