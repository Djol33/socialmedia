<?php

namespace App\Model;
use mysqli;
class ModelShowComments extends  Conn
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
    public function showComments($id_post){
        $sql = "SELECT  c.content, k.name  FROM comments c INNER JOIN korisnici k ON c.creator_id = k.id WHERE post_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_post);
        if (!$stmt->execute()) {
            die("Query execution failed: " . $stmt->error);
        }
        $data = array();
        $content = null;
        $creator_id= null;

        $stmt->bind_result($content, $creator_id);
        while ($stmt->fetch()) {
            $row = array(
                'content' => $content,
                'creator_id' => $creator_id,
            );
            $data[] = $row;


        }
        $stmt->close();
        return $data;

    }
}