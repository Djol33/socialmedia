<?php

namespace App\Controller;
use App\Model\ModelPendingFriendRequests;
class PendingFriendRequests extends Controller
{
    public static function Page()
    {
        $obj = new ModelPendingFriendRequests();
        $res = $obj->getPendingRequests($_SESSION["id"]);
         echo json_encode($res);
    }
}