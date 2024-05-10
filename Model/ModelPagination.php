<?php

namespace App\Model;
use \mysqli;
class ModelPagination extends Conn
{
    public $conn;
    public function __construct($db ="korisnici", $host="db", $user="userr", $password="userr"){
        try{
            $this->conn = new mysqli($host, $user, $password, $db);
        }catch(\mysqli_sql_exception $e){
            echo "there is a problem";
        }
    }
    public function numberOfRows(){
        $sql_query = "SELECT * FROM posts ";
        $stmt = $this->conn->prepare($sql_query);
        $res = $stmt->execute();
        $result = $stmt->get_result(); // Fetch the result set
        $num_rows = $result->num_rows; // Get the number of rows in the result set
        $num_rows = ceil($num_rows/10);
        return $num_rows;

    }
}