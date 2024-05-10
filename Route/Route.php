<?php

namespace App\Route;

class Route
{
    public static $validRoute = array();
    public static function  set($route, $method){
        self::$validRoute = $route;
        if(isset($_GET["url"])) {
            if ($_GET["url"] == $route) {
                $method->__invoke();

                return;

            }
        }else if( !isset($_GET["url"])){
            if( $route == "home"){
                $method->__invoke();

            }
        }
        else{
            echo "page not found";
        }



    }


}