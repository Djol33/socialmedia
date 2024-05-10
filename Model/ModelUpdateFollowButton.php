<?php

namespace App\Model;

class ModelUpdateFollowButton extends Conn
{

    public function __construct($db ="korisnici", $host="db", $user="userr", $password="userr"){
        // Call the parent class constructor to establish the database connection
        parent::__construct($db, $host, $user, $password);
    }
    public function updateFollowButton($my_id, &$rows){
        foreach($rows as &$row){
            $sql = "SELECT status FROM friends WHERE id_user=? AND id_wannabe_friend_with =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii",$my_id, $row["fk_id"]);
            $var = null;
            $stmt->execute();
            $stmt->bind_result($var);
            $stmt->fetch();
            $row["i_follow"] = $var;
            $stmt->close();

        }
 
        return $rows;
    }
}