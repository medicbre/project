<?php
//MODEL JEDINI VRSI KOMUNIKACIJU/KONEKCIJU SA BAZOM

class Profileinfo extends Dbh {

    protected function getProfileInfo($userid) {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM profiles WHERE user_id = ?;');

            if(!$stmt->execute(array($userid))) {
                throw new Exception("Statement execution failed");
            }

            if($stmt->rowCount() == 0) {
                throw new Exception("Profile not found");
            }

            $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $profileData;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; // or handle error appropriately
            
        }
    }
    
    protected function setNewProfileInfo($profileAbout, $profileTitle, $profileIntro, $userid)  {
        $stmt = $this->connect()->prepare('UPDATE profiles SET profiles_about = ?, profiles_introtitle = ?, profiles_introtext = ? WHERE user_id = ?;');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileIntro, $userid))) { //Proveravamo da li cemo dobiti gresku i pokrecemo SQL statement
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

    }
    protected function setProfileInfo($profileAbout, $profileTitle, $profileIntro, $userid)  {
        $stmt = $this->connect()->prepare('INSERT INTO profiles (profiles_about, profiles_introtitle, profiles_introtext, user_id) VALUES (?, ?, ?, ?);');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileIntro, $userid))) { //Proveravamo da li cemo dobiti gresku i pokrecemo SQL statement
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }
        
    }
}
