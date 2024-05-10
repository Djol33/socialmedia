<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabarito&display=swap" rel="stylesheet"> <meta charset="UTF-8">
    <title></title>
    <base href="http://localhost/">
    <style>
        /*<!--   php require __DIR__."/style.css"  -->*/
    </style>
    <link rel="stylesheet" href="view/public/style.css" type="text/css"/>
</head>
<body>
<header id="header">

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="about-us">About Us</a></li>
            <?php if(!isset($_SESSION["name"]) && !isset($_SESSION["id"])) :?>
            <li><a href="login">Login</a></li>
            <li><a href="register">Register</a></li>
            <?php endif ?>

            <li><a href="makepost">Make Post</a></li>
            <li><a href="all-posts">All Posts</a>
        </ul>

        <?php if(isset($_SESSION["name"])):?>
        <div class="notification"><i class="fa-regular fa-bell"></i>
        <div class="notification-box">

        </div>

        </div>
        <div id="profile"> <img class="pfp_small_img" src='<?php echo $_SESSION["pfp"] ?>'  />
        <div><?= $_SESSION["name"] ?></div>
        <div class="profile_functions">
        <a href="my-profile"><?php echo $_SESSION["name"]?></a>
        <?php if(isset($_SESSION["name"]) && isset($_SESSION["id"])) :?>
            <a href="logout">Log Out</a>
            <?php endif ?>

        </div>
        </div>

        <?php endif ?>
    </nav>
</header>



