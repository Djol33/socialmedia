<?php

namespace App\Controller;
use App\Model\ModelUserProfile;
use App\Model\ModelShowLikes;
use App\View\UserProfileView;

class UserProfile extends Controller
{
    public static function Page()
    {
        ob_start();
        $uri = explode("/", $_SERVER["REQUEST_URI"])[2];
        if(isset($uri)){
            if($uri == $_SESSION["id"]) {
                header("Location: http://localhost/my-profile");
            }
            $model = new ModelUserProfile();
            $basicdata =$model->renderUserProfile($uri);

            $posts = $model->renderPosts($uri);
            $model_likes = new ModelShowLikes();
            $model_likes->showLikes($_SESSION["id"], $posts);
            UserProfileView::initialize($basicdata, $posts );
            UserProfileView::createView();

        }
        ob_end_flush();

    }
}