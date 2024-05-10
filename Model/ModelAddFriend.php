<?php

namespace App\Model;
use \mysqli;
class ModelAddFriend extends Conn
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
    public function  addFriend($post_id,$my_id ){
        $check = $this->checkStatus($post_id, $my_id);


        if($check[1] == 1 || $check[1] ==2){
            $sql  = "DELETE FROM friends  WHERE id_user = ? AND id_wannabe_friend_with =? ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $my_id, $check[0]);
            $stmt->execute();
            $stmt->close();

        }
        else if ($check[1] == NULL){
            $sql = "INSERT INTO friends (id_user, id_wannabe_friend_with, status ) VALUES (?,?,1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $my_id, $check[0]);
            $stmt->execute();

            $stmt->close();
        }
        return $check[0];


    }
    public function checkStatus($id_post, $my_id){
        $sql = "SELECT fk_id FROM posts  where id = ? ";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id_post);
        $stmt->execute();
        $row1 = null;
        $stmt->bind_result($row1);
        $stmt->fetch();
        $stmt->close();
        $sql = "SELECT status FROM friends   WHERE id_user = ? AND id_wannabe_friend_with = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $my_id,$row1);
        $stmt->execute();
        $row2 = null;
        $stmt->bind_result($row2);
        $stmt->fetch();

        $arr = array($row1,$row2);
        return $arr;


    }
    public function statusFriend($id_friend, $my_id, $friend_id, $status){

        /*
         * STATUS 1 - PENDING
         * STATUS 2 - ACCEPT
         * STATUS 3 - REMOVE
         */

        if($status == 1){
            $sql = "UPDATE friends SET status = 1 WHERE id_friends =?";
        }else if($status == 2){
            $sql = "DELETE FROM friends WHERE id_friend = ?";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
    public function accept($my_id, $id_friend){
        $sql = "UPDATE friends SET status = 2 WHERE id_friend = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_friend);
        if($stmt){
            $stmt->execute();
            echo "succes";
        }
    }
    public function decline($id_friend){
        $sql = "DELETE FROM friends WHERE id_friend = ?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("i", $id_friend);
        $stmt->execute();
        echo "removed";
    }
}