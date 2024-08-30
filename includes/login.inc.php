<?php

error_log("Reached login.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") //PROVERAVAMO DA LI JE SUBMITOVANA FORMA(DOSLA POST METODOM) ILI JE UKUCANA IZ URLA
{   
    error_log("POST request detected in login.inc.php");
    // Uzimamo podatke sa index stranice
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');

    //Instanciramo LoginContr class
    include "../classes/dbh.class.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    //$login = new LoginContr(htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8'));
    $login = new LoginContr($username, $pwd);

    error_log("Username: $username");
    error_log("Password: $pwd");

    //Pokretanje error hendlera 
    $login->loginUser();

    //Vracanje na pocetnu stranicu ako nema gresaka?
    header("location: ../index1.php?error=none");
    

}