<?php

namespace App\Controller;
use App\Model\ModelOpenPost;
use App\View\OpenPostView;
use App\Controller\AddComment;
class OpenPost extends Controller
{
    public static function Page(): void
    {
        $req_method = $_SERVER["REQUEST_URI"];
        $req_method = explode("/", $req_method);
        $id = (int)$req_method[2];
        $obj =new ModelOpenPost();
        $res = $obj->OpenPost($id);
        OpenPostView::createView(...$res);




    }
}