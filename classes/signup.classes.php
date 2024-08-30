<?php

class Signup extends Dbh{
    public function setUser($username, $pwd, $email){
        $stmt = $this->connect()->prepare('INSERT INTO users (username, users_pwd, users_email) VALUES (?, ?, ?);');
        
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $hashedPwd, $email))) {
            $stmt = null;                               //zatvaramo konekciju ako nadje usera
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

    }
    public function userExists($username, $email){     //PROVERAVAMO DA LI SU USERNAME I EMAIL KOJI JE KORISNIK UNEO JEDNAKI ONIMA U BAZI
        $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR users_email = ?;');

        if(!$stmt->execute(array($username, $email))) {
            $stmt = null;                               //zatvaramo konekciju ako nadje usera
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = '';
        if($stmt->rowCount() > 0) { //Proveravamo da li ce vratiti red iz bez(tj korisnika) ako ima vraca gresku
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function getUserId($username)  {  //PRAVIMO PROFIL 
        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE username = ?;');

        if(!$stmt->execute(array($username))) { //Proveravamo da li cemo dobiti gresku i pokrecemo SQL statement
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: profile.php?error=profilenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }
}
