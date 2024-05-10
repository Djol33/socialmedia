<?php

namespace App\Controller;
use App\Model\ModelAddComment;
class AddComment extends Controller
{
    public static function Page(): void
    {

        ob_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["id"]) && !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
            $req_method = explode("/", $_SERVER["REQUEST_URI"]);
            if (isset($req_method[2])) {
                $page = $req_method[2];
            } else {
                echo "greska";
                exit();
            }
            $content = htmlspecialchars($_POST["comment"]);
            $id_user = $_SESSION["id"];
            $id_post = $page;
            $obj = new ModelAddComment();
            $obj->addComment($content, $id_user, $id_post);
            header("Location: /post/{$page}");

            ob_end_flush();
        }
        else if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && isset($_SESSION["id"])){
            $id_user = $_SESSION["id"];
            $input_data = file_get_contents("php://input");
            $data = json_decode($input_data);

            $obj = new ModelAddComment();
            $obj->addComment($data->content, $id_user, $data->id);


        }
    }

}