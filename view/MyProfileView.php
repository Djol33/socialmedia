<?php

namespace App\View;

class MyProfileView extends  View
{

    private static $basicdata;
    private static $data;

    public static function initialize(array $basicdata, array $data)
    {
        self::$basicdata = $basicdata;
        self::$data = $data;
    }

    public static function createView()
    {
        // Access the data using class properties
        $basicdata = self::$basicdata;
        $data = self::$data;


        echo "<br/>";
        // Require the template file
        require_once __DIR__ . "/public/MyProfile.php";
    }


}