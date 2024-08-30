<?php
if($_SERVER["REQUEST_METHOD"] == "POST") //PROVERAVAMO DA LI JE SUBMITOVANA FORMA(DOSLA POST METODOM) ILI JE UKUCANA IZ URLA
{ 
    // Uzimamo podatke // SANITIZUJEMO PODATKE KOJE USER UNOSI
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $pwdrepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');

    //Instanciramo SignupContr class
    include "../classes/dbh.class.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($username, $pwd, $pwdrepeat, $email);

    //Pokretanje error hendlera 
    $signup->signupUser();

    $userid = $signup->fetchUserId($username);

    //Instanciramo ProfileInfoContr class
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";
    $profileInfo = new ProfileinfoContr($userid, $username);
    $profileInfo->defaultProfileInfo();

    //Vracanje na pocetnu stranicu ako nema gresaka?
    header("location: ../index1.php?succesfull registration");

}