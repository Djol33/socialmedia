<?php

namespace App\Model;
use mysqli;
class ModelOpenPost extends Conn
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

    public function OpenPost( int $id){
        $sql_query  = "SELECT * FROM posts where id=?";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $ret = array();
        while($row = $res->fetch_assoc()){
            $ret[] =  $row["id"];
            $ret[] =  $row["title"];
        }
        return  $ret;

    }


}