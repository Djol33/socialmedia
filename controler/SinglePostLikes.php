<?php

namespace App\Controller;
use App\Model\ModelOnePostNumberOfLikes;
class SinglePostLikes extends Controller
{
    public static function Page()
    {
        $data = json_decode(file_get_contents("php://input"));
        $obj_like = new ModelOnePostNumberOfLikes();
        $num_of_likes = $obj_like->countLikeOnPost($data->id);

        header('Content-Type: application/json');
        echo json_encode($num_of_likes);
    }
}