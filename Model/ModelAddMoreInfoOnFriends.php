<?php

namespace App\Model;

class ModelAddMoreInfoOnFriends extends Conn
{

    public function __construct($db = "korisnici", $host = "db", $user = "userr", $password = "userr")
    {
        parent::__construct($db, $host, $user, $password);
    }
    public function info(array $listOfIds){
        $sql = "SELECT id,pfp_loc, name FROM korisnici WHERE id = ?";

        foreach ($listOfIds as &$list){
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $list["friend_id"]);
            $stmt->execute();
            $stmt->bind_result($id, $pfp_loc,$name);
            $stmt->store_result();
            if($stmt->fetch()){
                $list["pfp_loc"] = $pfp_loc;
                $list["name"] = $name;
                $list["id"] = $id;
                //    "name" =>$name


            }
            $stmt->close();


        }
        return $listOfIds;

    }


}