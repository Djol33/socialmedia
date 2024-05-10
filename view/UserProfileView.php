<?php

namespace App\View;

class UserProfileView extends View
{

    private static $basicdata;
    private static $posts;

    public static function initialize(array $basicdata , array $posts)
    {
        self::$basicdata = $basicdata;
        self::$posts = $posts;

    }
    public static function createView()
    {
        $basicdata = self::$basicdata;
        $posts = self::$posts;
        require_once __DIR__."/public/UserProfile.php";
    }
}