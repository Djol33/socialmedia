<?php

namespace App\Controller;
use App\Model\ModelListOfFriends;
use App\Model\ModelAddMoreInfoOnFriends;
class ListOfFriends extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET") {

            $url = explode("/", $_SERVER["REQUEST_URI"])[2];

            $str = explode("=", $url)[1];
            if($str == 'session'){
                $str = $_SESSION["id"];
            }
            $model = new ModelListOfFriends();
            $a = $model->getListOfFriends($str);
            $model2 = new ModelAddMoreInfoOnFriends();
            echo json_encode($model2->info($a));
        }
    }
}