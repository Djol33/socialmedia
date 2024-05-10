<?php

namespace App\Model;
use \mysqli;
class Conn
{
    public  $conn;
    public  $host;
    public  $db;
    public $user;
    public $password;
    public function __construct($db ="korisnici", $host="db", $user="userr", $password="userr"){
        try{
            $this->conn = new mysqli($host, $user, $password, $db);
        }catch(\mysqli_sql_exception $e){
            echo "there is a problem";
        }
    }

}