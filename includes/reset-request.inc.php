<?php

include_once '../classes/resetRequest-contr.classes.php';

//Proveravamo da li je user pristupio preko submit dugmeta

if (isset($_POST["reset-request-submit"]))
{ 
    $userEmail = $_POST["email"];

    // Inicijalizacija kontrolera za resetovanje lozinke
    $resetRequestController = new ResetRequestContr($userEmail);
    $resetRequestController->processResetRequest();

    header("location: ../reset-password.php?reset=success");
}

else {
    header("location: ../index.php?error");
}

