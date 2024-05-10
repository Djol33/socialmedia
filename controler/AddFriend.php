<?php

namespace App\Controller;
use App\Model\ModelAddFriend;
class AddFriend extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST"  && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_SESSION["id"]) ) {
            $input_data = file_get_contents("php://input");

            $data = json_decode($input_data);
            if(isset($data->action) && $data->action ==="accept"){
                $objekat = new ModelAddFriend();
                $objekat->accept($_SESSION["id"], $data->id);
            }
            else if(isset($data->action) && $data->action ==="decline"){
                $objekat= new ModelAddFriend();
                $objekat->decline($data->id);
            }
            else if(isset($data->action) && $data->action ==="follow"){
            $objekat = new ModelAddFriend();

            $objekat->addFriend($data->id_post,$_SESSION["id"]);}
        }
    }


}