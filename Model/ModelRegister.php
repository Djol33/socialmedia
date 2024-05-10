<?php

namespace App\Model;
use mysqli;

class ModelRegister extends Conn
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

    public function register($name, $email, $password, $conf_password, $pfp)
    {
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $conf_password = htmlspecialchars($conf_password);
        $sql_query_check_email = "SELECT * FROM korisnici WHERE email=?";
        $st = $this->conn->prepare($sql_query_check_email);
        $st->bind_param("s", $email);

        if ($st->execute()) {
            $st->store_result();
            $row = $st->num_rows;

            if ($row === 0) {
                $st->free_result();

                $sql_query =
                    "INSERT INTO korisnici (name, email, password, pfp_loc) VALUES (?,?,?,?)";
                $hashpassword = password_hash($password, PASSWORD_ARGON2I);

                if (isset($this->conn)) {
                    if (password_verify($conf_password, $hashpassword)) {
                        if ($pfp != "data:," && isset($pfp)) {
                            $imageData = $this->handleBase64Image($pfp);
                            $upload = "uploads/";
                            $url = $upload . "profile_image_" . time() . ".jpg"; // Default URL with timestamp


                                if (file_put_contents($url, $imageData)) {
                                    $stmt = $this->conn->prepare($sql_query);
                                    $stmt->bind_param(
                                        "ssss",
                                        $name,
                                        $email,
                                        $hashpassword,
                                        $url
                                    );

                                    if ($stmt->execute()) {
                                        $stmt->close();
                                        echo "Success";
                                    } else {
                                        echo "Failed to execute SQL query.";
                                    }
                                } else {
                                    echo "Failed to save the image file.";
                                }
                            } else {

                                    $url = "uploads/0.jpg"; // Set URL to "uploads/0.jpg" when $pfp is "0"

                                $stmt = $this->conn->prepare($sql_query);
                                $stmt->bind_param(
                                    "ssss",
                                    $name,
                                    $email,
                                    $hashpassword,
                                    $url
                                );

                                if ($stmt->execute()) {
                                    $stmt->close();
                                    echo "Success";
                                } else {
                                    echo "Failed to execute SQL query.";
                                }
                            }
                        }
                    } else {
                        echo "There has been a problem with password verification.";
                    }
                } else {
                    echo "Connection error.";
                }
            } else {
                echo "User already exists with this email.";
            }
        }

    // Function to handle Base64 image data and return the decoded data
    private function handleBase64Image($base64Data)
    {
        // Remove the data URI scheme and parse the Base64 data
        $base64Data = preg_replace(
            "#^data:image/\w+;base64,#i",
            "",
            $base64Data
        );

        // Decode the Base64 data
        $decodedData = base64_decode($base64Data);

        if ($decodedData !== false) {
            return $decodedData;
        } else {
            return false;
        }
    }
}
