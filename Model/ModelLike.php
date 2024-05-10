<?php

namespace App\Model;
use mysqli;
class ModelLike extends  Conn
{
    public $conn;
    public function __construct()
    {
        parent::__construct($db ="korisnici", $host="db", $user="userr", $password="userr");

        try{
            $this->conn = new mysqli($host, $user, $password, $db);
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }
    public function like($id_user, $id_post){
        $sql = "SELECT * FROM likes where id_post = ? AND id_user = ?;";
        $stmt = $this->conn->prepare($sql);
        $id_post=intval($id_post);
        $stmt->bind_param("ii",$id_post ,$id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            $stmt->free_result();
            $sql_add_like = "INSERT INTO likes (id_user, id_post) VALUES (?,?);";
            $stmt = $this->conn->prepare($sql_add_like);
            $stmt->bind_param("ii", $id_user,$id_post);
            $stmt->execute();
            $stmt->close();

        }
        else if($result->num_rows >0){
            $sql_remove_like="DELETE FROM likes WHERE id_post = ? AND id_user = ?;";
            $stmt->free_result();
            $stmt = $this->conn->prepare($sql_remove_like);
            $stmt->bind_param("ii", $id_post, $id_user);
            $stmt->execute();
            $stmt->close();
        }
    }
}