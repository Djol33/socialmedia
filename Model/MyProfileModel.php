<?php

namespace App\Model;
use mysqli;
class MyProfileModel extends Conn
{
    public $conn;

    public function __construct($database = "posts")
    {
        parent::__construct($db = "korisnici", $host = "db", $user = "userr", $password = "userr");

        try {
            $this->conn = new mysqli($host, $user, $password, $db);
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function basicData($id)
    {
        /* GET NAME AND EMAIL */

        $sql = "SELECT name, email, pfp_loc FROM korisnici WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $email = null;
        $name = null;
        $pfp_loc = null;
        $stmt->bind_result($name, $email, $pfp_loc);
        $data = array();
        while ($stmt->fetch()) {
            $data[] = $name;
            $data[] = $email;
            $data[] = $pfp_loc;
        }
        $stmt->close();
        $this->conn->close();
        return $data;
    }

    public function myPosts($id_usr)
    {
        $sql = "SELECT id, title FROM posts WHERE fk_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usr);
        $stmt->execute();
        $data = array();
        $id = null;
        $title = null;
        $stmt->bind_result($id, $title);
        while ($stmt->fetch()) {
            $row = array(
                'id' => $id,
                'title' => $title,
            );
            $data[] = $row;

        }
        $stmt->close();
        $this->conn->close();


        return $data;


    }

}