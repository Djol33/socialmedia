<?php

namespace App\View;

class ShowCommentsView extends View
{
    public static function createView(...$res)
    {
        // You can use the $basicdata and $data parameters here
        require __DIR__ . "/public/Comments.php";
    }
}
