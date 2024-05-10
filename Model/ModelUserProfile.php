<?php

namespace App\Model;
use App\Model\ModelShowLikes;

class ModelUserProfile extends Conn
{

    public function __construct($db ="korisnici", $host="db", $user="userr", $password="userr"){
        // Call the parent class constructor to establish the database connection
        parent::__construct($db, $host, $user, $password);
    }
    public function renderUserProfile($id){
        $sql = "SELECT name, email, pfp_loc FROM korisnici WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $niz = [];
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Store the row in an array
            $niz = $row;
            return $niz;
        }


    }
    public function renderPosts($id){
        $sql = "SELECT p.id, p.title, p.fk_id, k.pfp_loc, p.text, k.name 
                      FROM posts p 
                      INNER JOIN korisnici k ON p.fk_id = ? 
 
                    WHERE p.fk_id = ? AND k.id = ?
                      ORDER BY p.id DESC ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $id, $id, $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if(!$res->num_rows) return "NO POSTS";
        $data = array();

        while ($row = $res ->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

}