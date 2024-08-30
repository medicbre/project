<?php

//MODEL JEDINI VRSI KOMUNIKACIJU/KONEKCIJU SA BAZOM

class ResetRequest extends Dbh {
    public function deleteOldRequests($userEmail){
        $stmt = $this->connect()->prepare('DELETE FROM pwdReset WHERE pwdResetEmail=?;');
        $stmt->execute([$userEmail]);

        if ($stmt === false) {
            header("location: ../index.php?error-executing-the-statement!");
            exit();
        }

        if (!$stmt->execute([$userEmail])) {
            header("location: ../index.php?error-executing-the-statement!");
            exit();
        }

        echo "Record deleted successfully";
    }
    public function insertResetRequest($userEmail, $selector, $hashedToken, $expires) {
        $stmt = $this->connect()->prepare("INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);");
        $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);
    
        if ($stmt === false) {
            header("location: ../index.php?error-executing-the-statement!");
            exit();
        }

        if (!$stmt->execute([$userEmail, $selector, $hashedToken, $expires])) {
            header("location: ../index.php?error-executing-the-statement!");
            exit();
        }

        //echo "Record deleted successfully";
    }

}