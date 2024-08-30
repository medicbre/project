<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{   
    $id = $_SESSION["userid"]; //jer nam funkcija zahteva id i username dole
    $username = $_SESSION["username"];
    $about = htmlspecialchars($_POST["about"], ENT_QUOTES, "UTF-8");
    $introTitle = htmlspecialchars($_POST["introtitle"], ENT_QUOTES, "UTF-8");
    $introText = htmlspecialchars($_POST["introtext"], ENT_QUOTES, "UTF-8");

    include "../classes/dbh.class.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php"; //jer sada menjamo podatke u bazi a ne view
    $profileInfo = new ProfileinfoContr($id, $username); //jer zahteva dva podatke

    $profileInfo->updateProfileInfo($about, $introTitle, $introText);
    
    header("location: ../profile.php?error=none");
}