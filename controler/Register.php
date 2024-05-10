<?php

namespace App\Controller;

use App\View\RegisterView;
use App\Model\ModelRegister;
class Register extends Controller
{

    public static function Page(): void
    {
        RegisterView::createView();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $model = new ModelRegister();

            $model->register($_POST["ime"], $_POST["email"], $_POST["password"], $_POST["conf_pass"], $_POST['edited_image']);
        }



    }
}