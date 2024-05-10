<?php

namespace App\Controller;
use App\View\CreatePostView;
use App\Model\ModelCreatePost;
class MakePost extends Controller
{
    public static function Page(): void
    {
        if(isset($_SESSION["id"]) && isset($_SESSION["name"])) {
            CreatePostView::createView();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $f_id = $_SESSION["id"];
                $title = $_POST["title"];
                $content = $_POST["content"];
                $model = new ModelCreatePost();
                $model->makePost($f_id, $title, $content);
            }
        }
        else{
            echo "<p>Please <a href='login'>Login</a> to continue</p>";
        }

    }

}