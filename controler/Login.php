<?php

namespace App\Controller;

use App\View\LoginView;
use App\Model\ModelLogin;
class Login extends Controller
{
    public static function Page(): void
    {
        if(isset($_SESSION["id"])) {
            header("Location: about-us");
            exit();

        }
        else{
            LoginView::createView();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $model = new ModelLogin();
                $check = $model->login($_POST["email"], $_POST["password"]);
                if($check == 1) {
                    header("Location: about-us");
                    exit();
                }
                else{
                    echo "Error, Try again";
                }

            }
        }



    }
}