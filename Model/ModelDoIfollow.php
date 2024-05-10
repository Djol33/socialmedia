<?php

namespace App\Model;
use mysqli;
class ModelDoIfollow extends Conn
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
    public function doIFollow($my_id, &$rows){
        $sql = "SELECT status FROM friends WHERE id_wannabe_friend_with = ? AND id_user = ?";
        foreach($rows as &$row){
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $row["fk_id"], $my_id);
            $stmt->execute();
            $res = null;
            $stmt->bind_result($res);
            $stmt->fetch();
            $row["i_follow"]=$res;
            $stmt->free_result();

        }
    }
}