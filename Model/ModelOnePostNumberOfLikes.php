<?php

namespace App\Model;
use mysqli;
class ModelOnePostNumberOfLikes extends Conn
{
        public $conn;

        public function __construct()
    {
        parent::__construct(
            $db = "korisnici",
            $host = "db",
            $user = "userr",
            $password = "userr"
        );

        try {
            $this->conn = new mysqli($host, $user, $password, $db);
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function countLikeOnPost($id_post){
            $sql = "SELECT COUNT(*) AS row_count FROM likes WHERE id_post = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_post );
            $stmt->execute();
            $num_of_likes=null;
            $stmt->bind_result($num_of_likes);
            $stmt->fetch();
            $stmt->close();
            $this->conn->close();
            return $num_of_likes;
}
}