<?php

namespace App\Controller;
use App\Model\MyProfileModel;
use App\View\MyProfileView;
use App\View\UserProfileView;
use App\Model\ModelUserProfile;
use App\Model\ModelShowLikes;
class MyProfile extends Controller
{
    public static function Page()
    {
        ob_start();
        if(isset($_SESSION["id"])) {

            $model = new ModelUserProfile();
            $basicData=$model->renderUserProfile($_SESSION['id']);
            $posts = $model->renderPosts($_SESSION["id"]);
            $model_likes = new ModelShowLikes();
            $model_likes->showLikes($_SESSION["id"], $posts);
            UserProfileView::initialize($basicData, $posts);
            UserProfileView::createView();
            /*$id = $_SESSION["id"];
            $basicdata = new MyProfileModel();
            $basicdata = $basicdata->basicData($id);

            $myposts = new MyProfileModel();
            $data = $myposts->myPosts($id);
            MyProfileView::initialize($basicdata, $data);
            MyProfileView::createView();*/
        }
        else{
            header("Location: login");
        }
        ob_end_flush();
    }
}