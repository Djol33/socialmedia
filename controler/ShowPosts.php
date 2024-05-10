<?php

namespace App\Controller;
use App\Model\ModelLike;
use App\Model\ModelShowPosts;
use App\View\ShowPostsView ;
use App\Model\ModelPagination;
use App\Model\ModelShowLikes;
use App\Controller\Like;
use App\Model\ModelDoIfollow;
use App\Model\ModelUpdateFollowButton;
class ShowPosts extends  Controller
{
    public static function Page(): void
    {
        global $rows;

        $req_method = $_SERVER["REQUEST_URI"];
        $req_method = explode("/", $req_method);

        $pag = new ModelPagination();
        $page_number = $pag->numberOfRows();
                if (isset($req_method[2]) && $req_method[2]>0  && $req_method[2]<=$page_number) {
                    $page = $req_method[2];
                } else {
                    $page = 1;
                }

                $obj = new ModelShowPosts();
                 $rows = $obj->showPosts($page);
                $likes = new ModelShowLikes();
                $likes->showLikes($_SESSION["id"], $rows);
                $follow = new ModelDoIfollow();
                $follow->doIFollow($_SESSION["id"], $rows);


                if($_SERVER["REQUEST_METHOD"]=="GET") {
                    ShowPostsView::createView(...$rows);

                    echo "<br/><br/>";

                    echo "<br/><br/><div id='pagination'>";

                    for ($i = $page - 3 < 1 ? $i = 1 : $page - 3; $i <= 5 && $i <= $page_number; $i++) {
                        echo "  <a " . ($i == $page ? "class='current'" : "") . " href='/all-posts/{$i}'>{$i}</a>  ";
                    }
                    echo "</div>";
                }
                 if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
                    $data = json_decode(file_get_contents("php://input"));
                    if($data->action == "updaterow"){
                        $obj = new ModelShowPosts();
                        $rows = $obj->showPosts($data->page);
                        $likes = new ModelShowLikes();
                        $likes->showLikes($_SESSION["id"], $rows);
                        $follow = new ModelDoIfollow();
                        $follow->doIFollow($_SESSION["id"], $rows);
                        $follow_update = new ModelUpdateFollowButton();
                        $res = $follow_update->updateFollowButton($_SESSION["id"],$rows);
                         echo json_encode($res);

                    }

                }

/*
        if ($req_method[1] == "all-posts" && isset($req_method[2]) && $req_method[2] == "like" and $_SERVER["REQUEST_METHOD"] == "POST") {
            Like::Page();
        }
*/

    }
}