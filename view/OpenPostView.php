<?php

namespace App\View;

class OpenPostView extends View
{
    public static function createView( ...$res ):void{
        require __DIR__."/public/OpenPost.php";
        echo "<br/><hr/><br/>";
        require __DIR__."/public/CommentFormView.php";
    }
}