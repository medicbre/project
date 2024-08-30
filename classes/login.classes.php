<?php
//MODEL JEDINI VRSI KOMUNIKACIJU/KONEKCIJU SA BAZOM

class Login extends Dbh{
    public function getUser($username, $pwd){                                   //SELEKTUJEMO KOLONU PASSWORD 
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? LIMIT 1;');

        if (!$stmt->execute(array($username))) {
            $stmt = null;                               //zatvaramo konekciju ako nadje usera
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() < 1) { //AKO NEMAMO VRACENIH PODATAKA ZATVARAMO KONEKCIJU I VRACAMO GA NA POCETAK
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }
        //Uporedjujemo korisnikov unet password sa onim u bazi
        $user = $stmt->fetchObject();
        $checkPwd = password_verify($pwd, $user->users_pwd); //pristupanje objektu 

        if (!$checkPwd) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }
        else {

            session_start();
            $_SESSION['userid'] = $user->user_id;
            $_SESSION['userusername'] = $user->username;
            $stmt = null;
        }
    }
}