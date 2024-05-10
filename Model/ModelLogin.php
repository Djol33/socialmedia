<?php

namespace App\Model;
use mysqli;
class ModelLogin extends Conn
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
    public function login($email, $password):int{
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $sql_query = "SELECT * FROM korisnici WHERE ( email = ? )";
        $stmt = $this->conn->prepare($sql_query);
        $stmt  ->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


        if ($result->num_rows == 1 && password_verify($password, $row["password"])) {

            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["pfp"] = $row["pfp_loc"];
            return 1;
        }
        else{
            return  0;
        }
    }


}