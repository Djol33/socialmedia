<?php

namespace App\Model;
use mysqli;
class ModelCreatePost extends  Conn
{
    public $conn;

    public function __construct($database = "posts"){
        parent::__construct($db ="korisnici", $host="db", $user="userr", $password="userr");

        try{
            $this->conn = new mysqli($host, $user, $password, $db);
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }
    public function makePost($f_id, $title, $content){
        $title=htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $sql_query = "INSERT INTO posts (fk_id, title, text) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bind_param("iss", $f_id, $title, $content);
        $stmt->execute();
    }
}