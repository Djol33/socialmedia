<?php

namespace App\Model;

class ModelListOfFriends extends Conn
{
    public function __construct($db = "korisnici", $host = "db", $user = "userr", $password = "userr")
    {
        parent::__construct($db, $host, $user, $password);
    }
    public function getListOfFriends($id){
        $sql = "SELECT  f1.id_wannabe_friend_with AS friend_id
FROM friends AS f1
 
INNER JOIN friends AS f2 ON f1.id_user = f2.id_wannabe_friend_with AND f1.id_wannabe_friend_with = f2.id_user
WHERE f1.status = 2 AND f2.status = 2 AND f1.id_user  = ? AND f2.id_wannabe_friend_with = ?
LIMIT 4
";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id,$id);
        $stmt->execute();
        $stmt->bind_result( $friend_id);

        $data = array();

        // Fetch the results into an associative array
        while ($stmt->fetch()) {
            $data[] = array(

                'friend_id' => $friend_id
            );
        }
        return $data;


    }
}