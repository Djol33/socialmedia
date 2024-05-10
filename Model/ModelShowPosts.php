<?php

namespace App\Model;
use mysqli;
class ModelShowPosts extends Conn
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
    public function showPosts($numpage = 1)
    {
        try {
            $offset = ($numpage == 1 ? 0 : ($numpage - 1) * 10);
            $sql_query = "SELECT p.id, p.title, p.fk_id, k.pfp_loc, p.text, k.name 
                      FROM posts p 
                      INNER JOIN korisnici k ON p.fk_id = k.id 
                      ORDER BY p.id DESC 
                      LIMIT ?, 10";

            $stmt = $this->conn->prepare($sql_query);
            $stmt->bind_param("i", $offset);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } catch (\mysqli_sql_exception $e) {
            // Handle the exception, log the error, or return an empty array as appropriate.
            echo "Error: " . $e->getMessage();
            return array();
        } finally {
            // Close the prepared statement and the database connection
            $stmt->close();
            $this->conn->close();
        }
    }





}