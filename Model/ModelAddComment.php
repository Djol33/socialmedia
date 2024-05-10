<?php

namespace App\Model;
use mysqli;
class ModelAddComment extends  Conn
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
    public function  addComment($content, $com_id, $post_id){
        $sql = "INSERT INTO comments (content, creator_id, post_id) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii",$content,$com_id,$post_id );
        if ($stmt->execute()) {
            echo "Success";
        } else {
            // Handle the execution error appropriately
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

}