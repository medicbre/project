<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sajt</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container">

    <header class="header">
            <img class="logo" src="images/logo.svg" alt="logo">
            </header>    

        <nav class="nav">
            <ul>
                <li><a href="index1.php">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Contact</a></li>
                <?php
                    if(isset($_SESSION["userid"]))
                    {
                ?>
                <li><a href="profile.php"><b> <?php echo $_SESSION["userusername"]; ?></a></b></li>
                <li><a href="includes/logout.inc.php">LOGOUT</a></li>
                <?php
                    }
                    else
                    {
                ?>
                        <li><a href="index.php">Register</a></li>
                        <li><a href="index.php">Login</a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>

        <div class="hero">
            <h1><span>TAILORED</span><br>WEB DESIGN</h1>

        </div><!--end hero-->
