<?php

require_once "../classes/passwordReset-contr.classes.php";
require_once "../classes/passwordReset-model.classes.php";
require "../vendor/autoload.php";

if (isset($_POST["reset-password-submit"])) {
    // Uzimamo podatke iz POST zahteva
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    // Inicijalizacija baze podataka
    $db = new DBH();
    $connect = $db->accesPublicConnect();
    
    // Kreiramo instancu kontrolera sa modelom
    $passwordResetController = new PasswordResetContr();

    // Postavljamo podatke za reset lozinke
    $passwordResetController->setRequestData($selector, $validator, $password, $passwordRepeat);

    // Pozivamo funkciju za reset lozinke
    $passwordResetController->resetPassword();

} else {
    header("Location: ../index.php?error");
    exit();
}

