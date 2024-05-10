<?php

namespace App\Controller;
use App\Model\ModelLike;
class Like extends Controller
{

    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"));

            $like = new ModelLike();
            $like->like($_SESSION["id"] , $data->id);



        }
    }
}