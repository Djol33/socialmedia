<?php

namespace App\Model;

use mysqli;
class ModelShowLikes extends Conn
{
    public $conn;

    public function __construct(){
        parent::__construct($db ="korisnici", $host="db", $user="userr", $password="userr");

        try{
            $this->conn = new mysqli($host, $user, $password, $db);
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    public function showLikes($id_user, &$rows){
        $sql = "SELECT COUNT(*) FROM likes where id_post = ?";
        foreach ($rows as &$row) {
            $stmt = $this->conn->prepare($sql);
            $likeCount = null;
            $stmt->bind_param("i", $row["id"]);
            $stmt->execute();
            $stmt->bind_result($likeCount);
            $stmt->fetch();
            $row["like"] = $likeCount;
            $stmt->free_result();

        }
        foreach($rows as &$row){
            $sql_did_i_like = "SELECT id_post FROM likes WHERE id_post=? AND id_user=?";

            $stmt = $this->conn->prepare($sql_did_i_like);
            if (!$stmt) {
                die("Error in prepared statement: " . $this->conn->error);
            }
            $likeCount = 0;
            $stmt->bind_param("ii",$row["id"],$id_user );
            $stmt->execute();

                $stmt->bind_result($likeCount);
                $stmt->fetch();
                $row["i_like"] = $likeCount;

            $stmt->free_result();
        }


    }



}