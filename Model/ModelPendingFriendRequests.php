<?php

namespace App\Model;
use mysqli;
class ModelPendingFriendRequests extends Conn
{
    public function __construct($db ="korisnici", $host="db", $user="userr", $password="userr"){
        // Call the parent class constructor to establish the database connection
        parent::__construct($db, $host, $user, $password);
    }
    public function getPendingRequests($my_id){
        $sql = "SELECT f.id_friend , f.id_user, f.id_wannabe_friend_with, f.status, k.id, k.name, k.pfp_loc FROM friends f INNER JOIN korisnici k ON f.id_user = k.id WHERE f.id_wannabe_friend_with = ? AND f.status=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $my_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = array();
        while($row = $res->fetch_assoc())
        {
            $data[] = $row;
        }
        $stmt->close();

        return $data;
    }
}