<?php 

class PasswordReset extends Dbh {
    
    public function getTokenData($selector, $currentDate)
    {
        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt)
        {
            throw new Exception("SQL statement preparation failed.");
        }

        $stmt->execute([':selector' => $selector, ':currentDate' => $currentDate]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE users_email = :email;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt) 
        {
            throw new Exception("SQL statement preparation failed.");
        }

        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($email, $newPwdHash)
    {
        $sql = "UPDATE users SET pwdUsers=? WHERE users_email=?;";
        $stmt = $this->connect()->prepare($sql);
        
        if (!$stmt) 
        {
            throw new Exception("SQL statement preparation failed.");
        }

        $stmt->execute([':email' => $email, ':pwd' => $newPwdHash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteToken($email)
    {
        $sql = "DELETE FROM users WHERE users_email=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt) 
        {
            throw new Exception("SQL statement preparation failed.");
        }

        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

