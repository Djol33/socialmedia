<?php
session_start();
ob_start();

require 'vendor/autoload.php';
use App\Route\Route;
use App\Controller\Home;
use App\Controller\AboutUs;
use App\Controller\Register;
use App\Controller\Login;
use \App\View\HeaderView;
use App\Controller\LogOut;
use App\Controller\MakePost;
use App\Controller\ShowPosts;
use App\Controller\OpenPost;
use App\Controller\AddComment;
use App\Controller\ShowComments;
use App\Controller\MyProfile;
use App\Controller\Footer;
use App\Controller\Like;
use App\Controller\SinglePostLikes;
use App\Controller\AddFriend;
use App\Controller\PendingFriendRequests;
use App\Controller\UserProfile;
use App\Controller\ListOfFriends;
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
}
else{
    HeaderView::createView();
}



Route::set("like", function(){
    Like::Page();
    SinglePostLikes::Page();
});

Route::set("home", function() {
    Home::Page();
});
Route::set("about-us", function() {
    AboutUs::Page();
});

Route::set("register", function() {
    if(!isset($_SESSION["name"]) && !isset($_SESSION["id"])){
        Register::Page();


    }else {
        header("Location: about-us");

        exit();
    }
});
Route::set("login", function() {

    if(!isset($_SESSION["name"]) && !isset($_SESSION["id"])){
        Login::Page();


    }else {
        header("Location: about-us");

        exit();
    }

});


Route::set("logout", function() {
    LogOut::LogOut();
    header("Location: login");
});

Route::set("makepost", function() {
    MakePost::Page();
});
Route::set("all-posts", function() {

    ShowPosts::Page();
});

Route::set("post", function() {
OpenPost::Page();
ShowComments::Page();
});
Route::set("make-comment", function() {
    AddComment::Page();

});

Route::set("my-profile", function() {
    MyProfile::Page();


});
Route::set("follow",function(){
   AddFriend::Page();

});
Route::set("friend-list", function(){
    ListOfFriends::Page();

});
Route::set("pending-friend-request", function (){
    PendingFriendRequests::Page();
});
Route::set("user-profile", function (){
    UserProfile::Page();

});
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
}
else{
    Footer::Page();}


ob_end_flush();
